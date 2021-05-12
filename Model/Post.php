<?php

namespace AHT\Blog\Model;

class Post extends \Magento\Framework\Model\AbstractModel
{
    
	const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    const CACHE_TAG = 'aht_blog';

    public function _construct()
    {
        $this->_init("AHT\Blog\Model\ResourceModel\Post");
    }

    public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}
	
	public function getAvailableStatuses()
	{
		return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
	}
}
