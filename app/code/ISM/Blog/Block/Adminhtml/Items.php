<?php

namespace ISM\Blog\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Items extends Container
{
    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'items';
        $this->_headerText = __('Items');
        $this->_addButtonLabel = __('Add New Item1');
        parent::_construct();
    }
}
