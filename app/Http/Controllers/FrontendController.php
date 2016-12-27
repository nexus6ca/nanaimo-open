<?php

namespace App\Http\Controllers;

use App\Page;
use App\Tournament;
use App\SitePage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Displays the Page set as home.
     *
     * @return $this
     */
    public function home()
    {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Saving Page')->with('messages', $messages);
            }
        }

        if(!empty($site->home)) {
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

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Next Tournament Page')->with('messages', $messages);
            }
        }

        if(!empty($site->next_tournament)) {
            $tournament = Tournament::find($site->next_tournament);

            return view('/pages/tournament')->with('tournament', $tournament)->with('active', 'tournament');
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

    public function gallery() {
        try {
            $files = scandir('images/gallery');
            unset($files[0]);
            unset($files[1]);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Gallery Page')->with('messages', $messages);
            }
        }

        return view('/pages/gallery')->with('files', $files)->with('active', 'gallery');
    }

    public function previous_tournament() {
        try {
            $site = SitePage::find(1);
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Previous Tournament Page')->with('messages', $messages);
            }
        }
        if(!empty($site->previous_tournament)) {
            $tournament = Tournament::find($site->previous_tournament);
            return view('/pages/tournament')->with('tournament', $tournament)->with('active', 'tournament');
        } else {
            return view('/pages/default')->with('active', 'home');
        }
    }

}
