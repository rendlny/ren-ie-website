<?php

use Phinx\Migration\AbstractMigration;

class ItemUpdates extends AbstractMigration
{

    public function change()
    {
      $table = $this->table('item');
      $table
      ->addColumn('sale', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
      ->addColumn('bid', 'boolean', ['null' => true, 'signed' => false, 'default' => 0])
      ->update();
    }
}
