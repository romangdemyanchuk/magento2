<?php

namespace ISM\Blog\Controller\Adminhtml\Items;

use Magento\Framework\App\Request\DataPersistorInterface;

class Save extends \ISM\Blog\Controller\Adminhtml\Items
{
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                $model = $this->_objectManager->create('ISM\Blog\Model\Events');
                $data = $this->getRequest()->getPostValue();
                $id = $this->getRequest()->getParam('form_key');
                if ($id) {
                    $model->load($id);
                }
                $model->setData($data);
                $session = $this->_objectManager->get('Magento\Backend\Model\Session');
                $session->setPageData($model->getData());
                $model->save();
                $this->messageManager->addSuccess(__('You saved the event.'));
                $session->setPageData(false);
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('ism_blog/*/edit', ['id' => $model->getId()]);
                    return;
                }
                $this->_redirect('ism_blog/*/');
                return;
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
                $id = (int)$this->getRequest()->getParam('id');
                if (!empty($id)) {
                    $this->_redirect('ism_blog/*/edit', ['id' => $id]);
                } else {
                    $this->_redirect('ism_blog/*/new');
                }
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError(
                    __('Something went wrong while saving the event data. Please review the error log.')
                );
                $this->_redirect('ism_blog/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('ism_blog/*/');
    }
}
