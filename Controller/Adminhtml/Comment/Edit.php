<?php

namespace AHT\Blog\Controller\Adminhtml\Comment;

use AHT\Blog\Model\CommentFactory;
use Magento\Framework\Registry;

/**
 * Class Edit
 * @package AHT\Blog\Controller\Adminhtml\Comment
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
     * @param CommentFactory $commentFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Session\SessionManagerInterface $coreSession
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $registry,
        commentFactory $commentFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Session\SessionManagerInterface $coreSession
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->commentFactory = $commentFactory;
        $this->_coreSession = $coreSession;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $commentId = $this->getRequest()->getParam('id');
        $model= $this->commentFactory->create();
        $model->load($commentId);
        $this->_coreRegistry->register('comment', $model);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_Blog::aht_blog_edit');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Blog'));
        return $resultPage;
    }
}
