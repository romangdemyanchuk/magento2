<?php

namespace Ism\Events\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1') < 0) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('ism_events_table')
            )->addColumn(
                'title',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                55,
                ['nullable' => false,],
                'Title'
            )->addColumn(
                'content',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                '2M',
                ['nullable' => false],
                'Content'
            )->addColumn(
                'announce',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Announce'
            )->addColumn(
                'publish_date',
                \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false],
                'Published at'
            )->addColumn(
                'published',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                null,
                [ 'identity' => false, 'nullable' => false, 'primary' => true ],
                'Is published'
            )->setComment(
                'Ism Events Table'
            );
            $installer->getConnection()->createTable($table);
        }
        $installer->endSetup();
    }
}
