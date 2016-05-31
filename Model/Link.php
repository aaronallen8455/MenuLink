<?php

namespace AAllen\MenuLink\Model;

use AAllen\MenuLink\Api\Data\LinkInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\UrlInterface;

class Link extends AbstractModel implements LinkInterface
{
    /**#@+
     * Link's Statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;
    /**#@-*/
    
    /**#@+
     * Link's Targets
     */
    const TARGET_TOP = 1;
    const TARGET_BLANK = 2;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'aallen_link';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AAllen\MenuLink\Model\ResourceModel\Link');
    }

    /**
     * Prepare link's statuses.
     * Available event aallen_link_get_available_statuses to customize statuses.
     *
     * @return array
     */
    public function getAvailableStatuses()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }

    /**
     * Get array of targets
     * 
     * @return array
     */
    public function getAvailableTargets()
    {
        return [self::TARGET_BLANK => '_blank', self::TARGET_TOP => '_top'];
    }

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::LINK_ID);
    }

    /**
     * Get link HREF
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->getData(self::URL);
        /*if (substr($url, 0, 4) === 'http') return $url;
        return $url;*/
    }

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get CSS class name
     * 
     * @return string|null
     */
    public function getCss()
    {
        return $this->getData(self::CSS);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->getData(self::POSITION);
    }

    /**
     * Get target
     * 
     * @return string
     */
    public function getTarget()
    {
        return $this->getData(self::TARGET);
    }

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive()
    {
        return (bool) $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set ID
     *
     * @param int $id
     * @return LinkInterface
     */
    public function setId($id)
    {
        return $this->setData(self::LINK_ID, $id);
    }

    /**
     * Set link HREF
     *
     * @param string $href
     * @return LinkInterface
     */
    public function setUrl($href)
    {
        return $this->setData(self::URL, $href);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return LinkInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return LinkInterface
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return LinkInterface
     */
    public function setUpdateTime($updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * @param int $position
     * @return LinkInterface
     */
    public function setPosition($position)
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * Set is active
     * 
     * @param int|bool $isActive
     * @return LinkInterface
     */
    public function setIsActive($isActive)
    {
        return @$this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * @param $cssClass
     * @return LinkInterface
     */
    public function setCss($cssClass)
    {
        return $this->setData(self::CSS, $cssClass);
    }
    
    public function setTarget($target)
    {
        return $this->setData(self::TARGET, $target);
    }

    /**
     * Get the HTML string
     *
     * @return string
     */
    public function getHtml()
    {
        $html = '<li class="level0 level-top parent ui-menu-item" role="presentation">';
        $html .= '<a href="' . $this->getUrl() . '" class="level-top ' . ($this->getCss()?:'') . '" target="' . $this->getAvailableTargets()[$this->getTarget()] . '" name="' . $this->getName() . '">';
        $html .= htmlentities($this->getName());
        $html .= '</a></li>';

        return $html;
    }
}