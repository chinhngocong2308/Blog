<?php

namespace AHT\Blog\Controller\Adminhtml\Category;

use AHT\Blog\Model\CategoryFactory;
use Magento\Framework\Registry;

/**
 * Class Edit
 * @package AHT\Blog\Controller\Adminhtml\Category
 */
class Edit extends \Magento\Backend\App\Action
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Add constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param Registry $registry
     * @param CategoryFactory $categoryFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Session\SessionManagerInterface $coreSession
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $registry,
        categoryFactory $categoryFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Session\SessionManagerInterface $coreSession
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->categoryFactory = $categoryFactory;
        $this->_coreSession = $coreSession;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $categoryId = $this->getRequest()->getParam('id');
        $model= $this->categoryFactory->create();
        $model->load($categoryId);
        $this->_coreRegistry->register('category', $model);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_Blog::aht_blog_edit');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Blog'));
        return $resultPage;
    }
}
