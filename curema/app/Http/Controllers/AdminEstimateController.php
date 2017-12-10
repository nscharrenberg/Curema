<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Currency;
use App\Estimate;
use App\EstimateItem;
use App\EstimateItemTax;
use App\Http\Requests\EstimateCreateRequest;
use App\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminEstimateController extends Controller
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
        $estimates = Estimate::all();
        return view('admin.estimates.index', compact('estimates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('company', 'id')->all();
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $agents = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $discountType = [0 => 'No Discount', 1 => 'Before Tax', 3 => 'After Tax'];
        $taxes = Tax::all(['id', 'name', 'rate'])->pluck('fulltax', 'id');
        return view('admin.estimates.create', compact('clients', 'currencies', 'agents', 'customTypes', 'discountType', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstimateCreateRequest $request)
    {
        $estimate = Estimate::create([
            // Gives Unexpected data found exception for some weird reason.
            'client_id' => $request->client_id,
            'number' => $request->number,
            'prefix' => 'EST-',
            'date' => Carbon::createFromFormat("Y/m/d", $request->date),
            'deadline' => Carbon::createFromFormat("Y/m/d", $request->deadline),
            'currency_id' => $request->currency_id,
            'sales_agent' => $request->agent_id,
            'admin_note' => $request->admin_note,
            'show_quantity_as' => $request->show_quantity_as,
            'subtotal' => $request->subtotal,
            'discount_percentage' => $request->discount_percentage,
            'adjustment' => $request->adjustment,
            'discount_type' => $request->discount_type,
            'total' => $request->total,
            'client_note' => $request->client_note,
            'terms' => $request->terms,
        ]);


        foreach ($request->name as $key => $value) {
            $estimate_item = EstimateItem::create([
                'estimate_id' => $estimate->id,
                'name' => $request->name[$key],
                'description' => $request->description[$key],
                'quantity' => $request->quantity[$key],
                'rate' => $request->rate[$key],
                'unit' => $request->unit[$key],
            ]);

            if(is_array($request->tax[$key]) || is_object($request->tax[$key])) {
                foreach($request->tax[$key] as $tax => $taxValue) {
                    $selectedTax = Tax::findOrFail($taxValue);
                    EstimateItemTax::create([
                        'item_id' => $estimate_item->id,
                        'estimate_id' => $estimate->id,
                        'rate' => $selectedTax->rate,
                        'name' => $selectedTax->name
                    ]);
                }
            } else {
                $selectedTax = Tax::findOrFail($request->tax[$key]);

                EstimateItemTax::create([
                    'item_id' => $estimate_item->id,
                    'estimate_id' => $estimate->id,
                    'rate' => $selectedTax->rate,
                    'name' => $selectedTax->name
                ]);
            }
        }
        Session::flash('created_estimate', 'The estimate with Reference Nr: ' . $estimate->prefix . ' ' . $estimate->number . ' has been created!');
        return redirect('/admin/estimates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estimate = Estimate::findOrFail($id);
        return view('admin.estimates.show', compact('estimate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $estimate = Estimate::findOrFail($id);
        $clients = Client::pluck('company', 'id')->all();
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $agents = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $discountType = [0 => 'No Discount', 1 => 'Before Tax', 3 => 'After Tax'];
        $taxes = Tax::all(['id', 'name', 'rate'])->pluck('fulltax', 'id');
        return view('admin.estimates.edit', compact('estimate', 'clients', 'currencies', 'agents', 'discountType', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstimateCreateRequest $request, $id)
    {
        $estimate = Estimate::findOrFail($id);

        //Modify Invoice Information
        $estimate->client_id = $request->client_id;
        $estimate->date = Carbon::createFromFormat("Y/m/d", $request->date);
        $estimate->deadline = Carbon::createFromFormat("Y/m/d", $request->deadline);
        $estimate->currency_id = $request->currency_id;
        $estimate->sales_Agent = $request->agent_id;
        $estimate->admin_note = $request->admin_note;
        $estimate->show_quantity_as = $request->show_quantity_as;
        $estimate->subtotal = $request->subtotal;
        $estimate->discount_percentage = $request->discount_percentage;
        $estimate->adjustment = $request->adjustment;
        $estimate->discount_type = $request->discount_type;
        $estimate->total = $request->total;
        $estimate->client_note = $request->client_note;
        $estimate->terms = $request->terms;
        if($request->kanban_order != null) {
            $estimate->kanban_order = $request->kanban_order;
        }
        $estimate->save();

        Session::flash('updated_estimate', 'The estimaet with Reference Nr: ' . $estimate->prefix . ' ' . $estimate->number . ' has been updated!');
        return redirect('/admin/estimates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
