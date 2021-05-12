<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class Delete
 * @package AHT\Blog\Block\Adminhtml\Post
 */
class Delete extends Generic implements ButtonProviderInterface
{
    /**
     * @return array
     * @return Delete button
     */
    public function getButtonData() {
        $deleteArray = [];
        if ($this->getId()) {
            $deleteArray = [
                'label' => __('Delete Post'),
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure want to do this post?'
                    ) . '\', \'' . $this->getDeletePostUrl() . '\')',
                'sort_order' => 20,
                'class' => 'delete',
            ];
        }
        return $deleteArray;
    }

    /**
     * @return string
     * @return Delete Post Url
     */
    public function getDeletePostUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getId()]);
    }
}
