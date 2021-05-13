<?php

namespace AHT\Blog\Model\Config\Source;

/**
 * Class Author
 * @package AHT\Blog\Model\Config\Source
 */
class Author implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    protected $optArray;

    /**
     * @var \Magento\User\Model\ResourceModel\User\CollectionFactory
     */
    protected $authorFactory;

    /**
     * Author constructor.
     * @param \Magento\User\Model\ResourceModel\User\CollectionFactory $authorFactory
     */
    public function __construct(
        \Magento\User\Model\ResourceModel\User\CollectionFactory $authorFactory
    ) {
        $this->authorFactory = $authorFactory;
    }

    /**
     * @return array|null
     * @return Post Author
     */
    public function toOptionArray() {
        if ($this->optArray === null) {
            $collection = $this->authorFactory->create();
            foreach ($collection as $item) {
                $this->optArray[] = [
                    'label' => $item->getName(),
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
