<?php

namespace Nazdrave\Model;

use Slim\Container;

class UserDrinkModel extends BaseModel {

    protected $tableName = 'user_drink';

    public function checkIn($userId, $drinkId, $venueId, $description, $rating) {
        $data = [
            'user_id' => $userId,
            'drink_id' => $drinkId,
            'venue_id' => $venueId,
            'description' => $description,
            'rating' => $rating,
            'created' => time(),
        ];
        return $this->db->table($this->getTableName())->insertGetId($data);
    }

    public function getLatestCheckins($filterField, $filterValue, $count) {
        return $this->db->table($this->getTableName())
            ->select('user_drink.*', 'user.email', 'venue.name as venue_name', 'drink.name as drink_name')
            ->leftJoin('drink', function ($join) {
                $join->on('user_drink.drink_id', '=', 'drink.id');
            })
            ->leftJoin('user', function ($join) {
                $join->on('user_drink.user_id', '=', 'user.id');
            })
            ->leftJoin('venue', function ($join) {
                $join->on('user_drink.venue_id', '=', 'venue.id');
            })
            ->where($filterField, $filterValue)
            ->orderBy('created', 'desc')
            ->get();
    }
}
