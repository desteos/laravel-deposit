<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepositRequest;
use App\Services\DepositService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DepositService $depositService)
    {
        $this->middleware('auth');

        $this->service = $depositService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(StoreDepositRequest $request)
    {
        $input = $request->post();

        $this->service->store($input['wallet_id'], $input['amount']);

        return redirect('dashboard');
    }
}
