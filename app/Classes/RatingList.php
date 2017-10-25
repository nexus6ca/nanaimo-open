<?php

namespace App\Classes;

use Exception;
use Cache;

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
class RatingList
{

    private $rows;
    private $ratingList = array();

    /**
     * RatingList constructor.
     *
     * Input csv file from the CFC. Process the rating removing all entries that do not have 12 values.
     *
     */
    public function __construct()
    {
        if (!Cache::has('ratingList') || true) {
            $this->rows = explode("\n", file_get_contents("http://chess.ca/sites/default/files/tdlist.txt"));
            $header = str_getcsv(array_shift($this->rows));
            ini_set('memory_limit', '-1');
                foreach ($this->rows as $key => $list) {
                    $list = str_getcsv($list);

                    if (count($list) != 12) {
                        continue;
                    } else {
                        $this->ratingList[$key] = array_combine($header, $list);
                    }

                }

                Cache::put('ratingList', $this->ratingList, 60 * 24);
        } else {
            $this->ratingList = Cache::get('ratingList');
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
            ini_set('memory_limit', '-1');
            if(!Cache::has($cfc_number)) {
                foreach ($this->ratingList as $member) {
                    $result = $member['Rating'];
                    Cache::put($cfc_number, $result, 60 * 24);
                }
            } else {
                $result = Cache::get($cfc_number);
            }
            return $result;
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
    public function getExpiry($cfc_number)
    {
        if (isset($cfc_number)) {
            ini_set('memory_limit', '-1');
            if(!Cache::has($cfc_number)) {
                foreach ($this->ratingList as $member) {
                    if ($member['CFC#'] == $cfc_number) {
                            $result = date_create_from_format('d/m/Y', $member['Expiry']);
                            Cache::put($cfc_number, $result, 60 * 24);
                    }
                }
            } else {
                $result = Cache::get($cfc_number);
            }
            return $result;
        }
        // Return 0 if we didn't find the membership number.
        return 0;
    }

    /**
     * Get both CFC rating and expiry.
     *
     * @param $cfc_number
     * @return array
     */
    public function getRatingAndExpiry($cfc_number)
    {
        if (isset($cfc_number)) {
            ini_set('memory_limit', '-1');
            if(!Cache::has($cfc_number)) {
                foreach ($this->ratingList as $member) {
                    if ($member['CFC#'] == $cfc_number) {
                        $result = array('rating' => $member['Rating'],
                            'expiry' => date_create_from_format('d/m/Y', $member['Expiry']));
                        Cache::put($cfc_number, $result, 60 * 24);
                    }
                }
            } else {
                $result = Cache::get($cfc_number);
            }

            return $result;
        }
        // Return 0 if we didn't find the membership number.
        return 0;
    }

    /**
     * Top 10 by Province
     *
     */

    public function getT10byProv($prov)
    {
        $count = 0;
        $prov_players = array();
        $rating_list = $this->ratingList;
        usort($rating_list, function ($a, $b) {
            return $b['Rating'] - $a['Rating'];
        });

        foreach ($rating_list as $player) {
            if ($count < 10) {
                if ($player['Prov'] == $prov && time() - strtotime($player['Expiry']) > 0) {
                    $prov_players[] = $player;
                    $count++;
                }
            }
        }

        return $prov_players;
    }
}


