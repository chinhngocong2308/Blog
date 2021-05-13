<?php

namespace AHT\Blog\Ui\BlogPost\Form;

class ProductDataProvider extends \Magento\Catalog\Ui\DataProvider\Product\ProductDataProvider
{
    public function getCollection()
    {
        $collection = parent::getCollection();

        return $collection->addAttributeToSelect('status','1')->addAttributeToSelect('visibility',4);
    }
}
