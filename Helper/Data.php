<?php

namespace AHT\Blog\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $_logger;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    protected $userFactory;

    public function __construct(
        \Magento\Framework\Registry $registry,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\User\Model\UserFactory $userFactory
    ) {
        $this->userFactory = $userFactory;
        $this->_registry = $registry;
        $this->_logger = $logger;
        $this->_objectManager = $objectManager;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * @param $id
     * @return array
     */
    public function getParentCatList($id){
        $optionArray = [];
        $catCollection = $this->_objectManager->create('AHT\Blog\Model\ResourceModel\Category\Collection');
        if ((!empty($id)) && ($id != 0)){
            $catCollection = $catCollection->addFieldToFilter('id', ['neq' => $id])
                ->addFieldToFilter('status', ['eq' => 1]);
        }
        if ($id != 1){
            $catCollectionData = $catCollection->getData();
            if (!empty($catCollectionData)){
                foreach ($catCollectionData as $key=> $data){
                    $optionArray[$key]['label'] = $data['title'];
                    $optionArray[$key]['value'] = $data['id'];
                }
            }
        }
        return $optionArray;
    }

    /**
     * @return array
     */
    public function getCatList(){
        $optionArray = [];
        $catCollection = $this->_objectManager->create('AHT\Blog\Model\ResourceModel\Category\Collection');
        $catCollection = $catCollection->addFieldToFilter('status', ['eq' => 1]);
        $catCollectionData = $catCollection->getData();
        if (!empty($catCollectionData)){
            foreach ($catCollectionData as $key=> $data){
                $optionArray[$key]['label'] = $data['title'];
                $optionArray[$key]['value'] = $data['id'];
            }
        }
        return $optionArray;
    }

    public function getPostAuthor($id){
        return $this->userFactory->create()->load($id)->getName();
    }
}