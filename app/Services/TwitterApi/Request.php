<?php


namespace App\Services\TwitterApi;


/**
 * Class Request
 * @package App\Services\TwitterApi
 */
class Request
{
    /**
     *  Setting up options for the CURL GET request.
     *
     * @param string $url
     * @param string $auth
     * @return array
     */
    public function buildCURLGetRequestOptions(string $url, string $auth): array
    {
        return [
            CURLOPT_HTTPHEADER => array("Authorization: $auth"),
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ];
    }

    /**
     * Setting up options for the CURL POST request.
     *
     * @param string $url
     * @param string $auth
     * @param string $postFields
     * @return array
     */
    public function makeCURLPostRequestOptions(string $url, string $auth, string $postFields): array
    {
        return [
            CURLOPT_HTTPHEADER => array("Authorization: $auth"),
            CURLOPT_POSTFIELDS => $postFields,
            CURLOPT_HEADER => false,
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false
        ];
    }

    /**
     * Execution of the the CURL request
     *
     * @param array $options
     * @return string
     */
    public function executeCurlRequest(array $options): string
    {
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        return $json;
    }
}
