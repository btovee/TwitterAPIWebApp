<?php

namespace Tests\Unit;

use App\Services\TwitterApi\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTest extends TestCase
{

    /**
     * @var Request $mRequest TwitterApi\Request service instance.
     */
    private $mRequest;

    /**
     * @var string URL Twitter api endpoint v1.1
     */
    private const URL = 'https://api.twitter.com/1.1/user_timeline.json';

    /**
     * @var string AUTH OAuth params for testing
     */
    private const AUTH = 'OAuth oauth_consumer_key="test", oauth_nonce="test", oauth_signature="test", oauth_signature_method="HMAC-SHA1", oauth_timestamp="test", oauth_token="test", oauth_version="1.0"';

    /**
     * Create a fresh instance before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->mRequest = new Request();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBuildCURLGetRequestOptions()
    {
        $expectedOptions = [
            10023 => [
                'Authorization: ' . self::AUTH
            ],
            42 => false,
            10002 => self::URL,
            19913 => true,
            64 => false
        ];
        $actualOptions = $this->mRequest->buildCURLGetRequestOptions(self::URL, self::AUTH);
        $this->assertEquals($expectedOptions, $actualOptions);
    }

    public function testBuildCURLPostRequestOptions()
    {
        $expectedOptions = [
            10023 => [
                'Authorization: ' . self::AUTH
            ],
            42 => false,
            10002 => self::URL,
            19913 => true,
            64 => false,
            10015 => 'field1="test", field2="test"'
        ];
        $postFields = 'field1="test", field2="test"';
        $actualOptions = $this->mRequest->buildCURLPostRequestOptions(self::URL, self::AUTH, $postFields);
        $this->assertEquals($expectedOptions, $actualOptions);
    }
}
