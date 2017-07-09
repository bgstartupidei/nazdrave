<?php

use Phinx\Migration\AbstractMigration;

class PhpSession extends AbstractMigration
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
        $table = $this->table('php_session');
        $table->addColumn('session_id', 'string', array('limit' => 32))
              ->addColumn('session_data', 'string', array('limit' => 100))
              ->addColumn('created', 'datetime', array('default' => 0))
              ->addColumn('updated', 'datetime', array('default' => 0))
              ->create();
    }
}
