<?php

use Phinx\Seed\AbstractSeed;

class Producer extends AbstractSeed
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
                'name' => 'Избата на дядо',
                'url' => 'http://example.com/',
                'image' => '',
                'description' => 'Изба с традиции.',
                'rating' => 5,
                'created' => time(),
            ),
        );
        $posts = $this->table('producer');
        $posts->insert($data)->save();
    }
}
