<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
//{id} {--action=}

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add User';

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
        //
        //print $this->ask('What is your name?');
       $a =  User::create([
            "name" => "sdfeeeeeeeee",
            "email" => "abd@dfkdeeeeeeeee.com",
            'password'=> "dfdfd",
            "type" => "admin"
        ]);
       // print_r($a);
    }
}
