<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 5/18/2016
 * Time: 2:56 AM
 */

namespace AAllen\MenuLink\Setup;


use AAllen\MenuLink\Model\Link;
use AAllen\MenuLink\Model\LinkFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $_linkFactory;

    public function __construct(LinkFactory $linkFactory)
    {
        $this->_linkFactory = $linkFactory;
    }

    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        
        //create some posts
        /** @var Link $link */
        $link = $this->_linkFactory->create();
        $link->setUrl('http://jazzinaustin.com');
        $link->setName('Jazz in Austin');
        $link->setIsActive(1);
        $link->setPosition(1);
        $link->setTarget(Link::TARGET_TOP);
        $link->save();
        $link = $this->_linkFactory->create();
        $link->setUrl('http://pronome.net');
        $link->setName('ProNome');
        $link->setIsActive('1');
        $link->setPosition(8);
        $link->setCss('aallen-menu-link');
        $link->setTarget(Link::TARGET_BLANK);
        $link->save();
        
        $setup->endSetup();
    }
}