<?php

namespace App\Http\Controllers;

use App\Providers\TwitterApi\TwitterApiServiceProvider;
use App\Services\TwitterApi\TwitterApi;
use Illuminate\Http\Request;

class TwitterApiController extends Controller
{

    public function getUserTimeline($screenName, TwitterApi $twitterApi) {
        $twitterTweets = $twitterApi->get('statuses/user_timeline',  [
            'screen_name' => $screenName,
            'count' => '5'
        ]);
        return $twitterApi->getRelevantTweetData($twitterTweets);
    }

}
