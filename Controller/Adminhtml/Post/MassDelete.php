<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

class MassDelete extends \Magento\Backend\App\Action {
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;
    /**
     * @var \AHT\Blog\Model\ResourceModel\Post\CollectionFactory
     */
    protected $_collectionFactory;

    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \AHT\Blog\Model\ResourceModel\Post\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Message\ManagerInterface $messageManager
    ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute() {
        try{
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $itemsDelete = 0;
            foreach ($collection as $item) {
                $item->delete();
                $itemsDelete++;
            }
            $this->messageManager->addSuccess('A total of %1 post(s) were deleted successfully.', $itemsDelete);
        }catch(Exception $e){
            $this->messageManager->addError('Something went wrong while deleting the post '.$e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('ahtblog/post/index');
    }

    protected function _isAllowed() {
        return $this->_authorization->isAllowed('AHT_Blog::view');
    }
}