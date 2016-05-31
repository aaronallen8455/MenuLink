<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/14/2016
 * Time: 4:04 AM
 */

namespace AAllen\MenuLink\Api\Data;

interface LinkInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const LINK_ID = 'link_id';
    const URL = 'url';
    const NAME = 'name';
    const CSS = 'css';
    const CREATION_TIME = 'creation_time';
    const UPDATE_TIME = 'update_time';
    const IS_ACTIVE = 'is_active';
    const POSITION = 'position';
    const TARGET = 'target';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getID();

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrl();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getName();

    /**
     * Get CSS class
     * 
     * @return string|null
     */
    public function getCss();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreationTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Get position
     * 
     * @return int
     */
    public function getPosition();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * @return string
     */
    public function getTarget();

    /**
     * Set ID
     *
     * @param int $id
     * @return LinkInterface
     */
    public function setId($id);

    /**
     * Set link URL
     *
     * @param string $href
     * @return LinkInterface
     */
    public function setUrl($href);

    /**
     * Set name
     *
     * @param string $name
     * @return LinkInterface
     */
    public function setName($name);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return LinkInterface
     */
    public function setCreationTime($creationTime);
    
    /**
     * Set update time
     * 
     * @param string $updateTime
     * @return LinkInterface
     */
    public function setUpdateTime($updateTime);
    
    /**
     * Set is active
     * 
     * @param int|bool $isActive
     * @return LinkInterface
     */
    public function setIsActive($isActive);
    
    public function setCss($cssClass);
    
    /**
     * Set position
     * 
     * @param int $position
     * @return LinkInterface
     */
    public function setPosition($position);
    
    /**
     * Set target
     * 
     * @param string $target
     * @return LinkInterface
     */
    public function setTarget($target);
}