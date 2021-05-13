<?php

namespace AHT\Blog\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    public function _construct()
    {
        $this->_init('AHT\Blog\Model\Category','AHT\Blog\Model\ResourceModel\Category');
    }

}
