<?php

namespace AHT\Blog\Block\Adminhtml\Category\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;

class Info extends Generic implements TabInterface{
    /**
     * @var Config
     */
    protected $_wysiwygConfig;
    /**
     * @var \Magento\Store\Model\WebsiteFactory
     */
    protected $_websiteFactory;
    /**
     * @var \Magento\Backend\Block\Widget\Form\Renderer\Fieldset
     */
    protected $_rendererFieldset;
    /**
     * @var \AHT\Blog\Helper\Data
     */
    protected $helper;

    /**
     * Info constructor.
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Config $wysiwygConfig
     * @param \Magento\Framework\Session\SessionManagerInterface $coreSession
     * @param \Magento\Store\Model\WebsiteFactory $websiteFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset
     * @param \AHT\Blog\Helper\Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Config $wysiwygConfig,
        \Magento\Framework\Session\SessionManagerInterface $coreSession,
        \Magento\Store\Model\WebsiteFactory $websiteFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Backend\Block\Widget\Form\Renderer\Fieldset $rendererFieldset,
        \AHT\Blog\Helper\Data $helper,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_coreSession = $coreSession;
        $this->_websiteFactory = $websiteFactory;
        $this->_rendererFieldset = $rendererFieldset;
        $this->helper = $helper;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return Generic
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('category');
        if($model->getId()){
            $parentCat = $this->helper->getParentCatList($model->getId());
        }else{
            $parentCat = $this->helper->getParentCatList($id=0);
        }

        // echo '<pre>';
        // var_dump($parentCat);
        // echo '<pre>';
        // exit();

        $form = $this->_formFactory->create();
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information')]
        );
        if($model->getId()){
            $store = json_decode($model->getStore());
            $model->setData("store", $store);
            $cat = json_decode($model->getParentCategory());
            $model->setData("parent_category", $cat);
            $fieldset->addField(
                'id',
                'hidden',
                ['name' => 'id']
            );
        }
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
                'class' => 'main_acount',
                'values' => [
                    ['label' => __('Enable'), 'value' => '1'],
                    ['label' => __('Disable'), 'value' => '0']
                ]
            ]
        );
        $fieldset->addField(
            "title",
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'comment' => __('Title'),
                'required' => true
            ]
        );
        if (!empty($parentCat)){
            $fieldset->addField(
                'parent_category',
                'multiselect',
                [
                    'name'     => 'parent_category[]',
                    'label'    => __('Parent Category'),
                    'title'    => __('Parent Category'),
                    'required' => false,
                    'values'   => $parentCat,
                    'note'   => 'If no choose, this category is parent category.'
                ]
            );
        }

        $fieldset->addField(
            'store',
            'multiselect',
            [
                'name'     => 'store[]',
                'label'    => __('Store Views'),
                'title'    => __('Store Views'),
                'required' => true,
                'values'   => $this->_systemStore->getStoreValuesForForm(false, true),
            ]
        );
        $fieldset->addField(
            "meta_title",
            'text',
            [
                'name' => 'meta_title',
                'label' => __('Meta Title'),
                'comment' => __('Meta Title'),
                'required' => true
            ]
        );
        $fieldset->addField(
            "meta_keyword",
            'textarea',
            [
                'name' => 'meta_keyword',
                'label' => __('Meta Keyword'),
                'comment' => __('Meta Keyword'),
                'required' => true,
                'note' => 'Add meta keyword for category.'
            ]
        );
        $fieldset->addField(
            "meta_description",
            'textarea',
            [
                'name' => 'meta_description',
                'label' => __('Meta Description'),
                'comment' => __('Meta Description'),
                'required' => true,
                'note' => 'Meta description for category.'
            ]
        );

        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);
        return parent::_prepareForm();
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabLabel()
    {
        return __('Category');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Category');
    }

    /**
     * @return bool
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
