<?php

namespace AHT\Blog\Controller\Post;

class Search extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * Index constructor.
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
        $queryString = $this->getRequest()->getParam('query');
        if (empty($queryString)){
            $this->_messageManager->addErrorMessage('Search query string is not found.');
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('ahtblog/post/index');
            return $resultRedirect;
        }
        // echo '<pre>';
        // var_dump($queryString);
        // echo '<pre>';
        // exit();

        return $this->_pageFactory->create();
    }
}
