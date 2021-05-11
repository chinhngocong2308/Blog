<?php
namespace AHT\Blog\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $date;
 
    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }
    
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataNewsRows = [
            [
                'title' => 'Category First',
                'meta_title' => 'Meta Title',
                'status' => 1,
                'meta_keyword' => 'Meta Keyword',
                'meta_description' => 'Meta Description',
                'identifier' => 'category-first',
                'store' => 0,
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
        ];
        
        foreach($dataNewsRows as $data) {
            $setup->getConnection()->insert($setup->getTable('aht_blog_category'), $data);
        }
    }
}
?>