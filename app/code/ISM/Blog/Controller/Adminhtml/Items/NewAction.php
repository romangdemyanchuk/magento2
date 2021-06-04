<?php
namespace ISM\Blog\Controller\Adminhtml\Items;

class NewAction extends \ISM\Blog\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
