<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Notifications\notifyInactive;
use Illuminate\Notifications\Notification;



class EmailInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email inactive users';

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
     * @return mixed
     */
    public function handle()
    {
        $limit=Carbon::now()->subMinute(10);

        $inActiveUsers=User::where('last_login', '<',  $limit)->get();
//        $this->info($inActiveUsers);
        foreach ($inActiveUsers as $user){

            $user->notify(new notifyInactive($user));


            $this->info('Email sent successfully to '.$user->email);
        }
    }
}
