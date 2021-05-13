<?php

namespace AHT\Blog\Block\Blog;

use Magento\Framework\View\Element\Template;
use AHT\Blog\Model\PostFactory;

/**
 * Class Search
 * @package AHT\Blog\Block\Blog
 */
class Search extends Template
{
    /**
     * @var PostFactory
     */
    protected $postFactory;

    /**
     * Search constructor.
     * @param Template\Context $context
     * @param PostFactory $postFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        PostFactory $postFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->postFactory = $postFactory;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }


    protected  function _construct()
    {
        parent::_construct();
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        $query = $this->getRequest()->getParam('query');
        $collection = $this->postFactory->create()->getCollection()
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter(
                array('title', 'meta_keyword', 'meta_title', 'meta_description'),
                array(
                    array('like' => '%' . $query . '%'),
                    array('like' => '%' . $query . '%'),
                    array('like' => '%' . $query . '%'),
                    array('like' => '%' . $query . '%'),
                    array('like' => '%' . $query . '%')
                )
            )
            ->setOrder('id', 'DESC');
        $this->setCollection($collection);
        parent::_prepareLayout();
       
        $this->getCollection()->load();
        //  echo '<pre>';
        // var_dump($query);
        // echo '<pre>';
        // exit();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    public function getConfigDetails(){
        $config = [];
        $config['comment'] = $this->_scopeConfig->getValue('ahtblog/general/comment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $config;
    }
}
