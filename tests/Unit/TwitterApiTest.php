<?php

namespace Tests\Unit;

use App\Services\TwitterApi\TwitterApi;
use Tests\TestCase;

/**
 * Class TwitterApiTest
 * @package Tests\Unit
 */
class TwitterApiTest extends TestCase
{

    /**
     * @var TwitterApi $mTwitterApi TwitterApi service instance.
     */
    private $mTwitterApi;

    /**
     * Create a fresh instance before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mTwitterApi = new TwitterApi();
    }

    /**
     * Test getRelevantTweetData function with correct data
     *
     * @return void
     */
    public function testGetRelevantTweetData()
    {
        $jsonString = file_get_contents(base_path('tests/Resources/TwitterAPI.json'));
        $twitterTweetData = json_decode($jsonString);
        $expectedRelevantTweetData = [
            [
                "text" => "RT @andieesal: we persisting 😂😂 @ewarren https://t.co/gZtDU33sGj",
                "created_at" => "Fri Aug 23 05:26:44 +0000 2019"
            ],
            [
                "text" =>
                    "@kevinpokeeffe VERY me today",
                "created_at" => "Fri Aug 23 00:40:53 +0000 2019"
            ],
            [
                "text" =>
                    "@robinshoots omg",
                "created_at" => "Fri Aug 23 00:19:04 +0000 2019"
            ],

            [
                "text" =>
                    "@LGTourNews tea",
                "created_at" => "Fri Aug 23 00:09:13 +0000 2019"
            ],
            [
                "text" => "@stephenossola we do NOT stan",
                "created_at" => "Thu Aug 22 23:23:48 +0000 2019"
            ],
        ];
        $actualRelevantTweetData = $this->mTwitterApi->getRelevantTweetData($twitterTweetData);
        $this->assertEquals($expectedRelevantTweetData, $actualRelevantTweetData);
    }

    /**
     * Test getRelevantTweetData function with bad data
     *
     * @return void
     */
    public function testGetRelevantTweetDataWithBadData()
    {
        $jsonString = file_get_contents(base_path('tests/Resources/TwitterAPIBadData.json'));
        $twitterTweetData = json_decode($jsonString);
        $expectedRelevantTweetData = [
            [
                "text" => "@kevinpokeeffe VERY me today",
                "created_at" => "Fri Aug 23 00:40:53 +0000 2019"
            ],
            [
                "text" => "@LGTourNews tea",
                "created_at" => "Fri Aug 23 00:09:13 +0000 2019"
            ]
        ];
        $actualRelevantTweetData = $this->mTwitterApi->getRelevantTweetData($twitterTweetData);
        $this->assertEquals($expectedRelevantTweetData, $actualRelevantTweetData);
    }
}
