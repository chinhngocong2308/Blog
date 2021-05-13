<?php

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data;
use AHT\Blog\Api\CommentRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use AHT\Blog\Model\ResourceModel\Comment as ResourceComment;
use Magento\Store\Model\StoreManagerInterface;

class CommentRepository implements CommentRepositoryInterface
{
    protected $resource;

    protected $commentFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataCommentFactory;

    private $storeManager;

    public function __construct(
        ResourceComment $resource,
        CommentFactory $commentFactory,
        Data\CommentInterfaceFactory $dataCommentFactory,
        DataObjectHelper $dataObjectHelper,
		DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
		$this->commentFactory = $commentFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataCommentFactory = $dataCommentFactory;
		$this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\AHT\Blog\Api\Data\CommentInterface $comment)
    {
        if ($comment->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $comment->setStoreId($storeId);
        }
        try {
            $this->resource->save($comment);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the comment: %1', $exception->getMessage()),
                $exception
            );
        }
        return $comment;
    }

    public function getById($Id)
    {
		$comment = $this->commentFactory->create();
        $comment->load($Id);
        if (!$comment->getId()) {
            throw new NoSuchEntityException(__('Comment with id "%1" does not exist.', $Id));
        }
        return $comment;
    }
	
    public function delete(\AHT\Blog\Api\Data\CommentInterface $comment)
    {
        try {
            $this->resource->delete($comment);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the comment: %1',
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