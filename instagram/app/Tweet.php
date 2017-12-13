<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'created_at',
        'id_str',
        'text'
    ];

    static public function count_words($tweets)
    {
        $wordList = [];
        foreach ($tweets as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet));
        }
        $words = array_unique($wordList);
        foreach ($words as $word => $amount) {
            foreach ($wordList as $line) {
                if (strpos($line, $word) !== false) {
                    $words[$word] = $words[$word] + 1;
                }
            }
        }
        return (array_count_values($wordList));
    }

    static public function excludeWords($tweets)
    {
        $filter = array("that", "have", "Trump-RT", "Trump");

        $wordList = [];
        foreach ($tweets as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet));
        }

        foreach ($wordList as $key => $value) {
            if (in_array($value, $filter)) {
                unset($wordList[$key]);
            }
        }

        return (array_count_values($wordList));

    }

    static function find_tweet($response)
    {
        $wordList = [];
        foreach ($response['statuses'] as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet['text']));
        }
        $words = array_unique($wordList);
        foreach ($words as $word => $amount) {
            foreach ($wordList as $line) {
                if (strpos($line, $word) !== false) {
                    $words[$word] = $words[$word] + 1;
                }
            }
        }

        $sorted = array_count_values($wordList);
        asort($sorted);
        return array_slice( array_reverse($sorted),0,10);
    }
}



