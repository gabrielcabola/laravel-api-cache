<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Repositories\PaymentRepository as Payment;

class PaymentController extends Controller
{

    protected $payment;

    public function __construct(Payment $payment) {
      $this->payment = $payment;
    }

    public function store(PaymentRequest $request)
    {

      if($request->validated()) {

        //try store information
         try {

            return response()
                  ->json($this->payment->add($request),201)
                  ->header('Content-Type', 'application/json');

           } catch (Exception $e) {
                return response()
                   ->json(['error'=>$e],501)
                   ->header('Content-Type', 'application/json');

           }

      }
    }
}
