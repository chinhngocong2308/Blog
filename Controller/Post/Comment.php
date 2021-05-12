<?php

namespace AHT\Blog\Controller\Post;

class Comment extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    /**
     * @var \AHT\Blog\Model\CommentFactory
     */
    protected $commentFactory;

    /**
     * Comment constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \AHT\Blog\Model\CommentFactory $commentFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Blog\Model\CommentFactory $commentFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->commentFactory = $commentFactory;
        $this->_pageFactory = $pageFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_messageManager = $context->getMessageManager();
        return parent::__construct($context);
    }

    public function execute() {
        $status = $this->_scopeConfig->getValue('ahtblog/general/comment_status', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $postData = $this->getRequest()->getParams();
        $model = $this->commentFactory->create();
        $model->setPostId($postData['post_id']);
        $model->setUsername($postData['username']);
        $model->setEmail($postData['email']);
        $model->setComment($postData['comment']);
        $model->setStatus($status);
        try{
            $model->save();
            $this->_messageManager->addSuccessMessage('Comment added succesfully.');
        }catch(\Exception $e){
            $this->_messageManager->addErrorMessage('Something went wrong while adding comment.');
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('ahtblog/post/view?id='.$postData['post_id']);
        return $resultRedirect;
    }
}
