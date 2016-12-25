<?php

namespace App\Http\Controllers;

use App\Pages;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;


class PagesController extends Controller
{
    // This controller will allow for the creation of specific pages.

    /**
     * Adds a new Page entry
     */
    public function add()
    {
        // Take the form input and generate a blog in the database.
        return view('/backend/pages/add');
    }

    /**
     * Edit a page.
     *
     * @param $id
     * @return $this
     */
    public function edit($id) {
        try {
            $page = Pages::find($id);
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $messages);
        }
        return view('/backend/pages/edit')->with('page', $page);
    }

    /**
     * Delete a Page
     *
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete($id)
    {
        try {
            $page = Pages::find($id);
            $page->delete();
        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $messages);
        }

        return redirect('/backend/pages/browse');
    }

    /**
     * Pull the Pages and return it as an arrary,
     * @return $this
     */
    public function browse()
    {
        try {
            $pages = Pages::all();
            $result = array();

            foreach ($pages as $page) {
                $result[] = array(
                    'id' => $page->id,
                    'title' => $page->title,
                    'poster' => $page->poster,
                    'author' => User::find($page->poster)->name,
                    'edited_by' => ($page->updated_at != $page->created_at) ? User::find($page->edit_by)->name : "",
                    'last_update' => ($page->updated_at != $page->created_at ? $page->updated_at : $page->created_at)
                );
            }

        } catch (Exception $e) {
            $messages[] = $e->getMessage();
            return View::make('/errors/error')->with('page', 'Delete Page')->with('messages', $messages);
        }

        return view('/backend/pages/browse')->with('result', $result);
    }

    /**
     * Save a Page
     *
     * This will save a page - if no ID is passed a new page is created, otherwise the page passed will
     * be updated.
     *
     * @param null $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save($id = null)
    {
        try {
            $formData = Input::all();

            $validator = Validator::make(
                array(
                    'title' => $formData['title'],
                    'entry' => $formData['entry'],
                ),
                array(
                    'title' => 'min:2|:required',
                    'entry' => 'string|min:2|required',
                )
            );
            // Check to see if the validator passes
            if (!$validator->passes()) {
                throw new Exception ($validator->errors());
            }

            if ($id == null) {
                $page = new Pages();
                $page->poster = 1;//Auth::id();
            } else {
                $page = Pages::find($id);
                $page->edit_by = 1;//Auth::id();
            }

            $page->title = $formData['title'];
            $page->entry = $formData['entry'];

            $page->save();

        } catch (Exception $e) {
            $errors = $e->getMessage();

            foreach ($errors->all() as $message) {
                $messages[] = $message;
                return view('/errors/error')->with('page', 'Saving Page')->with('messages', $messages);
            }
        }
        return redirect('/backend/pages/browse');
    }
}
