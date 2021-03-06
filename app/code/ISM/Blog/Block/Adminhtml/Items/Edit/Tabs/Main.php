<?php

namespace ISM\Blog\Block\Adminhtml\Items\Edit\Tabs;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

class Main extends Generic implements TabInterface
{
    protected $_wysiwygConfig;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        array $data = []
    )
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Event Information');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Event Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare form before rendering HTML
     *
     * @return $this
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_ism_blog_items');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('item_');

        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $timeFormat = $this->_localeDate->getTimeFormat(\IntlDateFormatter::SHORT);

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('New post')]);
        if ($model->getId()) {
            $fieldset->addField('entity_id', 'hidden', ['name' => 'entity_id']);
        }
        $fieldset->addField(
            'title',
            'text',
            ['name' => 'title', 'label' => __('Title'), 'title' => __('Title'), 'required' => true]
        );
        $fieldset->addField(
            'content',
            'textarea',
            ['name' => 'content', 'label' => __('Content'), 'title' => __('Content'), 'required' => true]
        );
        $fieldset->addField(
            'announce',
            'textarea',
            ['name' => 'announce', 'label' => __('Announce'), 'title' => __('Announce'), 'required' => true]
        );
        $fieldset->addField(
            'published_date',
            'date',
            ['name' => 'published_date', 'label' => __('Published Date'), 'title' => __('Published Date'),
                'required' => true, 'date_format' => $dateFormat]
        );

        $fieldset->addField(
            'is_published',
            'select',
            [ 'label' => __('Published'), 'name'=> 'is_published',
            'values' => [
                ['label' => 'Yes', 'value' => 1],
                ['label' => 'No', 'value' => 0],
            ]
        ]);
        $form->setValues($model->getData());
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
