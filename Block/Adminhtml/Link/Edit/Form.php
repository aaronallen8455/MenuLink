<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/23/2016
 * Time: 12:46 AM
 */

namespace AAllen\MenuLink\Block\Adminhtml\Link\Edit;


use AAllen\MenuLink\Model\Link;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;
use Magento\Store\Model\System\Store;

class Form extends Generic
{
    /**
     * @var Store
     */
    protected $_systemStore;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param Store $systemStore
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        Store $systemStore,
        array $data
    )
    {
        $this->_systemStore = $systemStore;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('link_form');
        $this->setTitle(__('Link Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var Link $model */
        $model = $this->_coreRegistry->registry('menulink_link');

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('link_');

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getLinkId()) {
            $fieldset->addField('link_id', 'hidden', ['name' => 'link_id']);
        }

        $fieldset->addField(
            'name',
            'text',
            ['name' => 'name', 'label' => __('Link Text'), 'title' => __('Link Text'), 'required' => true]
        );

        $fieldset->addField(
            'url',
            'text',
            [
                'name' => 'url',
                'label' => __('URL'),
                'title' => __('URL'),
                'required' => true,
                //'class' => 'validate-xml-identifier',
                'note' => 'Can be an absolute or relative path.'
            ]
        );

        $fieldset->addField(
            'target',
            'select',
            [
                'label' => __('Target'),
                'title' => __('Target'),
                'name' => 'target',
                'required' => true,
                'options' => ['1' => '_top', '2' => '_blank']
            ]
        );

        $fieldset->addField(
            'position',
            'text',
            [
                'label' => __('Position'),
                'title' => __('Position'),
                'name' => 'position',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'css',
            'text',
            [
                'label' => __('CSS Class'),
                'title' => __('CSS Class'),
                'name' => 'css',
                'required' => false,
                'note' => 'Additional CSS classes.'
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'title' => __('Status'),
                'name' => 'is_active',
                'required' => true,
                'options' => ['1' => __('Enabled'), '0' => __('Disabled')]
            ]
        );
        if (!$model->getId()) {
            $model->setData('is_active', '1');
        }

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}