<?php

namespace Ism\Events\Controller\Adminhtml\Items;

class NewAction extends \Ism\Events\Controller\Adminhtml\Items
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
