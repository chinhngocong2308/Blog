<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

use AHT\Blog\Model\PostFactory;
use Magento\Framework\Registry;

class Grid extends \Magento\Backend\App\Action
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        Registry $registry,
        postFactory $postFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Session\SessionManagerInterface $coreSession
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->postFactory = $postFactory;
        $this->_coreSession = $coreSession;
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $postId = $this->getRequest()->getParam('id');
        $model= $this->postFactory->create();
        $model->load($postId);
        $this->_coreRegistry->register('post', $model);
        $resultPage = $this->resultPageFactory->create();
        return $resultPage;
    }
}
