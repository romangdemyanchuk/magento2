<?php
namespace ISM\Blog\Block;

use ISM\Blog\Model\ResourceModel\Events\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class Items extends Template
{
    protected $_productCollectionFactory;
    protected $_categoryFactory;
    protected $_registry;

    public function __construct(
        Context $context,
        \Magento\Framework\Registry $registry,
        CollectionFactory $productCollectionFactory,
        array $data = [])
    {
        $this->_registry = $registry;
        $this->_productCollectionFactory = $productCollectionFactory;
        parent::__construct($context,  $data);
    }

    /**
     * @return \ISM\Blog\Model\ResourceModel\Events\Collection
     */
    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create()
            ->addFieldToSelect('*')
            ->setOrder('title', 'ASC');
        return $collection->load();
    }
    /**
     * @return \ISM\Blog\Model\ResourceModel\Events\Collection
     */
    public function getId()
    {
        $collection = $this->_productCollectionFactory->create()
            ->addFieldToSelect('*')
            ->setOrder('title', 'ASC');
        return $collection->entity_id;
    }
}
