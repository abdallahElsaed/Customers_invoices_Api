<?php

namespace App\Http\Controllers\Api\V1;

use App\Filter\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;


class CustomerController extends Controller
{

    use ApiResponseTrait ;
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

        $data = CustomerResource::collection($customer->paginate()->appends($request->query())); //[['column' ,'operators' , 'value']]
        return $this->apiResponse($data, 'ok', 200);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {

        $data =new CustomerResource(Customer::create($request->all()));
        return  $this->apiResponse($data, 'new user added', 200);
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
        $data= new CustomerResource($customer);
        return $this->apiResponse($data, 'ok', 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer = $customer->update($request->all());
        return $this->apiResponse($customer, 'user updated', 200);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
