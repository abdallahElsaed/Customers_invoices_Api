<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class InvoiceFilter extends ApiFilter
{
    protected $safeParams = [
        'amount' => ['eq' , 'gt' ,'gte', 'lt' ,'lte'],
        'customerId' => ['eq'],
        'status' => ['eq' , 'ne'],
        'billedDate' => ['eq' , 'gt' , 'lt'],
        'paidDate' => ['eq' , 'gt' , 'lt'],
    ];

    protected $columnMap = [
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
        'customerId'=> 'customer_id'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];


}
