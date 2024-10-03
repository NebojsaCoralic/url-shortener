<?php

namespace App\Console\Commands;

use App\Models\Url;
use Illuminate\Console\Command;

class SendNotificationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'urls:send-notification-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending notification email for urls which are expiring tomorrow';

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
        $urls = (new Url()) -> where('is_expired', 0) -> where('expires_at', '<', now()->addDays(1)) -> get();

        if(!$urls)
            return 0;

        foreach ($urls as $url)
        {
            /*
             send mail to $url -> user -> mail
             */
        }

        return 0;
    }
}
