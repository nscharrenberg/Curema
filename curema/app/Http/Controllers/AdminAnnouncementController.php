<?php

namespace App\Http\Controllers;

use App\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminAnnouncementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::where('dismissed', false)->get();
        $dismissed = Announcement::where('dismissed', true)->get();
        return view('admin.announcements.index', compact('announcements', 'dismissed'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function announcements()
    {
        $list = Announcement::where('dismissed', false)->get();
        return view('admin.announcements.show', compact('list'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
