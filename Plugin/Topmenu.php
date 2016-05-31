<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/30/2016
 * Time: 9:17 PM
 */

namespace AAllen\MenuLink\Plugin;


use AAllen\MenuLink\Model\Link;
use AAllen\MenuLink\Model\ResourceModel\Link\Collection;
use AAllen\MenuLink\Model\ResourceModel\Link\CollectionFactory;

class Topmenu
{
    /** @var  CollectionFactory */
    protected $_linkCollectionFactory;

    /**
     * Topmenu constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->_linkCollectionFactory = $collectionFactory;
    }

    /**
     * Insert links into the Html stream
     *
     * @param $subject
     * @param $html
     * @return string
     */
    public function afterGetHtml($subject, $html)
    {
        /** @var Collection $links */
        $links = $this->_linkCollectionFactory->create();
        $links->addFilter('is_active', 1);
        $links->setOrder('position', Collection::SORT_ORDER_DESC);
        if ($links->count() > 0) {
            //break the html up
            $html = preg_split('/(?<!^)(?=<li\s+class="level0)/', $html);
            //insert each link into it's position.
            /** @var Link $link */
            foreach ($links as $link) {
                array_splice($html, $link->getPosition()-1, 0, $link->getHtml());
            }
            $html = implode('', $html);
        }
        return $html;
    }
}