<?php

namespace App\Http\Controllers;

use App\Category;
use App\Page;
use App\User;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            $categories = DB::table('page_categories')->get();
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Add Page')->with('messages', $e->getMessage());
        }
        // Take the form input and generate a page in the database.
        return view('/backend/pages/add')->with('categories', $categories);
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
            $categories = DB::table('page_categories')->get();
            $page = Page::find($id);
        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Editing Page')->with('messages', $e->getMessage());
        }
        return view('/backend/pages/edit')->with('page', $page)->with('categories', $categories);;
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
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
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

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Delete Page')->with('messages', $e->getMessage());
        }

        return view('/backend/pages/browse')->with('result', $pages);
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
                    'title'     => $formData['title'],
                    'entry'     => $formData['entry'],
                    'category'  => $formData['category']
                ),
                array(
                    'title'     => 'min:2|:required',
                    'entry'     => 'string|min:2|required',
                    'category'  => 'string|required'
                 )
            );
            // Check to see if the validator passes
            if (!$validator->passes()) {
                throw new Exception ($validator->errors());
            }

            if ($id == null) {
                $page = new Page();
                $page->poster = Auth::id();
            } else {
                $page = Page::find($id);
                $page->edit_by = Auth::id();
            }

            $page->title = $formData['title'];
            $page->entry = $formData['entry'];
            $page->category = $formData['category'];

            $page->save();

        } catch (Exception $e) {
            return view('/errors/error')->with('page', 'Saving Page')->with('messages', $e->getMessage());
        }
        return redirect('/backend/pages/browse');
    }
}
