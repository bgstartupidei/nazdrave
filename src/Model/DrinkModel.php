<?php

namespace Nazdrave\Model;

use Slim\Container;

class DrinkModel extends BaseModel {

    protected $tableName = 'drink';

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
