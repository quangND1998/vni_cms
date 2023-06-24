<?php

namespace App\Jobs;

use App\Mail\DefaultMail;
use App\Models\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Mail as FacadesMail;

class SendMailDefault implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mail;
    protected $users;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($users, Mail $mail)
    {
        $this->users = $users;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->users;
       
        $mail = $this->mail;
        
        foreach ($users as $user) {
            FacadesMail::to($user->email)->send(new DefaultMail($user, $mail));
            //Mail::to("ngant1096@gmail.com")->send(new DefaultMail($user, $mail));
        }
    }
}
