<?php

namespace AHT\Blog\Block\Adminhtml\Category\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{
    /**
     * @return Form
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'action' => $this->getUrl('ahtblog/category/save'),
                ],
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
