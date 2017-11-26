<?php

namespace App\Http\Controllers\Addons;

use App\Addons\UwvContact;
use App\Addons\UwvProcess;
use App\Addons\UwvProcessContact;
use App\Addons\UwvService;
use App\Http\Requests\Addons\UwvProcessRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminUwvProcessController extends Controller
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
        $processes = UwvProcess::all();
        return view('admin.uwv.processes.index', compact('processes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = User::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An Client', '');
        $contacts = UwvContact::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An UWV Contact', '');
        $services = UwvService::pluck('name', 'id')->all();
        return view('admin.uwv.processes.create', compact('contacts', 'services', 'clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UwvProcessRequest $request)
    {
        $process = UwvProcess::create([
            'client_id' => $request->client_id,
            'ordernr' => $request->ordernr,
            'uwv_service_id' => $request->uwv_service_id,
            'start_date' => Carbon::createFromFormat("Y/m/d", $request->start_date),
            'end_date' => Carbon::createFromFormat("Y/m/d", $request->start_date)->addMonths($request->end_date),
        ]);

        foreach($request->contacts as $contact) {
            if ($contact != null) {
                UwvProcessContact::create([
                    'process_id' => $process->id,
                    'contact_id' => $contact
                ]);
            }
        }

        Session::flash('created_uwv_process', 'The UWV Process ' . $process->ordernr . ' for ' . $process->client->fullname . ' has been created');
        return redirect('/admin/uwv/processes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $process = UwvProcess::findOrFail($id);
        $clients = User::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An Client', '');
        $contacts = UwvContact::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select An UWV Contact', '');
        $services = UwvService::pluck('name', 'id')->all();
        $processContacts = $process->contacts;
        return view('admin.uwv.processes.edit', compact('process', 'clients', 'contacts', 'services', 'processContacts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UwvProcessRequest $request, $id)
    {

        $process = UwvProcess::findOrFail($id);
        $process->uwv_service_id = $request->uwv_service_id;
        $process->start_date = Carbon::createFromFormat("Y/m/d", $request->start_date);
        $process->end_date = Carbon::createFromFormat("Y/m/d", $request->start_date)->addMonths($request->end_date);
        $process->update();

        foreach (UwvContact::all() as $contact) {

            /*
             * Find the contact Id value from the $request->contacts array, which will return the key for the $requests->contacts array.
             * It then iterates through the $requests->contacts id per key and compares it's value with the contact Id it is currently at.
             * If it's found it'll search wether it exists already and else it'll create one.
             * If it's not found it'll search wether it exists and if it does, it'll delete it from the database.
             */

            if($contact->id == $request->contacts[array_search($contact->id ,$request->contacts)]) {
                // Add or do not
                UwvProcessContact::firstOrcreate([
                    'process_id' => $process->id,
                    'contact_id' => $contact->id
                ]);
            } else {
                UwvProcessContact::whereContactId($contact->id)->whereProcessId($process->id)->delete();
            }
        }

        Session::flash('updated_uwv_process', 'The UWV Contact ' . $process->firstname . ' ' . $process->lastname .  ' has been updated');
        return redirect('/admin/uwv/processes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $process = UwvProcess::findOrFail($id);
        $process->delete();
        Session::flash('deleted_uwv_process', 'The UWV Contact ' . $process->firstname . ' ' . $process->lastname . ' has been deleted!');
        return redirect('/admin/uwv/processes');
    }
}
