<?php

use Phinx\Seed\AbstractSeed;

class Drink extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = array(
            array(
                'id' => 1,
                'producer_id' => 1,
                'barcode' => '123123123',
                'name' => 'Домашна гроздова',
                'url' => 'http://example.com/',
                'image' => '',
                'description' => 'Домашна ракия, изпратена от дядо ти.',
                'rating' => 5,
                'created' => time(),
            ),
        );
        $posts = $this->table('drink');
        $posts->insert($data)->save();
    }
}
