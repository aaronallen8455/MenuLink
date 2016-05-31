<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/22/2016
 * Time: 11:56 PM
 */

namespace AAllen\MenuLink\Controller\Adminhtml\Link;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param Registry $registry
     */
    public function __construct(Action\Context $context, PageFactory $resultPageFactory, Registry $registry)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AAllen_MenuLink::save');
    }

    /**
     * Init actions
     *
     * @return Page
     */
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AAllen_MenuLink::links')
            ->addBreadCrumb(__('Menu Link'), __('Menu Link'))
            ->addBreadCrumb(__('Manage Menu Links'), __('Manage Menu Links'));
        return $resultPage;
    }

    /**
     * Edit Blog post
     *
     * @return Redirect|Page
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('link_id');
        $model = $this->_objectManager->create('AAllen\MenuLink\Model\Link');

        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This link no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_objectManager->get('Magento\Backend\Model\Session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('menulink_link', $model);
        
        /** @var Page $resultPage */
        $resultPage = $this->_initAction();
        $resultPage->addBreadcrumb(
            $id ? __('Edit Menu Link') : __('New Menu Link'),
            $id ? __('Edit Menu Link') : __('New Menu Link')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Menu Links'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Menu Link'));
        return $resultPage;
    }

}