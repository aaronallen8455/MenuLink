<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/19/2016
 * Time: 10:08 PM
 */

namespace AAllen\MenuLink\Controller\Adminhtml\Link;



use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return Page
     */
    public function execute()
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('AAllen_MenuLink::links');
        $resultPage->addBreadcrumb(__('Menu Links'), __('Menu Links'));
        $resultPage->addBreadcrumb(__('Manage Menu Links'), __('Manage Menu Links'));
        $resultPage->getConfig()->getTitle()->prepend(__('Menu Links'));

        return $resultPage;
    }

    /**
     * Is the user allowed to view the blog post grid.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AAllen_MenuLink::links');
    }
}