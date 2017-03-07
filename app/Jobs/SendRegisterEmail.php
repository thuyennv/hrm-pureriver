<?php

namespace Nht\Jobs;

use Nht\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Nht\Hocs\Users\User;
use Illuminate\Contracts\Mail\Mailer;

class SendRegisterEmail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send('emails.welcome', ['user' => $this->user->name], function($m) {
            $m->to($this->user->email);
        });
    }
}
