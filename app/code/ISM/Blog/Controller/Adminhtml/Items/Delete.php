<?php

namespace ISM\Blog\Controller\Adminhtml\Items;

class Delete extends \ISM\Blog\Controller\Adminhtml\Items
{

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            try {
                $model = $this->_objectManager->create('ISM\Blog\Model\Events');
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('You deleted the event.'));
                $this->_redirect('ism_blog/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('We can\'t delete event right now. Please review the log and try again.')
                );
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_redirect('ism_blog/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->messageManager->addError(__('We can\'t find a event to delete.'));
        $this->_redirect('ism_blog/*/');
    }
}
