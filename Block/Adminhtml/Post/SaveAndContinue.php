<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveAndContinue
 * @package AHT\Blog\Block\Adminhtml\Post
 */
class SaveAndContinue extends Generic implements ButtonProviderInterface
{
    /**
     * @return array
     * @return Save And Continue Button
     */
    public function getButtonData() {
        return [
            'label' => __('Save and Continue'),
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 40,
            'class' => 'save-and-continue',
        ];
    }
}
