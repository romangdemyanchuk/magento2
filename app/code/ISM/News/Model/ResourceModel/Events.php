<?php

namespace Ism\Events\Model\ResourceModel;

class Events extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('ism_events_table', 'title');
    }
}
