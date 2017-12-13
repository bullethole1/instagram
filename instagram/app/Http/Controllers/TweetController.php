<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TweetController extends Controller
{
    public function showTweets()
    {
        $tweets = Tweet::all();

        return View('tweets', ['tweets' => $tweets]);
    }

    public function callTweetCount()
    {
        $tweets = Tweet::all();
        $result = Tweet::count_words($tweets);
        return response()->json($result);
    }

    public function exclude()
    {
        $tweets = Tweet::all();
        $result = Tweet::excludeWords($tweets);
        return response()->json($result);
    }

    public function tweetForm()
    {
        $searchWord = "";
        $tweet = [];
        if (isset($_GET["search"]))
        {
            $searchWord = $_GET['search'];
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q='.$searchWord.'",
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

            $tweet = Tweet::find_tweet($response);
        }


        return View('tweetForm', ['tweets' => $tweet]);
    }

}