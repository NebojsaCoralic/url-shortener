<?php

namespace App\Console\Commands;

use App\Models\Url;
use Illuminate\Console\Command;

class CheckExpirationDate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urls:check-expiration-date';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for disable urls after expiration date';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new Url()) -> where('is_expired', 0) -> where('expires_at', '<', now()) -> update(['is_expired' => 1]);
        return 0;
    }
}
