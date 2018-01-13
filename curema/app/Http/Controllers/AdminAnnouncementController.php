<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAnnouncementController extends Controller
{
    /**
     * Instantiating Controller constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**
     * displaying the Announcement View with an overview of all Announcements.
     * Seperated between "active" announcements and "dismissed" announcements.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $announcements = Announcement::where('dismissed', false)->get();
        $dismissed = Announcement::where('dismissed', true)->get();
        return view('admin.announcements.index', compact('announcements', 'dismissed'));
    }

    /**
     * Displays the form to create an announcement.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Storing the announcement to the database and going through some validations to make sure no illigal data is passed through.
     *
     * @param Request $request - Contains an array with all submitted form data.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'subject' => 'required',
            'content_body' => 'required',
        ]);

        $announcement = Announcement::create([
            'subject' => $request->subject,
            'content' => $request->content_body,
            'showToClients' => $request->showToClients,
            'showToStaff' => $request->showToStaff,
            'showMyName' => $request->showMyName,
            'admin_id' => auth()->user()->id
        ]);

        Session::flash('created_announcement', 'The Announcement ' . $announcement->subject . 'has been placed!');
        return redirect('/admin/announcements');
    }

    /**
     * Display all announcements which are not dismissed.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function announcements()
    {
        $list = Announcement::where('dismissed', false)->get();
        return view('admin.announcements.show', compact('list'));
    }

    /**
     * Displays the form filled with data about an already existing announcement.
     *
     * @param $id - Integer which stands for the announcement id.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Updating an existing announcement in the database and going through some validations to make sure no illigal data is passed through.
     *
     * @param Request $request - Contains an array with all submitted form data.
     * @param $id - Integer which stands for the announcement id.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'subject' => 'required',
            'content_body' => 'required',
        ]);

        $announcement = Announcement::findOrFail($id);
        $announcement->subject = $request->subject;
        $announcement->content = $request->content_body;
        $announcement->showToClients = $request->showToClients;
        $announcement->showToStaff = $request->showToStaff;
        $announcement->showMyName = $request->showMyName;
        $announcement->dismissed = $request->dismissed;
        $announcement->update();

        Session::flash('updated_announcement', 'The Announcement ' . $announcement->subject . 'has been changed!');
        return redirect('/admin/announcements');
    }

    /**
     * Removes the announcement from the database IF the announcement is dismissed.
     *
     * @param $id - Integer which stands for the announcement id.
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $announcement = Announcement::findOrFail($id);
        if($announcement->dismissed) {
            $announcement->delete();
            Session::flash('deleted_announcement', 'The Announcement ' . $announcement->subject . 'has been deleted!');
            return redirect('/admin/announcements');
        }

        Session::flash('deleted_failed_announcement', 'The Announcement ' . $announcement->subject . 'is not dismissed, thus it can not be deleted!');
        return redirect('/admin/announcements');
    }
}
