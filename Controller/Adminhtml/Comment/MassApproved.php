<?php

namespace AHT\Blog\Controller\Adminhtml\Comment;

class MassApproved extends \Magento\Backend\App\Action {
    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;
    /**
     * @var \AHT\Blog\Model\ResourceModel\Comment\CollectionFactory
     */
    protected $_collectionFactory;

    /**
     * MassApproved constructor.
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \AHT\Blog\Model\ResourceModel\Comment\CollectionFactory $collectionFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \AHT\Blog\Model\ResourceModel\Comment\CollectionFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    public function execute() {
        try{
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $itemsApproved = 0;
            foreach ($collection as $item) {
                $item->setStatus(0);
                $item->save();
                $itemsApproved++;
            }
            $this->messageManager->addSuccess('A total of %1 comment(s) were deleted successfully.', $itemsApproved);
        }catch(Exception $e){
            $this->messageManager->addError('Something went wrong while deleting the comment '.$e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('ahtblog/comment/index');
    }


    protected function _isAllowed() {
        return $this->_authorization->isAllowed('AHT_Blog::view');
    }
}