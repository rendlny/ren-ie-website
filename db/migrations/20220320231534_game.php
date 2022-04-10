<?php

use Phinx\Migration\AbstractMigration;

class Game extends AbstractMigration {

    public function change() {
      $table = $this->table('game');
      $table
        ->addColumn('bgg_id', 'integer', ['null' => true])
        ->addColumn('name', 'string', ['null' => true])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->create()
      ;
    }
}
