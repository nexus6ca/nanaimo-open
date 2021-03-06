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
use App\Classes;

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

            $site = SitePage::first();
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

            $site = (SitePage::count() > 0) ? SitePage::first() : new SitePage;
            $site->site_name = $data['site_name'];
            $site->home = $data['home_page'];
            $site->next_tournament = $data['next_tournament_page'];
            $site->club = $data['chess_club_page'];
            $site->tinymce_key = $data['tinymce_key'];
            $site->google_analytics_tag = $data['google_tag'];
            $site->save();

            $conf = [
                'constants.SITE_TITLE' => $data['site_name'],
                'constants.GOOGLE_ANALYTICS_KEY' => $data['google_tag'],
                'constants.TINY_MCE_KEY' => $data['tinymce_key']
            ];
            //$conf = ['_SITE_EMAIL' => $data['site_email']];

            config($conf);
            $fp = fopen(base_path() .'/config/constants.php' , 'w');
            fwrite($fp, '<?php return ' . var_export(config('constants'), true) . ';');
            fclose($fp);

        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }

        return back();
    }
}
