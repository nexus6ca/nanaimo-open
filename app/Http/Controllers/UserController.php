<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Add Tournament Page')->with('messages', $messages);
        }
        return view('/backend/users/browse')->with('users', $users);
    }

    public function save($id) {
        try {
            try {
                $data = Input::all();
                $validator = Validator::make(
                    array(
                        'name'          => $data['name'],
                        'email'         => $data['email'],
                        'address1'      => $data['address1'],
                        'address2'      => $data['address2'],
                        'city'          => $data['city'],
                        'prov'          => $data['prov'],
                        'postal'        => $data['postal'],
                    ),
                    array(
                        'name'          => 'required|max:255',
                        'email'         => 'required|email|max:255',
                        'address1'      => 'required|max:255',
                        'address2'      => 'max:255',
                        'city'          => 'required|max:255',
                        'prov'          => 'required|max:3',
                        'postal'        => 'required|max:7',
                    )
                );
                // Check to see if the validator passes
                if (!$validator->passes()) {
                    throw new Exception ($validator->errors());
                }

                $user = User::find($id);


                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->address1 = $data['address1'];
                $user->address2 = $data['address2'];
                $user->city = $data['city'];
                $user->prov = $data['prov'];
                $user->postal = $data['postal'];
                if(Auth::user()->isAdmin) { $user->isAdmin = $data['isAdmin']; }
                $user->save();

            } catch (Exception $e) {
                $errors[] = $e->getMessage();
                foreach ($errors as $message) {
                    $messages[] = $message;
                }
                return view('/errors/error')->with('page', 'Saving Page')->with('messages', $messages);
            }

            return back();
        }catch(Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Add Tournament Page')->with('messages', $messages);
        }
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
