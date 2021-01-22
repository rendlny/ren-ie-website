<?php

use Phinx\Migration\AbstractMigration;

class ProjectSectionTable extends AbstractMigration
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
      $table = $this->table('project_section');
      $table
        ->addColumn('project_id', 'integer', ['limit' => 25, 'null' => true])
        ->addColumn('title', 'string', ['limit' => 100, 'null' => true])
        ->addColumn('image', 'string', ['null' => true])
        ->addColumn('slug', 'text', ['null' => true])
        ->addColumn('description', 'text', ['null' => true, 'default' => NULL])
        ->addColumn('content', 'text', ['null' => true, 'default' => NULL])
        ->addColumn('active', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('deleted_at', 'timestamp', ['null' => true, 'signed' => false, 'default' => NULL])
        ->create();
    }
}
