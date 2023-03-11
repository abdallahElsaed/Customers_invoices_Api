<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\InvoiceFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new InvoiceFilter();

        $queryItems = $filter->transform($request);

        if (count($queryItems) ==  0 ) {
            return  InvoiceResource::collection( Invoice::paginate());
        }else{
            $invoice = Invoice::where($queryItems)->paginate();
            return InvoiceResource::collection( $invoice->appends($request->query()));//[['column' ,'operators' , 'value']]
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Invoice $invoice)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
