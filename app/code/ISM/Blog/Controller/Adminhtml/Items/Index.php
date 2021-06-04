<?php
namespace ISM\Blog\Controller\Adminhtml\Items;

class Index extends \ISM\Blog\Controller\Adminhtml\Items
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
        $resultPage->setActiveMenu('ISM_Blog::test');
        $resultPage->getConfig()->getTitle()->prepend(__('Create Event Admin Page'));
        $resultPage->addBreadcrumb(__('Manage'), __('Manage'));
        $resultPage->addBreadcrumb(__('Date'), __('Date'));
        return $resultPage;
    }
}
