<?php

namespace App\Http\Controllers;

use App\Classes\RatingList;
use App\Page;
use App\Tournament;
use App\SitePage;
use App\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Displays the Page set as home.
     *
     * @return \Illuminate\View\View
     * @todo This really should be Club Blog - Home is the Club information page.
     */
    public function home()
    {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            return view('/errors/error')->with('page', 'Saving Page')->with('messages', $errors);
        }

        if (!empty($site->home)) {
            $home = Page::find($site->home);
            return view('/pages/home')->with('home', $home)->with('active', 'home');
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

    /**
     * Displays the Page set as next_tournmaent
     *
     * @todo Create multiple tournaments that can be active at the same time. IE Junior event, Decemeber Tournament,
     * @todo March Tournament.
     */
    public function next_tournament()
    {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();
            return view('/errors/error')->with('page', 'Next Tournament Page')->with('messages', $errors);
        }

        if (!empty($site->next_tournament)) {
            $tournament = Tournament::find($site->next_tournament);

            return view('/pages/tournament')->with('tournament', $tournament)->with('active', 'next_tournament');
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

    /**
     * Gets all the image files.
     *
     * @todo implement file uploader and create proper storage.
     */
    public function gallery()
    {
        try {
            $files = scandir('images/gallery');
            unset($files[0]);
            unset($files[1]);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            return view('/errors/error')->with('page', 'Gallery Page')->with('messages', $errors);
        }

        return view('/pages/gallery')->with('files', $files)->with('active', 'gallery');
    }

    /**
     * Generates list of all completed tournaments.
     */
    public function previous_tournament()
    {
        $tournaments = Tournament::where('completed', 1)->get();

        if (!empty($tournaments)) {
            return view('/pages/prev_tournaments')->with('tournaments', $tournaments);
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

    /**
     * Shows which players are registered in a specific tournament.
     *
     * @param $tournament_id
     * @return $this
     */
    public function registered($tournament_id)
    {
        try {
            $tournament = Tournament::find($tournament_id);
            // Pivot finds the player (which is really a user)
            $players_pivot = $tournament->users()->get();
            $players = array();
            $registered = false;
            $rating_list = new RatingList();

            foreach ($players_pivot as $player_pivot) {
                if ($player_pivot->id == Auth::id()) {
                    $registered = 'true';
                }
                $player['player'] = User::find($player_pivot->id);
                $player['byes'] = $player_pivot->pivot->byes;
                $player['paid'] = $player_pivot->pivot->paid;
                $player['registration_date'] = $player_pivot->pivot->created_at;
                if($player['player']->cfc_number > 0) {
                    $cfcInfo = $rating_list->getRatingAndExpiry($player['player']->cfc_number);
                    $player['player']->rating = $cfcInfo['rating'];
                    $player['player']->cfc_expiry = $cfcInfo['expiry'];
                }
                $players[] = $player;

                // Sort list by rating.

            }

            usort($players, function ($a, $b) {
                return $b['player']->rating - $a['player']->rating;
            });

            return view('/pages/registered')->with('tournament', $tournament)->with('players', $players)->with('registered', $registered);

        } catch (Exception $e) {
            $errors = $e->getMessage();

            return view('/errors/error')->with('page', 'Tournament Registration Page')->with('messages', $errors);
        }

    }

    /**
     * Chessclub Controller
     *
     * Displays Chessclub page set in backend.
     */

    public function chessClub() {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();
            return view('/errors/error')->with('page', 'Next Tournament Page')->with('messages', $errors);
        }

        if (!empty($site->club)) {
            $chessClub = Page::find($site->club);

            return view('/pages/chessclub')->with('chessclub', $chessClub);
        } else {
            return view('/pages/default')->with('active', 'home');
        }

    }
}
