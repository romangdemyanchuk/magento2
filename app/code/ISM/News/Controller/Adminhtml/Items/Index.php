<?php

namespace Ism\Events\Controller\Adminhtml\Items;

class Index extends \Ism\Events\Controller\Adminhtml\Items
{
    /**
     * Items list.
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Ism_Events::test');
        $resultPage->getConfig()->getTitle()->prepend(__('Create Event Admin Page'));
        $resultPage->addBreadcrumb(__('Manage'), __('Manage'));
        $resultPage->addBreadcrumb(__('Date'), __('Date'));
        return $resultPage;
    }
}
