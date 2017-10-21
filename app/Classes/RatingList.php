<?php

namespace App\Classes;

use Exception;

/**
 * Class RatingList
 *
 * Determine Rating and Expiry date based on CFC Number.
 *
 * @package App\Http\Controllers
 *
 * Usage:
 *
 * $rating = new RatingList;
 *
 * $player_rating = $rating->getRating($cfc_number) - returns the rating
 * $player_expiry = $rating->getExpiry($cfc_number)
 * $provTop10 = $rating->getT10byProv($province)
 *
 * @author Jason Williamson
 *
 */

class RatingList {

    private $rows;
    private $ratingList = array();

    public function __construct()
    {
        $this->ratingList = array_map('str_getcsv', file('http://chess.ca/sites/default/files/tdlist.txt'));

        $header = array_shift($this->ratingList);

        array_walk($this->ratingList, function(&$row, $key, $header){
            if(count($header) == 12 && count($row) == 12)
                $row = array_combine($header, $row);
        }, $header);

        foreach ($this->ratingList as $key => $list) {
            if(count($list) != 12) {
                unset($this->ratingList[$key]);
            }

        }
    }

    /**
     * Determine CFC Rating from rating list.
     * @param $cfc_number
     * @return int
     */
    public function getRating($cfc_number)
    {
        if (isset($cfc_number)) {

            foreach ($this->ratingList as $member) {
                if ($member['CFC#'] == $cfc_number) {
                    return $member['Rating'];
    }
    }
    }
    // Return 0 if we didn't find the membership number.
    return 0;
    }

    /**
     * Determine Expiry Date
     *
     * @param $cfc_number
     * @return \DateTime|false|null
     */
    public function getExpiry($cfc_number) {
        if (isset($cfc_number)) {
            foreach ($this->ratingList as $member) {
                if ($member['CFC#'] == $cfc_number) {
                    return date_create_from_format('d/m/Y', $member['Expiry']);
                }
            }
        }
        // Return 0 if we didn't find the membership number.
        return null;
    }

    /**
     * Top 10 by Province
     *
     */

    public function getT10byProv($prov) {
        $count = 0;
        $prov_players = array();
        $rating_list = $this->ratingList;
        usort($rating_list, function ($a, $b) {
                return $b['Rating'] <=> $a['Rating'];
        });

        foreach($rating_list as $player) {
           if($count < 10) {
                if ($player['Prov'] == $prov && time() - strtotime($player['Expiry']) > 0) {
                    $prov_players[] = $player;
                    $count++;
                }
           }
        }

        return $prov_players;
    }
}


