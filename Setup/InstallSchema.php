<?php

namespace AHT\Blog\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        /*table for managing blog post*/
        if (!$installer->tableExists('aht_blog_post')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_blog_post')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [
                        'identity'  => true,
                        'unsigned'  => true,
                        'nullable'  => false,
                        'primary'   => true,
                    ],
                    'Id'
                )
                
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Blog Title'
                )
                ->addColumn(
                    'meta_keyword',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Meta Keyword'
                )
                ->addColumn(
                    'meta_title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Meta Title'
                )
                ->addColumn(
                    'meta_description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Meta Description'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'status'
                )
                ->addColumn(
                    'identifier',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Identifier'
                )
                ->addColumn(
                    'content_heading',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Content Heading'
                )
                ->addColumn(
                    'content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '2M',
                    [
                        'nullable'  => false,
                    ],
                    'Content'
                )
                ->addColumn(
                    'short_content',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '2M',
                    [
                        'nullable'  => false,
                    ],
                    'Short Content'
                )
                ->addColumn(
                    'stores',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Stores'
                )
                ->addColumn(
                    'image',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Image'
                )
                ->addColumn(
                    'author',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Author'
                )
                ->addColumn(
                    'category_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Blog Category'
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '2M',
                    [
                        'nullable'  => false,
                    ],
                    'Product Id'
                )
                ->addColumn(
                    'post_product',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Post Products'
                )
                ->addColumn(
                    'sticky',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Sticky'
                )
                ->addColumn(
                    'media_gallery',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Media Gallery'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )->addColumn(
                    'published_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Published At'
                );
            $installer->getConnection()->createTable($table);
        }

        /*table for aht blog category*/
        if (!$installer->tableExists('aht_blog_category')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_blog_category')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [
                        'identity'  => true,
                        'unsigned'  => true,
                        'nullable'  => false,
                        'primary'   => true,
                    ],
                    'Id'
                )
                ->addColumn(
                    'title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Category Title'
                )
                ->addColumn(
                    'meta_title',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Meta Title'
                )
                ->addColumn(
                    'meta_keyword',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Meta Keyword'
                )
                ->addColumn(
                    'meta_description',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Meta Description'
                )
                ->addColumn(
                    'identifier',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Identifier'
                )
                ->addColumn(
                    'post_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Post Id'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Status'
                )
                ->addColumn(
                    'parent_category',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Parent Category'
                )
                ->addColumn(
                    'store',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Store Id'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                );

            $installer->getConnection()->createTable($table);
        }

        /*table for manage blog comment*/
        if (!$installer->tableExists('aht_blog_comment')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_blog_comment')
            )
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [
                        'identity'  => true,
                        'unsigned'  => true,
                        'nullable'  => false,
                        'primary'   => true,
                    ],
                    'Id'
                )
                ->addColumn(
                    'post_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Post Id'
                )
                ->addColumn(
                    'parent_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [
                        'nullable'  => true,
                    ],
                    'Parent Id'
                )
                ->addColumn(
                    'username',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Username'
                )
                ->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Email'
                )
                ->addColumn(
                    'comment',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    [
                        'nullable'  => false,
                    ],
                    'Comment'
                )
                ->addColumn(
                    'status',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable'  => false,
                    ],
                    'Status'
                )
                ->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                );

            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
