<?php

namespace AHT\Blog\Model\ResourceModel\Post;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    public function _construct()
    {
        $this->_init(
            'AHT\Blog\Model\Post',
            'AHT\Blog\Model\ResourceModel\Post'
        );
    }
}
