<?php
namespace ISM\Blog\Block\Page;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class Item extends Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    public function __construct(
        Context $context,
        \Magento\Framework\Registry $registry,
        array $data = [])
    {

        $this->_registry = $registry;
        parent::__construct($context,  $data);
    }
    /**
     * Retrieving custom variable from registry
     * @return string
     */
    public function getPost()
    {
        return $this->_registry->registry('event');
    }
}
