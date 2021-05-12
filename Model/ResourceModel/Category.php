<?php

namespace AHT\Blog\Model\ResourceModel;

class Category extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_idFieldName = 'id';
    protected $_date;
    
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
		\Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        parent::__construct($context);
		$this->_date = $date;
    }
    public function _construct()
    {
        $this->_init("aht_blog_category", "id");
    }

    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $object->setUpdatedAt($this->_date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->date());
        }
        return parent::_beforeSave($object);
    }
}
