<?php


namespace App\Services\TwitterApi;


class Request
{
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

    public function executeCurlRequest(array $options): string
    {
        $feed = curl_init();
        curl_setopt_array($feed, $options);
        $json = curl_exec($feed);
        curl_close($feed);

        return $json;
    }
}
