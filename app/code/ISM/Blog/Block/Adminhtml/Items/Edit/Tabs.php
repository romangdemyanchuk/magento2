<?php

namespace ISM\Blog\Block\Adminhtml\Items\Edit;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('ism_blog_items_edit_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Event'));
    }
}
