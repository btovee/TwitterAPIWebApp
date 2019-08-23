<?php

namespace App\Http\Controllers;


use App\Services\TwitterApi\TwitterApi;


/**
 * Class TwitterApiController
 * @package App\Http\Controllers
 */
class TwitterApiController extends Controller
{

    /**
     * Get the top 5 tweets from a users timeline using the screen name.
     *
     * @param $screenName
     * @param TwitterApi $twitterApi
     * @return array
     */
    public function getUserTimeline($screenName, TwitterApi $twitterApi)
    {
        $twitterTweets = $twitterApi->get('statuses/user_timeline', [
            'screen_name' => $screenName,
            'count' => '5'
        ]);
        return $twitterApi->getRelevantTweetData($twitterTweets);
    }

}
