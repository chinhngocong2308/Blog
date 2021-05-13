<?php
namespace AHT\Blog\Model\Category\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $category;

    public function __construct(\AHT\Blog\Model\Category $category)
    {
        $this->category = $category;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->category->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
?>
