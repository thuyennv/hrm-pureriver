<?php

namespace Nht\Console\Commands;

use Illuminate\Console\Command;
use NRedis;

class FbConversation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fbsub:conversation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscribe to nodejs channel post';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $redis = NRedis::connection();
        NRedis::subscribe('fb_conversation', function($message) {
            echo $message;
        });
        // $redis->publish('fb_conversation', json_encode(['test' => 1, 'ping' => 'Ok']));
        // $redis->subscribe("fb_conversation", function($message) {
        //     echo $message;
        // });
    }
}
