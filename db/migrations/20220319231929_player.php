<?php

use Phinx\Migration\AbstractMigration;

class Player extends AbstractMigration {

    public function change() {
      // user table
      $table = $this->table('player');
      $table
        ->addColumn('bgg_id', 'integer', ['null' => true])
        ->addColumn('username', 'string', ['null' => true])
        ->addColumn('name', 'string', ['null' => true])
        ->addColumn('wins', 'integer', ['null' => false, 'default' => 0])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->create()
      ;
    }
}
