<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\customerQuery;
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

        $filter = new customerQuery();

        $queryItems = $filter->transform($request);

        if (count($queryItems) ==  0 ) {
            return  CustomerResource::collection( Customer::paginate());
        }else{
            return CustomerResource::collection( Customer::where($queryItems)->paginate());
        }

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
