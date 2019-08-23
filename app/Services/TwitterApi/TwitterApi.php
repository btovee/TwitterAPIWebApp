<?php


namespace App\Services\TwitterApi;


/**
 * Class TwitterApi
 * @package App\Services\TwitterApi
 */
class TwitterApi
{
    /**
     * @var string HOST Twitter api endpoint v1.1
     */
    private const HOST = 'https://api.twitter.com/1.1/';

    /**
     * @var array $mOAuth values for the oauth handshake
     */
    private $mOAuth = [];

    /**
     * @var Request $mRequest object to make curl requests
     */
    private $mRequest;

    /**
     * TwitterApi constructor.
     */
    public function __construct()
    {
        $this->mRequest = new Request();
        $this->mOAuth = [
            'oauth_consumer_key' => env('CONSUMER_KEY'),
            'oauth_token' => env('OAUTH_TOKEN'),
            'oauth_nonce' => self::generateNonce(),
            'oauth_timestamp' => time(),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_version' => '1.0'
        ];
    }


    /**
     * Generates a fairly strong nonce
     *
     * @return string
     */
    private static function generateNonce(): string
    {
        return md5(microtime() . mt_rand());
    }

    /**
     * loops over oauth params and raw url encodes each one
     *
     * @return array
     */
    private function encodeOAuthParams(): array
    {
        // must be encoded before sorting
        return array_map("rawurlencode", $this->mOAuth);
    }

    /**
     * @param array $query
     * @param array $oauth
     * @return array
     */
    private function addQueryParams(array $query, array $oauth): array
    {
        if (!empty($query)) {
            $query = array_map("rawurlencode", $query);
            // combine the values
            return array_merge($oauth, $query);
        }
        return $oauth;
    }

    /**
     * @param array $arr
     * @return array
     */
    private function sortArray(array $arr): array
    {
        // secondary sort (value)
        asort($arr);
        // primary sort (key)
        ksort($arr);
        return $arr;
    }

    /**
     * @param string $url
     * @param array $arr
     * @return string
     */
    private function createSignature(string $url, array $arr): string
    {
        // http_build_query automatically encodes, but our parameters
        // are already encoded, and must be by this point, so we undo
        // the encoding step
        $querystring = urldecode(http_build_query($arr, '', '&'));


        // mash everything together for the text to hash
        $base_string = 'GET' . "&" . rawurlencode($url) . "&" . rawurlencode($querystring);

        // same with the key
        $key = rawurlencode(env('CONSUMER_SECRET')) . "&" . rawurlencode(env('OAUTH_TOKEN_SECRET'));

        // generate the hash
        return rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));
    }

    /**
     * @param string $url
     * @param array $query
     * @return string
     */
    private function encodeQueryParams(string $url, array $query): string
    {
        // this time we're using a normal GET query, and we're only encoding the query params
        // (without the oauth params)
        $url .= "?" . http_build_query($query);
        return str_replace("&amp;", "&", $url);
    }

    /**
     * @param string $str
     * @return string
     */
    private function addQuotes(string $str): string
    {
        return '"' . $str . '"';
    }

    /**
     * @param array $oauth
     * @param string $signature
     * @return string
     */
    private function buildFullAuthorizationLine(array $oauth, string $signature): string
    {
        $oauth['oauth_signature'] = $signature;
        ksort($oauth);
        $oauth = array_map(array($this, 'addQuotes'), $oauth);
        // this is the full value of the Authorization line
        return "OAuth " . urldecode(http_build_query($oauth, '', ', '));
    }

    /**
     * @param string $endpoint
     * @param array $query
     * @return mixed
     */
    public function get(string $endpoint, array $query = [])
    {

        $url = self::HOST . sprintf('%s.json', $endpoint); // api call path
        $oauth = $this->encodeOAuthParams();
        $arr = $this->addQueryParams($query, $oauth);
        $arr = $this->sortArray($arr);
        $signature = $this->createSignature($url, $arr);
        $url = $this->encodeQueryParams($url, $query);
        $auth = $this->buildFullAuthorizationLine($oauth, $signature);
        $options = $this->mRequest->buildCURLGetRequestOptions($url, $auth);
        $json = $this->mRequest->executeCurlRequest($options);

        return json_decode($json);
    }

    /**
     * @param $twitterTweetData
     * @return array
     */
    public function getRelevantTweetData($twitterTweetData): array
    {

        $relevantTweetData = [];

        foreach ($twitterTweetData as $tweet) {
            $relevantTweetData[] = [
                'text' => $tweet->text,
                'created_at' => $tweet->created_at
            ];
        }

        return $relevantTweetData;
    }
}
