<?php

namespace AHT\Blog\Block\Adminhtml\Comment\Edit\Tab;

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
        $model = $this->_coreRegistry->registry('comment');
        $form = $this->_formFactory->create();
        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Information')]
        );
        if($model->getId()){
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
                    ['label' => __('Approved'), 'value' => '1'],
                    ['label' => __('Disapproved'), 'value' => '0']
                ]
            ]
        );
        $fieldset->addField(
            "username",
            'text',
            [
                'name' => 'username',
                'label' => __('Username'),
                'comment' => __('Username'),
                'required' => true
            ]
        );

        $fieldset->addField(
            "email",
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'comment' => __('Email'),
                'required' => true,
                'class' => 'validate-email'
            ]
        );

        $fieldset->addField(
            "comment",
            'textarea',
            [
                'name' => 'comment',
                'label' => __('Comment'),
                'comment' => __('Comment'),
                'required' => true,
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
        return __('Comment');
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getTabTitle()
    {
        return __('Comment');
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
