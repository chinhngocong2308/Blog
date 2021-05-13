<?php

namespace AHT\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use AHT\Blog\Model\PostFactory;

/**
 * Class Post
 * @package AHT\Blog\Block\Blog
 */
class Post extends Template
{
    /**
     * @var PostFactory
     */
    protected $postFactory;
    protected $instanceFactory;
    /**
     * Post constructor.
     * @param Template\Context $context
     * @param PostFactory $postFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        PostFactory $postFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Widget\Model\Widget\InstanceFactory $instanceFactory,
        array $data = []
    ) {
        $this->instanceFactory = $instanceFactory;
        $this->postFactory = $postFactory;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }


    protected  function _construct()
    {
        parent::_construct();
        $collection = $this->postFactory->create()->getCollection()
            ->setOrder('id', 'DESC');
        $this->setCollection($collection);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
       
        return $this;
    }

    /**
     * @return string
     */
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return array
     */
    public function getConfigDetails()
    {
        $config = [];
        $config['slide'] = $this->_scopeConfig->getValue('ahtblog/general/slide', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $config['comment'] = $this->_scopeConfig->getValue('ahtblog/general/comment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $config['number_display'] = $this->_scopeConfig->getValue('ahtblog/general/number_display', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $config;
    }

    /**
     * @param string $key
     * @return string
     */
    public function getDataWidgets($key)
    {
        if (!$this->hasData($key)) {
            $this->setData($key, 99999);
        }
        return $this->getData($key);
    }
}
