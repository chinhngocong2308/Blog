<?php

namespace AHT\Blog\Block\Sidebar;

class Category extends \Magento\Framework\View\Element\Template
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \AHT\Blog\Model\CategoryFactory
     */
    protected $categoryFactory;

    /**
     * Category constructor.
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \AHT\Blog\Model\CategoryFactory $categoryFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \AHT\Blog\Model\CategoryFactory $categoryFactory
    )
    {
        $this->categoryFactory = $categoryFactory;
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

    public function getPostCategory(){
        return $this->categoryFactory->create()->getCollection()->getData();
    }
}

