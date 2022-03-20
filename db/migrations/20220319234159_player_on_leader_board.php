<?php

use Phinx\Migration\AbstractMigration;

class PlayerOnLeaderBoard extends AbstractMigration {

    public function change() {
      // user table
      $table = $this->table('player');
      $table
        ->addColumn('on_leader_board', 'boolean', ['default' => false])
        ->update()
      ;
    }
}
