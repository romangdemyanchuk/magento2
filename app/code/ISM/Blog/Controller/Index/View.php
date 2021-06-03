<?php
declare(strict_types=1);

namespace ISM\Blog\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\ResultInterface;
use ISM\Blog\Model\ResourceModel\Events\CollectionFactory;
use Magento\Framework\View\Result\PageFactory;

/**
 * Custom page for storefront. Needs to be accessible by POST because of the store switching.
 */
class View extends Action
{
    /**
     * @var \Magento\Framework\Registry
     */

    protected $_registry;

    /**
     * @var Context
     */
    protected $context;
    /**
     * @var ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * @var PageHelper
     */
    private $pageHelper;
    private $deploymentConfigMock;

    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param RequestInterface $request
     * @param PageHelper $pageHelper
     * @param CollectionFactory $collectionFactory
     * @param \Magento\Framework\Registry $registry
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        \Magento\Framework\Registry $registry,
        RequestInterface $request,
        CollectionFactory $collectionFactory,
        PageHelper $pageHelper,
        ForwardFactory $resultForwardFactory,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_registry = $registry;
        $this->request = $request;
        $this->pageHelper = $pageHelper;
        $this->context = $context;
        $this->collectionFactory = $collectionFactory;
        $this->resultForwardFactory = $resultForwardFactory;
        $this->resultPageFactory =  $resultPageFactory;
    }

    /**
     * View CMS page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            $collection = $this->collectionFactory->create()
                ->addFieldToFilter('entity_id', $id)
                ->load();
            $result = $collection->getItemById($id);
        } catch (\Exception $e) {
            $resultForward = $this->resultForwardFactory->create();
            return $resultForward->forward('noroute');

        }

        $this->_registry->register('event', $result);
        $resultPage = $this->resultPageFactory->create();
        return  $resultPage;
    }
}
