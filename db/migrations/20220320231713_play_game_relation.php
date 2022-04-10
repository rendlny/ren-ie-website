<?php

use Phinx\Migration\AbstractMigration;

class PlayGameRelation extends AbstractMigration {

    public function change() {
      $table = $this->table('play');
      $table
        ->addColumn('game_id', 'integer', ['null' => true])
        ->addForeignKey('game_id', 'game', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
        ->update()
      ;
    }
}
