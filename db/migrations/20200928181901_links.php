<?php

use Phinx\Migration\AbstractMigration;

class Links extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
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
      $link = $this->table('link');
      $link
        ->addColumn('name', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('url', 'string', ['limit' => 255, 'null' => true])
        ->addColumn('icon', 'string', ['null' => true])
        ->addColumn('colour', 'string', ['null' => true])
        ->addColumn('position', 'integer', ['null' => true])
        ->addColumn('active', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->create()
      ;
    }
}
