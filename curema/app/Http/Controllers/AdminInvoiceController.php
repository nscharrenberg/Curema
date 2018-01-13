<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Client;
use App\Currency;
use App\Http\Requests\InvoiceCreateRequest;
use App\Invoice;
use App\InvoiceItem;
use App\InvoiceItemTax;
use App\PaymentType;
use App\Tax;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminInvoiceController extends Controller
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
        try {
            $invoices = Invoice::all();
        } catch(Exception $e) {
            report($e);
        }
        return view('admin.invoices.index', compact('invoices'));
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
        $types = PaymentType::pluck('name', 'id')->all();
        $agents = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $recurring = [0 => 'No', 1 => 'Every 1 month'];
        for ($i = 1; $i < 13; $i++) { $recurring = $recurring + [$i => 'Every ' . $i . ' months']; }
        $recurring = $recurring + [13 => 'Custom'];
        $customTypes = ['days' => 'Day(s)', 'weeks' => 'Week(s)', 'months' => 'Month(s)', 'years' => 'Year(s)'];
        $discountType = [0 => 'No Discount', 1 => 'Before Tax', 3 => 'After Tax'];
        $taxes = Tax::all(['id', 'name', 'rate'])->pluck('fulltax', 'id');
        return view('admin.invoices.create', compact('clients', 'currencies', 'agents', 'types', 'recurring', 'customTypes', 'discountType', 'taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceCreateRequest $request)
    {
            if ($request->recurring == 13) {
                $invoice = Invoice::create([
                    // Gives Unexpected data found exception for some weird reason.
                    'client_id' => $request->client_id,
                    'number' => $request->number,
                    'prefix' => 'INV-',
                    'date' => Carbon::createFromFormat("Y/m/d", $request->date),
                    'deadline' => Carbon::createFromFormat("Y/m/d", $request->deadline),
                    'allowed_payment_types' => serialize($request->allowed_payment_types),
                    'currency_id' => $request->currency_id,
                    'sales_agent' => $request->agent_id,
                    'recurring' => $request->repeat_every_custom,
                    'custom_recurring' => true,
                    'recurring_type' => $request->repeat_type_custom,
                    'recurring_deadline' => Carbon::createFromFormat("Y/m/d", $request->recurring_ends_on),
                    'admin_note' => $request->admin_note,
                    'show_quantity_as' => $request->show_quantity_as,
                    'subtotal' => $request->subtotal,
                    'discount_percentage' => $request->discount_percentage,
                    'adjustment' => $request->adjustment,
                    'discount_type' => $request->discount_type,
                    'total' => $request->total,
                    'client_note' => $request->client_note,
                    'terms' => $request->terms,
                    'cancel_overdue_reminder' => $request->cancel_overdue_reminder
                ]);
            } else {
                $invoice = Invoice::create([
                    'client_id' => $request->client_id,
                    'number' => $request->number,
                    'prefix' => 'INV-',
                    'date' => Carbon::createFromFormat("Y/m/d", $request->date),
                    'deadline' => Carbon::createFromFormat("Y/m/d", $request->deadline),
                    'allowed_payment_types' => serialize($request->allowed_payment_types),
                    'currency_id' => $request->currency_id,
                    'sales_agent' => $request->agent_id,
                    'recurring' => $request->recurring,
                    'admin_note' => $request->admin_note,
                    'show_quantity_as' => $request->show_quantity_as,
                    'subtotal' => $request->subtotal,
                    'discount_percentage' => $request->discount_percentage,
                    'adjustment' => $request->adjustment,
                    'discount_type' => $request->discount_type,
                    'total' => $request->total,
                    'client_note' => $request->client_note,
                    'terms' => $request->terms,
                    'cancel_overdue_reminder' => $request->cancel_overdue_reminder
                ]);
            }


        foreach ($request->name as $key => $value) {
            $invoice_item = InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'name' => $request->name[$key],
                'description' => $request->description[$key],
                'quantity' => $request->quantity[$key],
                'rate' => $request->rate[$key],
                'unit' => $request->unit[$key],
            ]);

            if(is_array($request->tax[$key]) || is_object($request->tax[$key])) {
                foreach($request->tax[$key] as $tax => $taxValue) {
                    $selectedTax = Tax::findOrFail($taxValue);
                    InvoiceItemTax::create([
                        'item_id' => $invoice_item->id,
                        'invoice_id' => $invoice->id,
                        'rate' => $selectedTax->rate,
                        'name' => $selectedTax->name
                    ]);
                }
            } else {
                $selectedTax = Tax::findOrFail($request->tax[$key]);

                InvoiceItemTax::create([
                    'item_id' => $invoice_item->id,
                    'invoice_id' => $invoice->id,
                    'rate' => $selectedTax->rate,
                    'name' => $selectedTax->name
                ]);
            }
        }
        Session::flash('created_invoice', 'The invoice with Reference Nr: ' . $invoice->prefix . ' ' . $invoice->number . ' has been created!');
        return redirect('/admin/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        $payTypesArray = array();
        foreach(unserialize($invoice->allowed_payment_types) as $payType) {
            $payTypesArray[] = PaymentType::findOrFail($payType);
        }

        return view('admin.invoices.show', compact('invoice', 'payTypesArray'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);
        $payTypesArray = array();
        foreach(unserialize($invoice->allowed_payment_types) as $payType) {
            $payTypesArray[] = PaymentType::findOrFail($payType);
        }
        $clients = Client::pluck('company', 'id')->all();
        $currencies = Currency::pluck('name', 'id')->prepend('Select A Currency', '')->all();
        $types = PaymentType::pluck('name', 'id')->all();
        $agents = Admin::all(['id', 'firstname', 'lastname'])->pluck('fullname', 'id')->prepend('Select A Sales Agent', '');
        $recurring = [0 => 'No', 1 => 'Every 1 month'];
        for ($i = 1; $i < 13; $i++) { $recurring = $recurring + [$i => 'Every ' . $i . ' months']; }
        $recurring = $recurring + [13 => 'Custom'];
        $customTypes = ['days' => 'Day(s)', 'weeks' => 'Week(s)', 'months' => 'Month(s)', 'years' => 'Year(s)'];
        $discountType = [0 => 'No Discount', 1 => 'Before Tax', 3 => 'After Tax'];
        $taxes = Tax::all(['id', 'name', 'rate'])->pluck('fulltax', 'id');
        return view('admin.invoices.edit', compact('invoice', 'payTypesArray', 'clients', 'currencies', 'types', 'agents', 'recurring', 'customTypes', 'discountType', 'taxes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InvoiceCreateRequest $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        if($request->recurring == 13) {
            //Modify Invoice Information
            $invoice->client_id = $request->client_id;
            $invoice->date = Carbon::createFromFormat("Y/m/d", $request->date);
            $invoice->deadline = Carbon::createFromFormat("Y/m/d", $request->deadline);
            $invoice->allowed_payment_types = serialize($request->allowed_payment_types);
            $invoice->currency_id = $request->currency_id;
            $invoice->sales_Agent = $request->agent_id;
            $invoice->recurring = $request->repeat_every_custom;
            $invoice->recurring_type = $request->repeat_type_custom;
            $invoice->custom_recurring = true;
            $invoice->recurring_deadline = Carbon::createFromFormat("Y/m/d", $request->recurring_ends_on);
            $invoice->admin_note = $request->admin_note;
            $invoice->show_quantity_as = $request->show_quantity_as;
            $invoice->subtotal = $request->subtotal;
            $invoice->discount_percentage = $request->discount_percentage;
            $invoice->adjustment = $request->adjustment;
            $invoice->discount_type = $request->discount_type;
            $invoice->total = $request->total;
            $invoice->client_note = $request->client_note;
            $invoice->terms = $request->terms;
            $invoice->cancel_overdue_reminder = $request->cancel_overdue_reminder;
            $invoice->save();
        } else {
            //Modify Invoice Information
            $invoice->client_id = $request->client_id;
            $invoice->date = Carbon::createFromFormat("Y/m/d", $request->date);
            $invoice->deadline = Carbon::createFromFormat("Y/m/d", $request->deadline);
            $invoice->allowed_payment_types = serialize($request->allowed_payment_types);
            $invoice->currency_id = $request->currency_id;
            $invoice->sales_Agent = $request->agent_id;
            $invoice->recurring = $request->recurring;
            $invoice->admin_note = $request->admin_note;
            $invoice->show_quantity_as = $request->show_quantity_as;
            $invoice->subtotal = $request->subtotal;
            $invoice->discount_percentage = $request->discount_percentage;
            $invoice->adjustment = $request->adjustment;
            $invoice->discount_type = $request->discount_type;
            $invoice->total = $request->total;
            $invoice->client_note = $request->client_note;
            $invoice->terms = $request->terms;
            $invoice->cancel_overdue_reminder = $request->cancel_overdue_reminder;
            $invoice->save();
        }

        Session::flash('updated_invoice', 'The invoice with Reference Nr: ' . $invoice->prefix . ' ' . $invoice->number . ' has been updated!');
        return redirect('/admin/invoices');
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
