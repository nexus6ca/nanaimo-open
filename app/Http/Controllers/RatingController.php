<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\User;
use App\Page;
use Exception;

/**
 * Class RatingController
 * @package App\Http\Controllers
 *
 * Class for static function to determine rating.
 */

class RatingController {

    private $rows;
    private $ratingList = array();

    public function __construct()
    {
        $this->rows = explode("\n", file_get_contents("http://chess.ca/sites/default/files/tdlist.txt"));

        foreach ($this->rows as $row) {
            $this->ratingList[] = str_getcsv($row);
        }
    }

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


