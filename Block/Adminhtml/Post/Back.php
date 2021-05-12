<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends Generic implements ButtonProviderInterface
{
    /**
     * @return array
     * @return Back Button
     */
    public function getButtonData() {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackGridUrl()),
            'sort_order' => 10,
            'class' => 'back-button'
        ];
    }

    /**
     * @return string
     * @return Back Blog Post Grid Url
     */
    public function getBackGridUrl() {
        return $this->getUrl('*/*/');
    }
}
