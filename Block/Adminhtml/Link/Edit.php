<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/23/2016
 * Time: 12:32 AM
 */

namespace AAllen\MenuLink\Block\Adminhtml\Link;


use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;
use Magento\Framework\Phrase;
use Magento\Framework\Registry;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(Context $context, Registry $registry, array $data)
    {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initiate blog post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'link_id';
        $this->_blockGroup = 'AAllen_MenuLink';
        $this->_controller = 'adminhtml_link';

        if ($this->_isAllowedAction('AAllen_MenuLink::save')) {
            $this->buttonList->update('save', 'label', __('Save Menu Link'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('delete');
        }

        parent::_construct();

    }

    /**
     * Retrieve text for header element depending on loaded link
     *
     * @return Phrase
     */
    public function getHeaderText()
    {
        if ($this->_coreRegistry->registry('menulink_link')->getId()) {
            return __("Edit Link '%1'", $this->escapeHtml($this->_coreRegistry->registry('menulink_link')->getName()));
        } else {
            return __('New Link');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "save and Continue" button
     * tab_id will be replaced by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('menulink/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}