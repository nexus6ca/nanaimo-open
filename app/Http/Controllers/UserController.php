<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use App\User;
use Exception;

class UserController extends Controller
{
    //
    public function display($id = null){
        try {
            $user = ($id==null) ? Auth::user() : User::find($id);
        }catch(Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Add Tournament Page')->with('messages', $messages);
        }

        return view('/pages/profile/display')->with('user', $user);
    }

    public function browse() {
        try {
            if(!Auth::user()->isAdmin) {
                throw new Exception('Not Authorized');
            }

            $users = User::all();

        }catch(Exception $e) {
            $errors = $e->getMessage();
            return view('/errors/error')->with('page', 'Add Tournament Page')->with('messages', $errors);
        }
        return view('/backend/users/browse')->with('users', $users);
    }

    public function save($id) {
            try {
                $data = Input::all();
                $validator = Validator::make(
                    array(
                        'name'          => $data['name'],
                        'email'         => $data['email'],
                        'city'          => $data['city'],
                        'prov'          => $data['prov'],
                        'cfc_number'    => $data['cfc_number'],
                        'age'           => $data['age']

                    ),
                    array(
                        'name'          => 'required|max:255',
                        'email'         => 'required|email|max:255',
                        'city'          => 'required|max:255',
                        'prov'          => 'required|max:3',
                        'cfc_number'    => 'integer',
                        'age'           => 'required'
                    )
                );

                // Check to see if the validator passes
                if (!$validator->passes()) {
                    throw new Exception ($validator->errors());
                }

                $user = User::find($id);

                // Updating user rating.
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->city = $data['city'];
                $user->prov = $data['prov'];
                $user->cfc_number = $data['cfc_number'];
                $user->age = $data['age'];
                if(Auth::user()->isAdmin) {
                    $user->isAdmin = $data['isAdmin'];
                }
                $user->save();

            } catch (Exception $e) {
                $errors[] = $e->getMessage();

                return view('/errors/error')->with('page', 'Saving User')->with('messages', $errors);
            }

            return Redirect::intended('/');
    }

    public function delete($id)
    {
        try {
            if (!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            if($id == 1) {
                throw new Exception('You can not delete the Admin account.');
            }

            $user = User::find($id);
            $user->delete();

        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $messages);
        }

        return back();
    }
}
