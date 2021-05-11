<?php

namespace AHT\Blog\Helper;

use Magento\Store\Model\ScopeInterface;

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

    const XML_PATH_AHT_BLOG = 'aht_blog/';

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

    public function getPostAuthor($id)
    {
        return $this->userFactory->create()->load($id)->getName();
    }

    /**
     * @param haven't
     * @return array
     */

    // Get category post 
    public function getCatList()
    {
        $optionArray = [];
        $catCollection = $this->_objectManager->create('AHT\Blog\Model\ResourceModel\Category\Collection');
        $catCollection = $catCollection->addFieldToFilter('status', ['eq' => 1]);
        $catCollectionData = $catCollection->getData();
        if (!empty($catCollectionData)) {
            foreach ($catCollectionData as $key => $data) {
                $optionArray[$key]['label'] = $data['title'];
                $optionArray[$key]['value'] = $data['id'];
            }
        }
        return $optionArray;
    }
    /**
     * @param $id
     * @return array
     */
    // Get category parent
    public function getParentCatList($id)
    {
        $optionArray = [];
        $catCollection = $this->_objectManager->create('AHT\Blog\Model\ResourceModel\Category\Collection');
        if ((!empty($id)) && ($id != 0)) {
            $catCollection = $catCollection->addFieldToFilter('id', ['neq' => $id])
                ->addFieldToFilter('status', ['eq' => 1]);
        }
        if ($id != 1) {
            $catCollectionData = $catCollection->getData();
            if (!empty($catCollectionData)) {
                foreach ($catCollectionData as $key => $data) {
                    $optionArray[$key]['label'] = $data['title'];
                    $optionArray[$key]['value'] = $data['id'];
                }
            }
        }
        return $optionArray;
    }

    public function getConfigValue($field, $storeCode = null)
	{
		return $this->scopeConfig->getValue($field, ScopeInterface::SCOPE_STORE, $storeCode);
	}

	public function getGeneralConfig($fieldid, $storeCode = null)
	{
		return $this->getConfigValue(self::XML_PATH_AHT_BLOG.'general/'.$fieldid, $storeCode);
	}

	public function getStorefrontConfig($fieldid, $storeCode = null)
	{
		return $this->getConfigValue(self::XML_PATH_AHT_BLOG.'storefront/'.$fieldid, $storeCode);
	}

}
