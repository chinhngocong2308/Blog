<?php

namespace AHT\Blog\Controller\Adminhtml\Post;

use Magento\Framework\App\Filesystem\DirectoryList;


class Exportdata extends \Magento\Backend\App\Action
{
    protected $uploaderFactory;

    protected $_postFactory; 

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Response\Http\FileFactory $fileFactory,
        \Magento\Framework\Filesystem $filesystem,
        \AHT\Blog\Model\postFactory $postFactory // This is returns Collaction of Data

    ) {
       parent::__construct($context);
       $this->_fileFactory = $fileFactory;
       $this->_postFactory = $postFactory;
       $this->directory = $filesystem->getDirectoryWrite(DirectoryList::VAR_DIR); // VAR Directory Path
       parent::__construct($context);
    }

    public function execute()
    {   
        $name = date('m-d-Y-H-i-s');
        $filepath = 'export/export-data-' .$name. '.csv'; // at Directory path Create a Folder Export and FIle
        $this->directory->create('export');

        $stream = $this->directory->openFile($filepath, 'w+');
        $stream->lock();

        //column name dispay in your CSV 

        $columns = ['id','title','meta_keyword','meta_title','meta_description','content','short_content','image','created_at','updated_at','published_at'];

            foreach ($columns as $column) 
            {
                $header[] = $column; //storecolumn in Header array
            }

        $stream->writeCsv($header);

        $location = $this->_postFactory->create();
        $location_collection = $location->getCollection(); // get Collection of Table data 

        foreach($location_collection as $item){

            $itemData = [];

            // column name must same as in your Database Table 

            $itemData[] = $item->getData('id');
            $itemData[] = $item->getData('title');
            $itemData[] = $item->getData('meta_keyword');
            $itemData[] = $item->getData('meta_title');
            $itemData[] = $item->getData('meta_description');
            $itemData[] = $item->getData('content');
            $itemData[] = $item->getData('short_content');
            $itemData[] = $item->getData('image');
            $itemData[] = $item->getData('created_at');
            $itemData[] = $item->getData('updated_at');
            $itemData[] = $item->getData('published_at');

            $stream->writeCsv($itemData);

        }

        $content = [];
        $content['type'] = 'filename'; // must keep filename
        $content['value'] = $filepath;
        $content['rm'] = '1'; //remove csv from var folder

        $csvfilename = 'aht_blog_post-import-'.$name.'.csv';
        return $this->_fileFactory->create($csvfilename, $content, DirectoryList::VAR_DIR);

    }


}