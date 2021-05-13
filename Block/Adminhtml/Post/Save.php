<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Save
 * @package AHT\Blog\Block\Adminhtml\Post
 */
class Save extends Generic implements ButtonProviderInterface
{

    public function getButtonData()
    {
        return [
            'label' => __('Save Post'),
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'class' => 'primary save-button',
            'sort_order' => 45,
        ];
    }
}
