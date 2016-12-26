<?php

namespace App\Http\Controllers;

use App\Page;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Validator;


class PageController extends Controller
{
    // This controller will allow for the creation of specific pages.

    /**
     * Adds a new Page entry
     */
    public function add()
    {
        try {
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }
        } catch (Exception $e) {

            return view('/errors/error')->with('page', 'Add Page')->with('messages', $messages[] = $e->getMessage());
        }
        // Take the form input and generate a page in the database.
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
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $page = Page::find($id);
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
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $page = Page::find($id);
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
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

            $pages = Page::all();
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
            if(!(Auth::user()->isAdmin)) {
                throw new Exception('Not Authorized');
            }

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
                $page = new Page();
                $page->poster = 1;//Auth::id();
            } else {
                $page = Page::find($id);
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
