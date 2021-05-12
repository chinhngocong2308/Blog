<?php
namespace AHT\Blog\Model\Comment\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    protected $comment;

    public function __construct(\AHT\Blog\Model\Comment $comment)
    {
        $this->comment = $comment;
    }

    public function toOptionArray()
    {
        $availableOptions = $this->comment->getAvailableStatuses();
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
