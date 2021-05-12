<?php
namespace AHT\Blog\Controller\Adminhtml\Category;

use Magento\Backend\App\Action\Context;
use AHT\Blog\Api\CategoryRepositoryInterface as CategoryRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Blog\Api\Data\CategoryInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $categoryRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        CategoryRepository $categoryRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->categoryRepository = $categoryRepository;
        $this->jsonFactory = $jsonFactory;
    }
	
	/**
     * Authorization level
     *
     * @see _isAllowed()
     */
	protected function _isAllowed()
	{
		return $this->_authorization->isAllowed('AHT_Post::save');
	}

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $categoryItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($categoryItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($categoryItems) as $categoryId) {
            $category = $this->categoryRepository->getById($categoryId);
            try {
                $categoryData = $categoryItems[$categoryId];
                $extendedCategoryData = $category->getData();
                $this->setCategoryData($category, $extendedCategoryData, $categoryData);
                $this->categoryRepository->save($category);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithCategoryId($category, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithCategoryId($category, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithCategoryId(
                    $category,
                    __('Something went wrong while saving the category.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithCategoryId(CategoryInterface $category, $errorText)
    {
        return '[Category ID: ' . $category->getId() . '] ' . $errorText;
    }

    public function setCategoryData(\AHT\Blog\Model\Category $category, array $extendedCategoryData, array $categoryData)
    {
        $category->setData(array_merge($category->getData(), $extendedCategoryData, $categoryData));
        return $this;
    }
}
