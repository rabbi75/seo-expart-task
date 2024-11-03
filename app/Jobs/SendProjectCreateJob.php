<?php

namespace App\Jobs;

use App\Mail\ProjectCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendProjectCreateJob implements ShouldQueue
{
    use Queueable;

    public $project;
    /**
     * Create a new job instance.
     */
    public function __construct($project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to(config('mail.admin_email'))->send(new ProjectCreated($this->project));
    }
}
