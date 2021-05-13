<?php

namespace AHT\Blog\Controller\Adminhtml\Comment;

use AHT\Blog\Model\CommentFactory;
use Magento\Framework\Controller\ResultFactory;

class Delete extends \Magento\Backend\App\Action
{
    /**
     * @var bool
     */
    protected $resultPageFactory = false;
    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        CommentFactory $commentFactory
    )
    {
        parent::__construct($context);
        $this->_resultFactory = $context->getResultFactory();
        $this->commentFactory = $commentFactory;
        $this->messageManager = $messageManager;
    }

    public function execute() {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->commentFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess("Comment deleted successfully.");
            } catch (\Exception $e) {
                $this->messageManager->addError('Something went wrong '.$e->getMessage());
            }
        }else{
            $this->messageManager->addError('Comment not found, please try once more.');
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/comment/index');
        return $resultRedirect;
    }
}
