<?php

namespace Ism\Events\Model;

use Magento\Framework\Model\AbstractModel;

class Events extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Ism\Events\Model\ResourceModel\Events');
    }
}
