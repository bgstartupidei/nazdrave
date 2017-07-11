<?php

namespace Nazdrave\Model;

use Slim\Container;

class DrinkModel extends BaseModel {

    protected $tableName = 'drink';

    public function get($table, $id, $column = 'id') {
        return $this->db->table($table)
            ->select('drink.*', 'producer.name as producer_name', 'producer.image as producer_image')
            ->leftJoin('producer', function ($join) {
                $join->on('drink.producer_id', '=', 'producer.id');
            })
            ->where('drink.id', $id)->first();
    }

    public function checkIn($userId, $drinkId, $venueId, $description, $rating) {
        $data = [
            'user_id' => $userId,
            'drink_id' => $drinkId,
            'venue_id' => $venueId,
            'description' => $description,
            'rating' => $rating,
            'created' => time(),
        ];
        $this->db->table('user_drink')->insert($data);
    }

}
