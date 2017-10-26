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
    /**
     * Add a tournament.
     *
     * @return $this
     */
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

    /**
     * Edit a specific tournament.
     * @param $id
     * @return $this
     */
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

    /**
     * Save a tournament.
     *
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save($id = null)
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $formData = Input::all();
            $validator = Validator::make(
                array(
                    'name'              => $formData['name'],
                    'start_date'        => $formData['start_date'],
                    'end_date'          => $formData['end_date'],
                    'early_reg_end'     => $formData['early_reg_end'],
                    'early_ef'          => $formData['early_ef'],
                    'full_ef'           => $formData['full_ef'],
                    'junior_discount'   => $formData['junior_discount'],
                    'completed'         => $formData['completed'],
                    'details'           => $formData['details'],
                    'crosstable'        => (isset($formData['crosstable']) ? $formData['crosstable'] : ''),
                    'pairings'          => (isset($formData['pairings']) ? $formData['pairings'] : ''),
                    'report'            => (isset($formData['report']) ? $formData['report'] : '')
                ),
                array(
                    'name'                      => 'string|min:2|required',
                    'start_date'                => 'date|required',
                    'end_date'                  => 'date|required',
                    'early_reg_end'             => 'date|required',
                    'completed'                 => 'boolean|required',
                    'early_reg_end'             => 'date|nullable',
                    'early_ef'                  => 'numeric|nullable',
                    'full_ef'                   => 'numeric|required',
                    'junior_discount'           => 'numeric|nullable',
                    'details'                   => 'string|required',
                    'crosstable'                => 'string|nullable',
                    'pairings'                  => 'string|nullable',
                    'report'                    => 'string|nullable'
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
            $tournament->early_ef = $formData['early_ef'];
            $tournament->full_ef = $formData['full_ef'];
            $tournament->junior_discount = $formData['junior_discount'];
            $tournament->completed = $formData['completed'];
            $tournament->details = $formData['details'];
            if(isset($formData['crosstable'])) $tournament->crosstable = $formData['crosstable'];
            if(isset($formData['pairings'])) $tournament->pairings = $formData['pairings'];
            if(isset($formData['report'])) $tournament->report = $formData['report'];

            $tournament->save();

        } catch (Exception $e) {
            $errors[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Saving Page')->with('messages', $e->getMessage());
        }

        return redirect('/backend/tournament/browse');
    }

    /**
     * Returns a list of all the tournaments.
     *
     * @return $this
     */
    public function browse()
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $tournaments = Tournament::all();

        } catch (Exception $e) {
            return View::make('/errors/error')->with('page', 'Browse Page')->with('messages', $e->getMessage());
        }

        return view('/backend/tournament/browse')->with('tournaments', $tournaments);
    }

    /**
     * Delete a tournament. This will remove the entire record.
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * Register a player to a specific tournament.
     *
     * @param $tournament_id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register($tournament_id)
    {

        try {
            $tournament = Tournament::find($tournament_id);
            $player = Auth::user();
            $formData = Input::all();
            // If the player is already registered we don't want to register again.
            if (!(DB::table('tournament_user')->where('user_id', $player->id)->where('tournament_id', $tournament_id)->exists())) {
                $player->tournaments()->attach($tournament->id, ['byes' => (!empty($formData['bye']) ? implode(",", $formData['bye']) : "null"), 'paid' => false]);
            } else {
                throw new Exception('Already registered.');
            }

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Register Page')->with('messages', $e->getMessage());
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
            return view('/errors/error')->with('page', 'Withdraw Page')->with('messages', $e->getMessage());
        }

        return back();
    }

    public function registration_form($tournament_id)
    {
        try {
            $tournament = Tournament::find($tournament_id);
            $player = Auth::user();

            $rating = new \App\Classes\RatingList();
            $player_info = $rating->getRatingAndExpiry($player->cfc_number);
            $player->rating = $player_info['rating'];
            $player->cfc_expiry_date = $player_info['expiry']->format('Y-m-d');
            $player->save();

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Registration Form Page')->with('messages', $e->getMessage());
        }
        return view('/pages/registration_form')->with('tournament', $tournament)->with('player', $player);
    }

    public function player_details($tournament_id, $player_id) {
        try {
            $tournament = Tournament::find($tournament_id);
            $player = $tournament->users()->find($player_id);

            return view('/backend/tournament/player_details')->with('tournament', $tournament)->with('player', $player);

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Get Player Details Page')->with('messages', $e->getMessage());
        }
    }

    public function update_player ($tournament_id, $player_id) {
        try {
            $tournament = Tournament::find($tournament_id);
            $data = Input::all();
            $player = $tournament->users()->findOrFail($player_id);
            if(isset($data['byes'])) $player->pivot->byes = implode(",", $data['byes']);
            $player->pivot->paid = $data['paid'];
            $player->pivot->save();
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Update Player Details Page')->with('messages', $e->getMessage());
        }
        return redirect('/registered/'.$tournament_id);
    }



}
