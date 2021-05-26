<?php

namespace Ism\Events\Model\ResourceModel\Events;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'title';
    protected function _construct()
    {
        $this->_init(
            'Ism\Events\Model\Events',
            'Ism\Events\Model\ResourceModel\Events'
        );
    }
}
