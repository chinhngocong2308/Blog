<?php

namespace AHT\Blog\Ui\BlogPost\Form;

use AHT\Blog\Model\ResourceModel\Post\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;


class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    protected $dataPersistor;

    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $postCollectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->meta = $this->prepareMeta($this->meta);
    }


    public function prepareMeta(array $meta) {
        return $meta;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $post) {
            $post = $post->load($post->getId());
            $data = $post->getData();
            $category = json_decode($data['category_id']);
            $data['category_id'] = $category;
            $store = json_decode($data['stores']);
            $data['stores'] = $store;
            /*images*/
            $image = json_decode($data['image']);
            $imaArr = [];
            if(!empty($image)){
                foreach($image as $key => $img){
                    $imaArr[] = (array)$img;
                }
            }
            $data['image'] = $imaArr;
            $data['data'] = ['links' => []];
            $items = [];
           
            $postId = [];
            if (!empty($postData)){
                foreach ($postData as $newData){
                    $postId[] = (array)$newData;
                }
            }
            $this->loadedData[$post->getId()]= $data;
        }
            // echo'<pre>';
            // print_r($data);
            // exit();
        return $this->loadedData;
    }
}
