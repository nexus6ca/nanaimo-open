<?php

namespace App\Classes;

use App\Tournament;
use App\User;
use App\Page;
use Exception;

/**
 * Class RatingList
 *
 * Determine Rating and Expiry date based on CFC Number.
 *
 * @package App\Http\Controllers
 *
 * Useage:
 *
 * $rating = new RatingList;
 *
 * $player_rating = $rating->getRating($cfc_number) - returns the rating
 * $player_expiry = $rating->getExpiry($cfc_number)
 *
 */

class RatingList {

    private $rows;
    private $ratingList = array();

    public function __construct()
    {
        $this->rows = explode("\n", file_get_contents("http://chess.ca/sites/default/files/tdlist.txt"));

        foreach ($this->rows as $row) {
            $this->ratingList[] = str_getcsv($row);
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
                if ($member[0] == $cfc_number) {
                    return $member[6];
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
                if ($member[0] == $cfc_number) {
                    return date_create_from_format('d/m/Y', $member[1]);
                }
            }
        }
        // Return 0 if we didn't find the membership number.
        return null;
    }

}


