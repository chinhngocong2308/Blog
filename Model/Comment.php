<?php

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data\CommentInterface;
use Magento\Framework\DataObject\IdentityInterface;


class Comment extends \Magento\Framework\Model\AbstractModel implements CommentInterface, IdentityInterface
{
    const STATUS_APPROVED = 1;
    const STATUS_DISAPPROVED = 0;

    const CACHE_TAG = 'aht_blog';

    public function _construct()
    {
        $this->_init("AHT\Blog\Model\ResourceModel\Comment");
    }
    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];
		return $values;
	}

	public function getAvailableStatuses()
	{
		return [self::STATUS_APPROVED => __('APPROVED'), self::STATUS_DISAPPROVED => __('DISAPPROVED')];
	}

	public function getId()
	{
		return parent::getData(self::COMMENT_ID);
	}

	public function getUserName()
	{
		return $this->getData(self::USERNAME);
	}

    public function getEmail()
	{
		return $this->getData(self::EMAIL);
	}

	public function getComment()
	{
		return $this->getData(self::COMMENT);
	}

	public function getStatus()
	{
		return $this->getData(self::STATUS);
	}

	public function getCreatedAt()
	{
		return $this->getData(self::CREATED_AT);
	}

	public function getUpdatedAt()
	{
		return $this->getData(self::UPDATED_AT);
	}

	public function setId($id)
	{
		return $this->setData(self::COMMENT_ID, $id);
	}

	public function setUserName($username)
	{
		return $this->setData(self::USERNAME, $username);
	}

	public function setEmail($email)
	{
		return $this->setData(self::EMAIL, $email);
	}

    public function setComment($comment)
	{
		return $this->setData(self::COMMENT, $comment);
	}

	public function setStatus($status)
	{
		return $this->setData(self::STATUS, $status);
	}

	public function setCreatedAt($created_at)
	{
		return $this->setData(self::CREATED_AT, $created_at);
	}

	public function setUpdatedAt($updated_at)
	{
		return $this->setData(self::UPDATED_AT, $updated_at);
	}
}
