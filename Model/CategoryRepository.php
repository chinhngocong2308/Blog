<?php

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data;
use AHT\Blog\Api\CategoryRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use AHT\Blog\Model\ResourceModel\Category as ResourceCategory;
use AHT\Blog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $resource;

    protected $categoryFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataCategoryFactory;

    private $storeManager;

    public function __construct(
        ResourceCategory $resource,
        CategoryFactory $categoryFactory,
        Data\CategoryInterfaceFactory $dataCategoryFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->categoryFactory = $categoryFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCategoryFactory = $dataCategoryFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\AHT\Blog\Api\Data\CategoryInterface $category)
    {
        if ($category->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $category->setStoreId($storeId);
        }
        try {
            $this->resource->save($category);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the category: %1', $exception->getMessage()),
                $exception
            );
        }
        return $category;
    }

    public function getById($Id)
    {
		$category = $this->categoryFactory->create();
        $category->load($Id);
        if (!$category->getId()) {
            throw new NoSuchEntityException(__('Category with id "%1" does not exist.', $Id));
        }
        return $category;
    }
	
    public function delete(\AHT\Blog\Api\Data\CategoryInterface $category)
    {
        try {
            $this->resource->delete($category);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the category: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($Id)
    {
        return $this->delete($this->getById($Id));
    }
}
?>