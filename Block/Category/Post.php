<?php
namespace AHT\Blog\Block\Category;

class Post extends \Magento\Framework\View\Element\Template
{
    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \AHT\Blog\Model\ResourceModel\Post\Collection $postCollection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        $this->postCollection = $postCollection;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    protected  function _construct() {
        parent::_construct();
        $collection = $this->postCollection;
        $collection = $collection->setOrder('id', 'DESC');
        $this->setCollection($collection);
    }

    /**
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'aht.blog.list.pager'
        );
        $pager->setLimit(10)
            ->setShowAmounts(false)
            ->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @return array
     */
    public function getCategoryPostId(){
        $id = $this->getRequest()->getParam('id');
        $collection = $this->postCollection;
        $postData = $collection->getData();
        $postId = [];
        if (!empty($postData)){
            foreach ($postData as $catPost){
                $catId = json_decode($catPost['category_id']);
                if (in_array($id,$catId)){
                    array_push($postId,$catPost['id']);
                }
            }
        }
        return $postId;
    }


    /**
     * @return array
     */
    public function getConfigDetails(){
        $config = [];
        $config['number_display'] = $this->_scopeConfig->getValue('ahtblog/general/number_display', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $config['comment'] = $this->_scopeConfig->getValue('ahtblog/general/comment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $config;
    }
    
}
