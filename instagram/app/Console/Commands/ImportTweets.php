<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;

class ImportTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tweets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import tweets';

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
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=metoo",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer AAAAAAAAAAAAAAAAAAAAAMCr3QAAAAAA33F5PC4e4N6QXmDJwHb3b9gdYwY%3DgRzokRLDAq81fg2AVyVTrRlsl4WzVY9BnebPzFDWgK2nlkngpE",
                "cache-control: no-cache",
                "postman-token: aa56e2e5-6c5e-ce55-3c4e-21f9acb5ef9a"
            ),
        ));

        $response = json_decode(curl_exec($curl), true);

        curl_close($curl);

        foreach ($response['statuses'] as $item) {
            $tweets = Tweet::findOrNew($item['id']);
            $this->info("Importing tweets: " . $item['id']);
            $tweets->fill($item);
            $tweets->save();

        }

    }
}
