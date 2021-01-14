<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        //todo validation
        $input = $request->post();

        $this->service->store($input['wallet_id'], $input['amount']);

        return redirect('dashboard');
    }

    public function update($id, Request $request)
    {
        //todo validation
        $this->service->update($id, $request->post('amount'));

        return redirect('dashboard');
    }
}
