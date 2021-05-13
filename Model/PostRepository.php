<?php

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data;
use AHT\Blog\Api\PostRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use AHT\Blog\Model\ResourceModel\Post as ResourcePost;
use AHT\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class PostRepository implements PostRepositoryInterface
{
    protected $resource;

    protected $postFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataPostFactory;

    private $storeManager;

    public function __construct(
        ResourcePost $resource,
        PostFactory $postFactory,
        Data\PostInterfaceFactory $dataPostFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->postFactory = $postFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataPostFactory = $dataPostFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\AHT\Blog\Api\Data\PostInterface $post)
    {
        if ($post->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $post->setStoreId($storeId);
        }
        try {
            $this->resource->save($post);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the post: %1', $exception->getMessage()),
                $exception
            );
        }
        return $post;
    }

    public function getById($Id)
    {
		$post = $this->postFactory->create();
        $post->load($Id);
        if (!$post->getId()) {
            throw new NoSuchEntityException(__('Post with id "%1" does not exist.', $Id));
        }
        return $post;
    }
	
    public function delete(\AHT\Blog\Api\Data\PostInterface $post)
    {
        try {
            $this->resource->delete($post);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the post: %1',
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