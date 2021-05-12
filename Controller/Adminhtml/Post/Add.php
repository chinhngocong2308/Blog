<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

use AHT\Blog\Model\PostFactory;
use Magento\Framework\Registry;

/**
 * Class Add
 * @package AHT\Blog\Controller\Adminhtml\Post
 */
class Add extends \Magento\Backend\App\Action
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    protected $helper;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $registry,
        postFactory $postFactory,
        \AHT\Blog\Helper\Data $helper,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Session\SessionManagerInterface $coreSession
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->postFactory = $postFactory;
        $this->_coreSession = $coreSession;
        $this->helper = $helper;
        $this->_messageManager = $context->getMessageManager();
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute() {
        /*check for category exist or not*/
        $categoryList = $this->helper->getCatList();
        if (empty($categoryList)){
            $this->_messageManager->addErrorMessage('Please add category for blog post.');
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('ahtblog/post/index');
            return $resultRedirect;
        }
        $postId = $this->getRequest()->getParam('id');
        $model= $this->postFactory->create();
        $model->load($postId);
        $this->_coreRegistry->register('post', $model);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AHT_Blog::aht_post');
        $resultPage->getConfig()->getTitle()->prepend(__('Add Post'));
        return $resultPage;
    }
}
