<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\PaymentRepository;

class StatisticsController extends Controller
{
    protected $payment;

    public function __construct(PaymentRepository $payment) {
        $this->payment = $payment;
    }


    public function index()
    {
        return response()
              ->json($this->payment->statistics(),200)
              ->header('Content-Type', 'application/json');
    }
}
