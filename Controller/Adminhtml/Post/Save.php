<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \AHT\Blog\Model\PostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->_messageManager = $context->getMessageManager();
        $this->_resultFactory = $context->getResultFactory();
        $this->postFactory = $postFactory;
    }
    public function execute() {
        $postData = $this->getRequest()->getParams();
        $model = $this->postFactory->create();
        if(isset($postData['id'])) {
            $model = $model->load($postData['id']);
        }
        try {
            $model->setTitle($postData['title']);
            $model->setMetaTitle($postData['meta_title']);
            $model->setMetaKeyword($postData['meta_keyword']);
            $model->setMetaDescription($postData['meta_description']);
            $model->setStatus($postData['status']);
            $model->setContent($postData['content']);
            $model->setShortContent($postData['short_content']);
            if (array_key_exists('links', $postData)){
                $model->setProductId(json_encode($postData['links']));
            }
            $model->setStores(json_encode($postData['stores']));
            $model->setSticky($postData['sticky']);
            $model->setAuthor($postData['author']);
            $model->setPublishedAt($postData['published_at']);
            $model->setCategoryId(json_encode($postData['category_id']));
            // $postData['image']
            if(array_key_exists('image', $postData)){
                $model->setImage(json_encode($postData['image']));
            }
            try{
                $model->save();
                $this->_messageManager->addSuccessMessage('Post added succesfully.');
            }catch(\Exception $e){
                $this->_messageManager->addErrorMessage('Something went wrong while saving post');
            }
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage('Something went wrong '.$e->getMessage());
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/post/index');
        return $resultRedirect;
    }
}
