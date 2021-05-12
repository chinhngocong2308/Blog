<?php
namespace AHT\Blog\Controller\Adminhtml\Comment;

use Magento\Backend\App\Action\Context;
use AHT\Blog\Api\CommentRepositoryInterface as CommentRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use AHT\Blog\Api\Data\CommentInterface;

class InlineEdit extends \Magento\Backend\App\Action
{
    protected $commentRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        CommentRepository $commentRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->commentRepository = $commentRepository;
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

        $commentItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($commentItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($commentItems) as $commentId) {
            $comment = $this->commentRepository->getById($commentId);
            try {
                $commentData = $commentItems[$commentId];
                $extendedCommentData = $comment->getData();
                $this->setCommentData($comment, $extendedCommentData, $commentData);
                $this->commentRepository->save($comment);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithCommentId($comment, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithCommentId($comment, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithCommentId(
                    $comment,
                    __('Something went wrong while saving the comment.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    protected function getErrorWithCommentId(CommentInterface $comment, $errorText)
    {
        return '[Comment ID: ' . $comment->getId() . '] ' . $errorText;
    }

    public function setCommentData(\AHT\Blog\Model\Comment $comment, array $extendedCommentData, array $commentData)
    {
        $comment->setData(array_merge($comment->getData(), $extendedCommentData, $commentData));
        return $this;
    }
}
