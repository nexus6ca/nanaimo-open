<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Exception;
use App\Page;
use App\User;
use App\Tournament;
use App\SitePage;

class BackendController extends Controller
{
    //
    public function home(){
        try {
            if(!Auth::user()->isAdmin) {
                throw new Exception('Not authorized.');
            }

            $users = User::all();
            $pages = Page::all();
            $tournaments = Tournament::all();
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }

        return view('/backend/home')->with('users', $users)->with('pages', $pages)->with('tournaments', $tournaments);
    }

    public function manage_site() {
        try {
            if (!Auth::user()->isAdmin) {
                throw new Exception('Not authorized.');
            }

            $site = SitePage::find(1);
            $pages = Page::all();
            $category = DB::table('page_categories')->get();
            $tournaments = Tournament::all();
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }

        return view('/backend/manage_site')->with('site', $site)->with('pages', $pages)->with('category', $category)->with('tournaments', $tournaments);
    }

    public function save() {
        try {
            if (!Auth::user()->isAdmin) {
                throw new Exception('Not authorized.');
            }

            $data = Input::all();

            $site = (SitePage::count() > 0) ? SitePage::find(1) : new SitePage;

            $site->home = $data['home_page'];
            $site->next_tournament = $data['next_tournament_page'];
            $site->save();

        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }

        return back();
    }
}
