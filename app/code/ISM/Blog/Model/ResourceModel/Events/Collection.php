<?php

namespace ISM\Blog\Model\ResourceModel\Events;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    public function addAttributeToSelect(array $array)
    {
    }
    protected function _construct()
    {
        $this->_init(
            'ISM\Blog\Model\Events',
            'ISM\Blog\Model\ResourceModel\Events'
        );
    }

}
