<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/23/2016
 * Time: 12:21 AM
 */

namespace AAllen\MenuLink\Controller\Adminhtml\Link;


use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;

class Delete extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('AAllen_MenuLink::delete');
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('link_id');
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_objectManager->create('AAllen\MenuLink\Model\Link');
                $model->load($id);
                $title = $model->getName();
                try {
                    $model->delete();
                    $this->messageManager->addSuccess(__('The post \'%1\' has been deleted.'), $title);
                } catch (LocalizedException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\RuntimeException $e) {
                    $this->messageManager->addError($e->getMessage());
                } catch (\Exception $e) {
                    $this->messageManager->addException($e, __('Something went wrong while saving the post.'));
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['link_id' => $id]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a link to delete.'));
        return $resultRedirect->setPath('*/*/'); //redirect to index
    }

}