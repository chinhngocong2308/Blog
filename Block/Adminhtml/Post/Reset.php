<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Reset
 * @package AHT\Blog\Block\Adminhtml\Post
 */
class Reset implements ButtonProviderInterface {

    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'on_click' => 'location.reload();',
            'class' => 'reset-form',
            'sort_order' => 35
        ];
    }
}
