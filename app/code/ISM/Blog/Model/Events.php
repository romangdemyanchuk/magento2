<?php

namespace ISM\Blog\Model;

use Magento\Framework\Model\AbstractModel;

class Events extends AbstractModel
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('ISM\Blog\Model\ResourceModel\Events');
    }
}
