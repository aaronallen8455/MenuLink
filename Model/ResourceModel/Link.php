<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/15/2016
 * Time: 12:01 AM
 */

namespace AAllen\MenuLink\Model\ResourceModel;


use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Link extends AbstractDb
{
    /**
     * Construct
     *
     * @param Context $context
     * @param string|null $resourcePrefix
     */
    public function __construct(Context $context, $resourcePrefix = null)
    {
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        //this where the database table and ID column is defined.
        $this->_init('aallen_menulink_link', 'link_id');
    }

    /**
     * Process post data before saving
     *
     * @param AbstractModel $object
     * @return $this
     * @throws LocalizedException
     */
    protected function _beforeSave(AbstractModel $object)
    {
        //we need to make sure we're saving valid data, so a little validation is handled here
        if (!$this->_isValidUrl($object)) {
            throw new LocalizedException(
                __('The link URL contains invalid characters.')
            );
        }

        return parent::_beforeSave($object);
    }

    /**
     * Retrieve select objects for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param \AAllen\MenuLink\Model\Link $object
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        //allows us to filter only active posts. We don't want to load inactive posts!
        $select = parent::_getLoadSelect($field, $value, $object);

        if ($object->getStoreId()) {

            $select->where('is_active = ?', 1)->limit(1);
        }

        return $select;
    }

    /**
     * Check for valid Href
     *
     * @param AbstractModel $object
     * @return bool
     */
    protected function _isValidUrl($object)
    {
        return preg_match('/^(http:\/\/|https:\/\/)?[\w\d\/_\-=+?#.&]+$/', $object->getData('url'));
    }
}