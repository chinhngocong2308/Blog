<?php

namespace AHT\Blog\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \AHT\Blog\Model\CategoryFactory $categoryFactory
    )
    {
        parent::__construct($context);
        $this->_messageManager = $context->getMessageManager();
        $this->_resultFactory = $context->getResultFactory();
        $this->categoryFactory = $categoryFactory;
    }
    public function execute() {
        $postData = $this->getRequest()->getParams();
        $model = $this->categoryFactory->create();
        if(isset($postData['id'])) {
            $model = $model->load($postData['id']);
        }
        try {
            $model->setTitle($postData['title']);
            $model->setMetaTitle($postData['meta_title']);
            $model->setMetaKeyword($postData['meta_keyword']);
            $model->setMetaDescription($postData['meta_description']);
            $model->setStatus($postData['status']);
            $model->setStore(json_encode($postData['store']));
            if (array_key_exists('parent_category', $postData)){
                $model->setParentCategory(json_encode($postData['parent_category']));
            }
            try{
                $model->save();
                $this->_messageManager->addSuccessMessage('Category added succesfully.');
            }catch(\Exception $e){
                $this->_messageManager->addErrorMessage('Something went wrong while saving category');
            }
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage('Something went wrong '.$e->getMessage());
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/category/index');
        return $resultRedirect;
    }
}
