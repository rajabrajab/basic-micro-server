<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Log;

class HttpService
{
    protected string $baseUrl;
    protected array $headers = [];

    public function __construct(string $baseUrl, array $headers = [])
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = $headers;
    }

    public function get(string $endpoint, array $query = [])
    {
        return $this->request('GET', $endpoint, $query);
    }


    public function post(string $endpoint, array $data = [])
    {
        return $this->request('POST', $endpoint, $data);
    }


    public function put(string $endpoint, array $data = [])
    {
        return $this->request('PUT', $endpoint, $data);
    }


    public function delete(string $endpoint, array $data = [])
    {
        return $this->request('DELETE', $endpoint, $data);
    }


    private function request(string $method, string $endpoint, array $data = [])
    {
        try {
            $response = Http::withHeaders($this->headers)
                ->$method("{$this->baseUrl}/{$endpoint}", $data);

            if ($response->successful()) {
                return $response->json();
            }

            throw new RequestException($response);
        } catch (\Exception $e) {
            Log::error("HTTP request failed: {$e->getMessage()}");
            return [
                'error' => true,
                'message' => 'Service unavailable',
            ];
        }
    }

    public function setAuthToken(string $token)
    {
        $this->headers['Authorization'] = "Bearer $token";
    }
}
