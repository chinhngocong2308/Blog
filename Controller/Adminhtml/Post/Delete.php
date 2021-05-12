<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

use AHT\Blog\Model\PostFactory;
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

    /**
     * Delete constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param PostFactory $postFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        PostFactory $postFactory
    )
    {
        parent::__construct($context);
        $this->_resultFactory = $context->getResultFactory();
        $this->postFactory = $postFactory;
        $this->messageManager = $messageManager;
    }

    public function execute() {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->postFactory->create();
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess("Post deleted successfully.");
            } catch (\Exception $e) {
                $this->messageManager->addError('Something went wrong '.$e->getMessage());
            }
        }else{
            $this->messageManager->addError('Post not found, please try once more.');
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/post/index');
        return $resultRedirect;
    }
}
