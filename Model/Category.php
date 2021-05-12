<?php

namespace AHT\Blog\Model;

use AHT\Blog\Api\Data\CategoryInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Exception\LocalizedException;


class Category extends \Magento\Framework\Model\AbstractModel implements CategoryInterface, IdentityInterface
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const CACHE_TAG = 'aht_blog';

    public function _construct()
    {
        $this->_init("AHT\Blog\Model\ResourceModel\Category");
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
		return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
	}

	public function getId()
	{
		return parent::getData(self::CATEGORY_ID);
	}

	public function getTitle()
	{
		return $this->getData(self::TITLE);
	}

    public function getMetaDescription()
	{
		return $this->getData(self::METADESCRIPTION);
	}

	public function getMetaTitle()
	{
		return $this->getData(self::METATITLE);
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
		return $this->setData(self::CATEGORY_ID, $id);
	}

	public function setTitle($title)
	{
		return $this->setData(self::TITLE, $title);
	}

	public function setMetaDescription($metadescription)
	{
		return $this->setData(self::METADESCRIPTION, $metadescription);
	}

    public function setMetaTitle($metatitle)
	{
		return $this->setData(self::METATITLE, $metatitle);
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
