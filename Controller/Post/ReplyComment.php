<?php

namespace AHT\Blog\Controller\Post;

class ReplyComment extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;
    /**
     * @var \AHT\Blog\Model\ReplyCommentFactory
     */
    protected $commentFactory;
    protected $json;
    protected $resultJsonFactory;

    /**
     * ReplyComment constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     * @param \AHT\Blog\Model\CommentFactory $commentFactory
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \AHT\Blog\Model\CommentFactory $commentFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    )
    {
        $this->json = $json;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->commentFactory = $commentFactory;
        $this->_pageFactory = $pageFactory;
        $this->_scopeConfig = $scopeConfig;
        $this->_messageManager = $context->getMessageManager();
        return parent::__construct($context);
    }

    public function execute() {
        $status = $this->_scopeConfig->getValue('ahtblog/general/comment_status', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $postData = $this->getRequest()->getParams();
         /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        $model = $this->commentFactory->create();

        $model->setPostId($postData['postId']);
        $model->setUsername($postData['username']);
        $model->setEmail($postData['email']);
        $model->setComment($postData['comment']);
        $model->setParentId($postData['parentId']);
        $model->setStatus($status);
        $resultJson->setData($model);
        try{
            $model->save();
        }catch(\Exception $e){
            $this->_messageManager->addErrorMessage(__('Something went wrong while adding comment.'));
        }
    }
}
