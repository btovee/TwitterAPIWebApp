<?php

namespace App\Http\Controllers;

use App\Providers\TwitterApi\TwitterApiServiceProvider;
use App\Services\TwitterApi\TwitterApi;
use Illuminate\Http\Request;

/**
 * Class TwitterApiController
 * @package App\Http\Controllers
 */
class TwitterApiController extends Controller
{

    /**
     * @param $screenName
     * @param TwitterApi $twitterApi
     * @return array
     */
    public function getUserTimeline($screenName, TwitterApi $twitterApi) {
        $twitterTweets = $twitterApi->get('statuses/user_timeline',  [
            'screen_name' => $screenName,
            'count' => '5'
        ]);
        return $twitterApi->getRelevantTweetData($twitterTweets);
    }

}
