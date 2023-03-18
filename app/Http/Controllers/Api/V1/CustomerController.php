<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CustomerFilter();

        $filterItem = $filter->transform($request);


        $includeInvoice = $request->query('includeInvoice');
        $customer = Customer::where($filterItem);
        if ($includeInvoice) {
            $customer = Customer::with('invoices');
        }

        return CustomerResource::collection($customer->paginate()->appends($request->query())); //[['column' ,'operators' , 'value']]

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $includeInvoice = request()->query('includeInvoice');
        if ($includeInvoice) {
        return new CustomerResource($customer->loadMissing('invoices'));
        }
        return new CustomerResource($customer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
