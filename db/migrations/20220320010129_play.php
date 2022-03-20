<?php

use Phinx\Migration\AbstractMigration;

class Play extends AbstractMigration {

    public function change() {
      // user table
      $table = $this->table('play');
      $table
        ->addColumn('bgg_id', 'integer', ['null' => true])
        ->addColumn('date', 'string', ['null' => true])
        ->addColumn('quantity', 'integer', ['null' => false, 'default' => 1])
        ->addColumn('length', 'integer', ['null' => true])
        ->addColumn('incomplete', 'boolean', ['null' => false, 'default' => 0])
        ->addColumn('no_win_stats', 'boolean', ['null' => false, 'default' => 0])
        ->addColumn('location', 'string', ['null' => true])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->create()
      ;
    }
}
