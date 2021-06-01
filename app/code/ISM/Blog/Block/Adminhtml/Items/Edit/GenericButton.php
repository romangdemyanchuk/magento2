<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ISM\Blog\Block\Adminhtml\Items\Edit;

use Magento\Backend\Block\Widget\Context;
use ISM\Blog\Model\ResourceModel\Events\CollectionFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class GenericButton
 */
abstract class GenericButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory
    ) {
        $this->context = $context;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Return CMS page ID
     *
     * @return int|null
     */
    public function getEventId()
    {
        try {
            $eventId = $this->context->getRequest()->getParam('id');
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('entity_id', $eventId)
                ->load();
            return $collection->getFirstItem()->getEntityId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
