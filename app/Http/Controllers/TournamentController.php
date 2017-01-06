<?php

namespace App\Http\Controllers;

use App\Tournament;
use App\User;
use App\Page;
use Exception;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Http\Request;

/**
 * Class TournamentController
 *
 * Controller for the Tournament Database
 *
 * @package App\Http\Controllers
 */
class TournamentController extends Controller
{
    // Create a new tournament
    public function add()
    {
        try {
            // Check to see if the user is an Admin
            if (!Auth::check() || (!Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }


        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Add Tournament Page')->with('messages', $e->getMessage());
        }
        // Take the form input and generate a blog in the database.
        return view('/backend/tournament/add');
    }

    public function edit($id)
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }
            $tournament = Tournament::find($id);
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $e->getMessage());
        }
        return view('/backend/tournament/edit')->with('tournament', $tournament);
    }


    public function save($id = null)
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $formData = Input::all();
            $validator = Validator::make(
                array(
                    'name' => $formData['name'],
                    'start_date' => $formData['start_date'],
                    'end_date' => $formData['end_date'],
                    'early_reg_end' => $formData['early_reg_end'],
                    'completed' => $formData['completed'],
                    'details' => $formData['details'],
                ),
                array(
                    'name' => 'string|min:2|required',
                    'start_date' => 'date|required',
                    'end_date' => 'date|required',
                    'early_reg_end' => 'date|required',
                    'completed' => 'boolean|required',
                    'early_reg_end' => 'date|nullable',
                    'details' => 'string|required',

                )
            );
            // Check to see if the validator passes
            if (!$validator->passes()) {
                throw new Exception ($validator->errors());
            }

            if ($id == null) {
                $tournament = new Tournament();
            } else {
                $tournament = Tournament::find($id);
            }

            $tournament->name = $formData['name'];
            $tournament->start_date = $formData['start_date'];
            $tournament->end_date = $formData['end_date'];
            $tournament->early_reg_end = $formData['early_reg_end'];
            $tournament->details = $formData['completed'];
            $tournament->details = $formData['details'];

            $tournament->save();

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Saving Page')->with('messages', $e->getMessage());
        }

        return redirect('/backend/tournament/browse');
    }

    public function browse()
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $tournaments = Tournament::all();

        } catch (Exception $e) {
            return View::make('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }

        return view('/backend/tournament/browse')->with('tournaments', $tournaments);
    }

    public function delete($id)
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $tournament = Tournament::find($id);
            $tournament->delete();

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }

        return redirect('/backend/tournament/browse');
    }

    public function register($tournament_id)
    {

        try {
            $tournament = Tournament::find($tournament_id);
            $player = Auth::user();
            // If the player is already registered we don't want to register again.
            if (!(DB::table('tournament_user')->where('user_id', $player->id)->where('tournament_id', $tournament_id)->exists())) {
                $player->tournaments()->attach($tournament->id, ['byes' => (isset($formData['byes']) ? implode(",", $formData['byes']) : "null"), 'paid' => false]);
            } else {
                throw new Exception('Already registered.');
            }

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }
        return redirect('/registered/' . $tournament_id);
    }

    public function withdraw($tournament_id)
    {
        try {
            //determining if they are logged in, and finding the tournament id
            $player = Auth::user();
            $tournament = Tournament::find($tournament_id);

            //if they are logged, detach the tournament from the player
            $player->tournaments()->detach($tournament->id);
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }

        return back();
    }

    public function registration_form($tournament_id)
    {
        try {
            $tournament = Tournament::find($tournament_id);
            $player = Auth::user();

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }
        return view('/pages/registration_form')->with('tournament', $tournament)->with('player', $player);
    }

    public function player_details($tournament_id, $player_id) {
        try {
            $tournament = Tournament::find($tournament_id);
            $player = $tournament->users()->find($player_id);
            $result = array(
                'tournament' => $tournament,
                'user'       => User::find($player_id),
            );
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Get Player Details Page')->with('messages', $e->getMessage());
        }

        return view('/backend/tournament/player_details')->with('result', $result)->with('player', $player);

    }

    public function update_player ($tournament_id, $player_id) {
        try {
            $tournament = Tournament::find($tournament_id);
            $user = User::find($player_id);
            $player = $tournament->users()->find($user->id);
            $data = Input::all();
            if(isset($data['byes']))
                $player->pivot->byes = $data['byes'];
            $player->pivot->paid =  $data['paid'];

            $player->save();



        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Update Player Details Page')->with('messages', $e->getMessage());
        }
        return redirect('/registered/'.$tournament_id);
    }



}
