<?php
namespace AHT\Blog\Controller\Category;

class Post extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Framework\App\Action\Context $context
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
    /**
     * View page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if (empty($id)){
            $this->_messageManager->addErrorMessage('Category ID not found.');
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('ahtblog/post/index');
            return $resultRedirect;
        }
        return $this->_pageFactory->create();
    }
}
