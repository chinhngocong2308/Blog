<?php

namespace AHT\Blog\Block\Sidebar;

class Latest extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \AHT\Blog\Model\ResourceModel\Post\Collection
     */
    protected $postCollection;

    /**
     * Latest constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \AHT\Blog\Model\ResourceModel\Post\Collection $postCollection
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \AHT\Blog\Model\ResourceModel\Post\Collection $postCollection
    )
    {
        $this->postCollection = $postCollection;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseUrl(){
        $baseUrl = $this->storeManager->getStore()->getBaseUrl();
        return $baseUrl;
    }

    public function getMediaBaseUrl(){
        $pubMedia = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $pubMedia;
    }

    public function getLatestPostList(){
        $collection = $this->postCollection
                        ->setPageSize(3)
                        ->setOrder(
                            'created_at',
                            'desc'
                        )
                        ->getData();
        return $collection;
    }
}

