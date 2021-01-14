<?php

namespace App\Console\Commands;

use App\Models\Deposit;
use App\Services\DepositService;
use Illuminate\Console\Command;

class AccrualsOnDeposit extends Command
{
    private $depositService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accruals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Accruals on deposit';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(DepositService $depositService)
    {
        parent::__construct();

        $this->depositService = $depositService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $deposits = Deposit::query()
            ->where('active', 1)
            ->get();

        foreach ($deposits as $deposit) {
            $this->depositService->accrue($deposit);
        }
    }
}
