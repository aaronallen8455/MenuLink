<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/20/2016
 * Time: 4:45 AM
 */

namespace AAllen\MenuLink\Model\Link\Source;


use AAllen\MenuLink\Model\Link;
use Magento\Framework\Data\OptionSourceInterface;

class IsActive implements OptionSourceInterface
{
    /** @var Link */
    protected $link;

    /**
     * Constructor
     *
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['label' => '', 'value' => '']; //the blank topmost option
        $availableOptions = $this->link->getAvailableStatuses();
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key
            ];
        }
        return $options;
    }
}