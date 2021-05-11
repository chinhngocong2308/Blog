<?php

namespace AHT\Blog\Model\ResourceModel;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'id';

    public function _construct()
    {
        $this->_init("aht_blog_category", "id");
    }
}
