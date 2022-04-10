<?php

use Phinx\Migration\AbstractMigration;

class PlayPlayer extends AbstractMigration {

    public function change() {
      $table = $this->table('play_player');
      $table
        ->addColumn('play_id', 'integer', ['null' => true])
        ->addColumn('player_id', 'integer', ['null' => true])
        ->addColumn('start_position', 'string', ['null' => true])
        ->addColumn('color', 'string', ['null' => true])
        ->addColumn('score', 'string', ['null' => true])
        ->addColumn('new', 'boolean', ['default' => false])
        ->addColumn('rating', 'string', ['null' => true])
        ->addColumn('win', 'boolean', ['default' => false])
        ->addColumn('created', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated', 'timestamp', ['null' => true, 'default' => 'CURRENT_TIMESTAMP'])
        ->addForeignKey('play_id', 'play', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
        ->addForeignKey('player_id', 'player', 'id', ['delete'=> 'CASCADE', 'update'=> 'CASCADE'])
        ->create()
      ;

      $table = $this->table('play');
      $table->addColumn('comment', 'text', ['null' => true])->update();
    }
}
