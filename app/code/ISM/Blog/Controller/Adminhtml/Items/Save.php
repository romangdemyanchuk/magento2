<?php

namespace ISM\Blog\Controller\Adminhtml\Items;

class Save extends \ISM\Blog\Controller\Adminhtml\Items
{
    public function execute()
    {
        if ($this->getRequest()->getPostValue()) {
            try {
                $model = $this->_objectManager->create('ISM\Blog\Model\Events');
                $data = $this->getRequest()->getPostValue();
                $inputFilter = new \Zend_Filter_Input(
                    [],
                    [],
                    $data
                );
                $data = $inputFilter->getUnescaped();
                $id = $this->getRequest()->getParam('id');
                if ($id) {
                    $model->load($id);
                    if ($id != $model->getId()) {
                        throw new \Magento\Framework\Exception\LocalizedException(__('The wrong item is specified.'));
                    }
                }

                $timezone = $this->_objectManager->create('Magento\Framework\Stdlib\DateTime\TimezoneInterface');
                $fromTz = $timezone->getConfigTimezone();
                $toTz = $timezone->getDefaultTimezone();
                $date = new \DateTime('2000-01-01', new \DateTimeZone($fromTz));
                $date->setTimezone(new \DateTimeZone($toTz));
                $data['date'] = $date->format('m/d/Y H:i:s');

                $timezone = $this->_objectManager->create('Magento\Framework\Stdlib\DateTime\DateTime');
                $data['updated_at'] = $timezone->gmtDate();

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
                $this->_objectManager->get('Psr\Log\LoggerInterface')->critical($e);
                $this->_objectManager->get('Magento\Backend\Model\Session')->setPageData($data);
                $this->_redirect('ism_blog/*/edit', ['id' => $this->getRequest()->getParam('id')]);
                return;
            }
        }
        $this->_redirect('ism_blog/*/');
    }
}
