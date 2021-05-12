<?php

namespace AHT\Blog\Controller\Post;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * View constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory
    )
    {
        $this->_pageFactory = $pageFactory;
        $this->_messageManager = $context->getMessageManager();
        return parent::__construct($context);
    }

    public function execute() {
        $id = $this->getRequest()->getParam('id');
        if (empty($id)){    
            $this->_messageManager->addErrorMessage('Blog post not found Ok.');
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('ahtblog/post/index');
            return $resultRedirect;
        }
        return $this->_pageFactory->create();
    }
}
