<?php

namespace App\Http\Controllers;

use App\Page;
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
            $home = Page::where('title', '=', 'home')->first();
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Saving Page')->with('messages', $messages);
            }
        }

        if(!empty($home)) {
            return view('/')->with('tournament', $home)->with('active', 'home');
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
            $next_tournament = Page::where('title', '=', 'next_tournament')->first();
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Next Tournament Page')->with('messages', $messages);
            }
        }

        if(!empty($next_tournament)) {
            return view('/pages/tournament')->with('tournament', $next_tournament)->with('active', 'next');
        } else {
            return view('/pages/default')->with('active', 'next');
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
                return view('/errors/error')->with('page', 'Galler Page')->with('messages', $messages);
            }
        }

        return view('/pages/gallery')->with('files', $files)->with('active', 'gallery');
    }

    public function previous_tournament() {
        try {
            $previous_tournament = Page::where('title', '=', 'previous_tournament')->first();
        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Previous Tournament Page')->with('messages', $messages);
            }
        }
        if(!empty($previous_tournament)) {
            return view('/pages/tournament')->with('tournament', $previous_tournament)->with('active', 'previous');
        } else {
            return view('/pages/default')->with('active', 'previous');
        }
    }

}
