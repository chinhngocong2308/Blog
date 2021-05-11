<?php

namespace AHT\Blog\Model;


class Category extends \Magento\Framework\Model\AbstractModel
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    public function _construct()
    {
        $this->_init("AHT\Blog\Model\ResourceModel\Category");
    }
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }
}
