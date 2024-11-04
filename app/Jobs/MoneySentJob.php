<?php

namespace App\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class MoneySentJob implements ShouldQueue
{
    use Queueable;

    public $amount;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->amount = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if($this->amount>100){
            throw new \Exception("Money Transfer failed");
        }

        echo "BD {$this->amount} is transferred succefully";
    }

    public function failed($exception){
        Mail::send([],[],function($msg){
            $msg->to('rabbicse10@gmail.com')
            ->subject('Money transfer failed')
            ->html('Hi, Money transfer not sent');
        });
    }
}

// $transfer = new MoneySentJob(150);

// try {
//     $transfer->handle();
// } catch (\Exception $e) {
//     echo $e->getMessage(); // Expected output: "Money Transfer failed"
// }
