<?php

namespace Ism\Events\Controller\Adminhtml\Items;

class Edit extends \Ism\Events\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $model = $this->_objectManager->create('Ism\Events\Model\Events');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This event no longer exists.'));
                $this->_redirect('ism_events/*');
                return;
            }
        }
        // set entered data if was error when we do save
        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getPageData(true);
        if (!empty($data)) {
            $model->addData($data);
        }
        $this->_coreRegistry->register('current_ism_events_items', $model);
        $this->_initAction();
        if ($model->getId()) {
            $title = __('Edit Event');
        } else {
            $title = __('New Event Create Form');
        }
        $this->_view->getPage()->getConfig()->getTitle()->prepend($title);
        $this->_view->getLayout()->getBlock('items_items_edit');
        $this->_view->renderLayout();
    }
}
