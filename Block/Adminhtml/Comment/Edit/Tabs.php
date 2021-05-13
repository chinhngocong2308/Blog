<?php

namespace AHT\Blog\Block\Adminhtml\Comment\Edit;

use Magento\Backend\Block\Widget\Tabs as WidgetTabs;

class Tabs extends WidgetTabs
{
    /**
     * Initialize construct
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('blogs_create_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Comment Information'));
    }

    /**
     * @return WidgetTabs
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeToHtml() {
        $this->addTab(
            'blogs_create_tabs',
            [
                'label' => __('General'),
                'title' => __('General'),
                'content' => $this->getLayout()->createBlock(
                    'AHT\Blog\Block\Adminhtml\Comment\Edit\Tab\Info'
                )->toHtml(),
                'active' => true
            ]
        );
        return parent::_beforeToHtml();
    }
}
