<?php

namespace AAllen\MenuLink\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer->getConnection()
            ->newTable($installer->getTable('aallen_menulink_link'))
            ->addColumn('link_id', Table::TYPE_SMALLINT, null, ['identity' => true, 'nullable' => false, 'primary' => true], 'Link ID')
            ->addColumn('url', Table::TYPE_TEXT, 100, ['nullable'=>false], 'Link URL')
            ->addColumn('name', Table::TYPE_TEXT, 150, ['nullable'=>true, 'default'=>''], 'Link Name')
            ->addColumn('css', Table::TYPE_TEXT, 50, ['nullable'=>true, 'default'=>'aallen-menu-link', 'CSS class'])
            ->addColumn('position', Table::TYPE_INTEGER, null, ['nullable' => false, 'default'=>'1'], 'Position')
            ->addColumn('target', Table::TYPE_SMALLINT, null, ['nullable' => false, 'default'=>'1'], 'Target')
            ->addColumn('is_active', Table::TYPE_SMALLINT, null, ['nullable'=>false, 'default'=>'1'], 'Is Link Active?')
            ->addColumn('creation_time', Table::TYPE_TIMESTAMP, null, ['nullable'=>false, 'default'=>Table::TIMESTAMP_INIT], 'Creation Time')
            ->addColumn('update_time', Table::TYPE_TIMESTAMP, null, ['nullable'=>false, 'default'=>Table::TIMESTAMP_INIT_UPDATE], 'Update Time')
            ->setComment('AAllen MenuLink Links');

        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }
}