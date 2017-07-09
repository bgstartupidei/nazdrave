<?php

use Phinx\Migration\AbstractMigration;

class UserDrink extends AbstractMigration
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
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $table = $this->table('user_drink');
        $table->addColumn('user_id', 'integer')
              ->addColumn('drink_id', 'integer')
              ->addColumn('venue_id', 'integer')
              ->addColumn('image', 'string', array('limit' => 100))
              ->addColumn('description', 'text')
              ->addColumn('rating', 'float', array('default' => 0))
              ->addColumn('status', 'integer', array('default' => 1))
              ->addColumn('created', 'datetime', array('default' => 'CURRENT_TIMESTAMP'))
              ->addColumn('updated', 'datetime', array('null' => true))
              ->addIndex(array('status'))
              ->create();
    }
}
