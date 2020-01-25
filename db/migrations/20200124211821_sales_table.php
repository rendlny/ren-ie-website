<?php

use Phinx\Migration\AbstractMigration;

class SalesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
      // sales table
      $sale = $this->table('sale');
      $sale
        ->addColumn('code', 'string', ['limit' => 16, 'null' => true])
        ->addColumn('item_id', 'integer', ['limit' => 25, 'null' => true])
        ->addColumn('quantity', 'integer', ['limit' => 25, 'null' => true])
        ->addColumn('total_price', 'integer', ['limit' => 25, 'null' => true])
        ->addColumn('customer_name', 'string', ['null' => true])
        ->addColumn('paypal', 'string', ['null' => true])
        ->addColumn('shipping_address', 'string', ['null' => true])
        ->addColumn('comment', 'string', ['null' => true])
        ->addColumn('charged', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('tracking', 'string', ['null' => true])
        ->addColumn('shipped', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('cancelled', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('refunded', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('trade_offer', 'string', ['null' => true])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addIndex('code', ['unique' => true])
        ->create()
      ;
    }
}
