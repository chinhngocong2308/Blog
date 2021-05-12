<?php

namespace AHT\Blog\Controller\Adminhtml\Comment;

use Magento\Framework\Controller\ResultFactory;

class Save extends \Magento\Backend\App\Action
{

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \AHT\Blog\Model\CommentFactory $commentFactory
    )
    {
        parent::__construct($context);
        $this->_messageManager = $context->getMessageManager();
        $this->_resultFactory = $context->getResultFactory();
        $this->commentFactory = $commentFactory;
    }
    public function execute() {
        $postData = $this->getRequest()->getParams();
        $model = $this->commentFactory->create();
        if(isset($postData['id'])) {
            $model = $model->load($postData['id']);
        }
        try {
            $model->setUsername($postData['username']);
            $model->setEmail($postData['email']);
            $model->setComment($postData['comment']);
            $model->setStatus($postData['status']);
            try{
                $model->save();
                $this->_messageManager->addSuccessMessage('Comment updated succesfully.');
            }catch(\Exception $e){
                $this->_messageManager->addErrorMessage('Something went wrong while updating comment.');
            }
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage('Something went wrong '.$e->getMessage());
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/comment/index');
        return $resultRedirect;
    }
}
