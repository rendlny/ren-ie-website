<?php

use Phinx\Migration\AbstractMigration;

class Item extends AbstractMigration {

    public function change() {
      // user table
      $table = $this->table('item');
      $table
        ->addColumn('code', 'string', ['limit' => 16, 'null' => true])
        ->addColumn('user_id', 'string', ['limit' => 16, 'null' => true])
        ->addColumn('title', 'string', ['limit' => 100, 'null' => true])
        ->addColumn('description', 'string', ['null' => true])
        ->addColumn('active', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('price', 'integer', ['null' => true])
        ->addColumn('preorder', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('trade', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
        ->addColumn('weight', 'integer', ['null' => true])
        ->addColumn('quantity', 'integer', ['null' => true])
        ->addColumn('image', 'string', ['null' => true])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addIndex('code', ['unique' => true])
        ->create()
      ;
    }
}
