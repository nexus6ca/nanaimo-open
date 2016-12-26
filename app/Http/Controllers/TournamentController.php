<?php

namespace App\Http\Controllers;

use App\Tournament;
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
    public function add() {
        try {
            // Check to see if the user is an Admin
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }
        } catch (Exception $e) {

            return view('/errors/error')->with('page', 'Add Page')->with('messages', $messages[] = $e->getMessage());
        }
        // Take the form input and generate a blog in the database.
        return view('/backend/tournament/add');
    }

    public function edit($id) {
        try {
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $tournament = Tournament::find($id);
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }
        return view('/backend/tournament/edit')->with('tournament', $tournament);
    }


    public function save($id = null)
    {
        try {
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $formData = Input::all();

            $validator = Validator::make(
                array(
                    'start_date'    => $formData['start_date'],
                    'end_date'      => $formData['end_date'],
                    'early_reg_end' => $formData['early_reg_end'],
                    'completed'     => $formData['completed'],
                    'page_id'       => $formData['page_id'],
                ),
                array(
                    'start_date'    => 'date|required',
                    'end_date'      => 'date|required',
                    'early_reg_end' => 'date|required',
                    'completed'     => 'boolean|required',
                    'early_reg_end' => 'date|required',
                    'page_id'       => 'integer|required',

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

            $tournament->start_date = $formData['start_date'];
            $tournament->end_date = $formData['end_date'];
            $tournament->early_reg_end = $formData['early_reg_end'];
            $tournament->page_id = $formData['page_id'];

            $tournament->save();

        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Saving Page')->with('messages', $messages);
            }
        }
        return redirect('/backend/tournament/browse');
    }

    public function browse() {
        try {
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $tournaments = Tournament::all();

        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return View::make('/errors/error')->with('page', 'Delete Page')->with('messages', $messages);
        }

        return view('/backend/pages/browse')->with('tournaments', $tournaments);
    }

    public function register($user_id, $tournament_id) {
/*        // From a button on front end view, does not need to be admin
        $tournament = Tournament::find($tournament_id);
        $tournament->user()->attach($user_i);

        $*/

    }

    public function withdraw($user_id) {

    }

}
