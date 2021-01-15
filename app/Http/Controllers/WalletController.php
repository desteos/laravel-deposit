<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateWalletRequest;
use App\Services\WalletService;

class WalletController extends Controller
{
    private $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WalletService $walletService)
    {
        $this->middleware('auth');

        $this->service = $walletService;
    }

    /**
     * @param $id
     * @param  UpdateWalletRequest  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateWalletRequest $request)
    {
        $this->service->increase($id, $request->post('amount'));

        return redirect('dashboard');
    }
}
