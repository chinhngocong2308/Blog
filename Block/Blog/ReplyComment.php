<?php

namespace AHT\Blog\Block\Blog;

/**
 * Class ReplyComment
 * @package AHT\Blog\Block\Blog
 */
class ReplyComment extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \AHT\Blog\Model\PostFactory
     */
    protected $postFactory;
    /**
     * @var \AHT\Blog\Model\ResourceModel\Comment\Collection
     */
    protected $commentCollection;

    protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \AHT\Blog\Model\PostFactory $postFactory,
        \Magento\Framework\Data\Form\FormKey $formKey,
        \AHT\Blog\Model\ResourceModel\Comment\Collection $commentCollection,
        \AHT\Blog\Helper\Data $helper
    )
    {
        $this->postFactory = $postFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
        $this->formKey = $formKey;
        $this->commentCollection = $commentCollection;
        $this->helper = $helper;
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

    /**
     * @return mixed
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getMediaBaseUrl(){
        $pubMedia = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        return $pubMedia;
    }

    /**
     * @return string
     */
    public function getPlaceholderImage() {
        return sprintf('<img src="%s" class="mos-image"/>', $this->getViewFileUrl('Magento_Catalog::images/product/placeholder/thumbnail.jpg'));
    }

    public function getPostDetails(){
        $id = $this->getRequest()->getParams();
        $post = $this->postFactory->create()->load($id);
        $postData =  $post->getData();
        if (!empty($postData)){
            $imgArr = [];
            $image = (array)(json_decode($postData['image']));
            if (!empty($image)){
                foreach ($image as $img){
                    $imgArr[] = (array)$img;
                }
            }
            $postData['image'] = $imgArr;
        }
        return $postData;
    }

    public function getFormKey(){
        return $this->formKey->getFormKey();
    }

    /**
     * @return array
     */
    public function getConfigDetails(){
        $config = [];
        $config['comment'] = $this->_scopeConfig->getValue('ahtblog/general/comment', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        return $config;
    }

    /**
     * @return array
     * @return comment for post
     */
    public function getPostComment(){
        $id = $this->getRequest()->getParams();
        $comment = $this->commentCollection
            ->addFieldToFilter('post_id',$id)
            ->addFieldToFilter('status',1);
        $commentData = $comment->getData();
        return $commentData;
    }

    public function getPostAuthor(){
        $author = '';
        $id = $this->getRequest()->getParams();
        $post = $this->postFactory->create()->load($id);
        $postData =  $post->getData();
        if (!empty($postData)){
            $author = $this->helper->getPostAuthor($postData['author']);
        }
        return $author;
    }

}
