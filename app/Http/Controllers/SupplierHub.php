<?php


namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Suppliers;


class SupplierHub extends Controller
{
    protected $suppliers;

    public function __construct()
    {
        $this->suppliers = new Suppliers;
    }

    public function index()
    {
        $suppliers = $this->suppliers->all();
        return view('suppliers_hub.index')
            ->with('suppliers', $suppliers);
    }

    public function show($supplier)
    {
        $supplier = $this->suppliers->find($supplier);
        return view('suppliers_hub.supplier')
            ->with('supplier', $supplier);
    }

    public function create_form()
    {
        return view('suppliers_hub.create');
    }

    public function create(Request $request)
    {
        $supplier = new Suppliers();
        $supplier->name = $request->name;
        $supplier->logo_url = $request->logo_url;
        $supplier->general_phone = $request->general_phone;
        $supplier->sme_phone = $request->sme_phone;
        $supplier->sme_email_info = $request->sme_email_info;
        $supplier->sme_email_termination = $request->sme_email_termination;
        $supplier->sme_account_manager = $request->sme_account_manager;
        $supplier->sme_account_manager_dd = $request->sme_account_manager_dd;
        $supplier->sme_account_manager_email = $request->sme_account_manager_email;
        $supplier->corporate_phone = $request->corporate_phone;
        $supplier->corporate_email_info = $request->corporate_email_info;
        $supplier->corporate_email_termination = $request->corporate_email_termination;
        $supplier->corporate_account_manager = $request->corporate_account_manager;
        $supplier->corporate_account_manager_dd = $request->corporate_account_manager_dd;
        $supplier->corporate_account_manager_email = $request->corporate_account_manager_email;
        $supplier->direct = $request->direct;
        $supplier->aggregator = $request->aggregator;

        $supplier->supplier_and_product_info = $request->supplier_and_product_info;
        $supplier->customer_service_and_billing = $request->customer_service_and_billing;
        $supplier->renewal_cycle = $request->renewal_cycle;
        $supplier->credit_and_restrictions = $request->credit_and_restrictions;
        $supplier->save();

        flash('Supplier Created', 'success');

        return redirect()
            ->route('suppliers-hub.supplier', $supplier->id);
    }

    public function update_form($supplier)
    {
        $supplier = $this->suppliers->find($supplier);
        return view('suppliers_hub.edit')
            ->with('supplier', $supplier);
    }

    public function update(Request $request)
    {
        $supplier = $this->suppliers->find($request->id);
        $supplier->name = $request->name;
        $supplier->logo_url = $request->logo_url;
        $supplier->general_phone = $request->general_phone;
        $supplier->sme_phone = $request->sme_phone;
        $supplier->sme_email_info = $request->sme_email_info;
        $supplier->sme_email_termination = $request->sme_email_termination;
        $supplier->sme_account_manager = $request->sme_account_manager;
        $supplier->sme_account_manager_dd = $request->sme_account_manager_dd;
        $supplier->sme_account_manager_email = $request->sme_account_manager_email;
        $supplier->corporate_phone = $request->corporate_phone;
        $supplier->corporate_email_info = $request->corporate_email_info;
        $supplier->corporate_email_termination = $request->corporate_email_termination;
        $supplier->corporate_account_manager = $request->corporate_account_manager;
        $supplier->corporate_account_manager_dd = $request->corporate_account_manager_dd;
        $supplier->corporate_account_manager_email = $request->corporate_account_manager_email;
        $supplier->direct = $request->direct;
        $supplier->aggregator = $request->aggregator;

        $supplier->supplier_and_product_info = $request->supplier_and_product_info;
        $supplier->customer_service_and_billing = $request->customer_service_and_billing;
        $supplier->renewal_cycle = $request->renewal_cycle;
        $supplier->credit_and_restrictions = $request->credit_and_restrictions;
        $supplier->save();

        flash('Supplier Updated', 'success');

        return redirect()
            ->route('suppliers-hub.supplier', $supplier->id);

    }
}