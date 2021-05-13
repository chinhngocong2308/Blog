<?php

namespace AHT\Blog\Block\Adminhtml\Post;

use Magento\Backend\Block\Widget\Context;

/**
 * Class GenericButton
 * @package AHT\Blog\Block\Adminhtml\Edit
 */
class Generic
{

    protected $context;

    /**
     * GenericButton constructor.
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        $this->context = $context;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = []) {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    /**
     * @return mixed
     * return postID
     */
    public function getId() {
        return $this->context->getRequest()->getParam('id');
    }
}
