<?php

use Phinx\Seed\AbstractSeed;

class Venue extends AbstractSeed
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
                'name' => 'Вкъщи',
                'url' => 'http://example.com/',
                'image' => '',
                'description' => 'Винаги прясна салата.',
                'rating' => 5,
            ),
        );
        $posts = $this->table('venue');
        $posts->insert($data)->save();
    }
}
