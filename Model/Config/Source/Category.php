<?php

namespace AHT\Blog\Model\Config\Source;

/**
 * Class Category
 * @package AHT\Blog\Model\Config\Source
 */
class Category implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    protected $optArray;


    protected $categoryFactory;


    public function __construct(
        \AHT\Blog\Model\ResourceModel\Category\CollectionFactory $categoryFactory
    ) {
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @return array|null
     * @return Post Category
     */
    public function toOptionArray() {
        if ($this->optArray === null) {
            $collection = $this->categoryFactory->create();
            foreach ($collection as $item) {
                $this->optArray[] = [
                    'label' => $item->getTitle(),
                    'value' => $item->getId(),
                ];
            }
        }

        return $this->optArray;
    }

    /**
     * @return array
     */
    public function toArray() {
        $array = [];
        foreach ($this->toOptionArray() as $item) {
            $array[$item['value']] = $item['label'];
        }
        return $array;
    }


}
