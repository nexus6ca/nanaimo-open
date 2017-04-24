<?php

namespace App\Http\Controllers;

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

    public function previous_tournament()
    {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            return view('/errors/error')->with('page', 'Previous Tournament Page')->with('messages', $errors);
        }
        if (!empty($site->previous_tournament)) {
            $tournament = Tournament::find($site->previous_tournament);
            return view('/pages/tournament')->with('tournament', $tournament)->with('active', 'previous_tournament');
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

    public function registered($tournament_id)
    {
        try {
            $tournament = Tournament::find($tournament_id);
            // Pivot finds the player (which is really a user)
            $players_pivot = $tournament->users()->get();

            $players = array();
            $registered = false;
            foreach ($players_pivot as $pivot) {
                if ($pivot->id == Auth::id()) {
                    $registered = 'true';
                }
                $player['player'] = User::find($pivot->id);
                $player['byes'] = $pivot->byes;
                $player['paid'] = $pivot->paid;
                $players[] = $player;
            }

            return view('/pages/registered')->with('tournament', $tournament)->with('players', $players)->with('registered', $registered);

        } catch (Exception $e) {
            $errors = $e->getMessage();

            return view('/errors/error')->with('page', 'Tournament Registration Page')->with('messages', $errors);
        }

    }

    public function mobile()
    {
        $result = User::all();
        //    mysqli_query($con,"SELECT `name`, `rating` FROM users WHERE `email` = " . $_GET['email']);

        $user = array();

        if (!empty($result)) {
            foreach($result as $contact) {
                $user[] =  array(
                    'name' => $contact->name,
                    'email' => $contact->email,
                    'rating' => $contact->rating
                );
            }

            $user = json_encode(array('contacts' => $user));

            return view('/mobile/mobile')->with('user', $user);
        }

    }
}
