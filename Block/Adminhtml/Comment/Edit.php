<?php

namespace AHT\Blog\Block\Adminhtml\Comment;

use Magento\Backend\Block\Widget\Form\Container;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class Edit
 * @package Moshi\Blog\Block\Adminhtml\Comment
 */
class Edit extends Container
{
    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * Edit constructor.
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_comment';
        $this->_blockGroup = 'AHT_Blog';

        parent::_construct();

        $this->buttonList->update('save', 'label', __('Save Comment'));
        $this->buttonList->update('delete', 'label', __('Delete Comment'));
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    public function getHeaderText()
    {
        return __('Blog Comment');
    }
}
