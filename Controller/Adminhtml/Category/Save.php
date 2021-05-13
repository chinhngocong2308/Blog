<?php

namespace AHT\Blog\Controller\Adminhtml\Category;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use AHT\Blog\Model\Category;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

   
    private $categoryFactory;

    /**
     * @var \Rsgitech\News\Api\CategoryRepositoryInterface
     */
    private $categoryRepository;

    protected $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \AHT\Blog\Model\CategoryFactory $categoryFactory = null,
        DataPersistorInterface $dataPersistor,
        \AHT\Blog\Api\CategoryRepositoryInterface $categoryRepository = null
    )
    {
        $this->dataPersistor = $dataPersistor;
        $this->categoryFactory = $categoryFactory
        ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\AHT\Blog\Model\CategoryFactory::class);
        $this->categoryRepository = $categoryRepository
        ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\AHT\Blog\Api\CategoryRepositoryInterface::class);
        $this->_messageManager = $context->getMessageManager();
        $this->_resultFactory = $context->getResultFactory();
        parent::__construct($context);
    }

    protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('AHT_Blog::save');
	}

    public function execute() {
        $categoryData = $this->getRequest()->getParams();
        $model = $this->categoryFactory->create();
        if(isset($categoryData['id'])) {
            $model = $model->load($categoryData['id']);
        }
        try {
            $model->setTitle($categoryData['title']);
            $model->setMetaTitle($categoryData['meta_title']);
            $model->setMetaKeyword($categoryData['meta_keyword']);
            $model->setMetaDescription($categoryData['meta_description']);
            $model->setStatus($categoryData['status']);
            $model->setStore(json_encode($categoryData['store']));
            if (array_key_exists('parent_category', $categoryData)){
                $model->setParentCategory(json_encode($categoryData['parent_category']));
            }elseif(!array_key_exists('parent_category', $categoryData)){
                $model->setParentCategory('["0"]');
            }
            try{
                $model->save();
                $this->_messageManager->addSuccessMessage('Category added succesfully.');
            }catch(\Exception $e){
                $this->_messageManager->addErrorMessage('Something went wrong while saving category');
            }
        } catch (Exception $e) {
            $this->_messageManager->addErrorMessage('Something went wrong '.$e->getMessage());
        }
        $resultRedirect = $this->_resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $resultRedirect->setPath('ahtblog/category/index');
        return $resultRedirect;
    }
}
