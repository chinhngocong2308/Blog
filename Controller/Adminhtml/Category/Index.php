<?php

namespace AHT\Blog\Controller\Adminhtml\Category;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $this->_view->loadLayout();
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Blog Category'));
        $resultPage->setActiveMenu('AHT_Blog::blog_category');
        $resultPage->addBreadcrumb(__('Blog Category'), __('Blog Category'));
        return $resultPage;
    }
}
