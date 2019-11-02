<?php

use Phinx\Migration\AbstractMigration;

class User extends AbstractMigration
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
  public function change(){
    // user table
    $user = $this->table('user');
    $user
      ->addColumn('usercode', 'string', ['limit' => 16, 'null' => true])
      ->addColumn('firstname', 'string', ['limit' => 100, 'null' => true])
      ->addColumn('surname', 'string', ['limit' => 100, 'null' => true])
      ->addColumn('email', 'string', ['null' => true])
      ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('active', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
      ->addColumn('image', 'string', ['null' => true])
      ->addColumn('trade_list_link', 'string', ['null' => true])
      ->addColumn('level', 'string', ['limit'=>10, 'null' => true])
      ->addColumn('status', 'string', ['limit'=>155, 'null' => true])
      ->addIndex('email', ['unique' => true])
      ->addIndex('usercode', ['unique' => true])
      ->create()
    ;

    // password table

    $userfocal = $this->table('userfocal');
    $userfocal
      ->addColumn('user_id', 'integer', ['null'=>false])
      ->addColumn('focal', 'string', ['limit' => 60])
      ->addIndex('user_id', ['unique' => true])
      ->addForeignKey('user_id', 'user', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
      ->create()
    ;

    // tokens table

    $tokens = $this->table('tokens');
    $tokens
      ->addColumn('token', 'string', ['limit'=>20, 'null'=>false])
      ->addColumn('user_id', 'integer', ['null'=>false])
      ->addColumn('created', 'timestamp', ['null' => false, 'default' => 'CURRENT_TIMESTAMP'])
      ->addColumn('active', 'boolean', ['null' => false, 'default' => 0])
      ->addColumn('requestingIP', 'string', ['limit' => 80])
      ->addIndex('token', ['unique' => true])
      ->addForeignKey('user_id', 'user', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
      ->create();
    ;
  }
}
