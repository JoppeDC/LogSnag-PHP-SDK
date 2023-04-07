<?php

declare(strict_types=1);

namespace JoppeDc\LogsnagPhpSdk\Http;

use Http\Discovery\Psr17Factory;
use Http\Discovery\Psr18ClientDiscovery;
use JoppeDc\LogsnagPhpSdk\Contracts\Http;
use JoppeDc\LogsnagPhpSdk\Exceptions\ApiException;
use JoppeDc\LogsnagPhpSdk\Exceptions\CommunicationException;
use JoppeDc\LogsnagPhpSdk\Exceptions\InvalidResponseBodyException;
use JoppeDc\LogsnagPhpSdk\Exceptions\JsonDecodingException;
use JoppeDc\LogsnagPhpSdk\Exceptions\JsonEncodingException;
use JoppeDc\LogsnagPhpSdk\Http\Serialize\Json;
use JoppeDc\LogsnagPhpSdk\Logsnag;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Client\NetworkExceptionInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

class Client implements Http
{
    private ClientInterface $http;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;
    private array $headers;
    private ?string $apiKey;
    private string $baseUrl;
    private Json $json;

    public function __construct(
        string $url,
        string $apiKey = null,
        ClientInterface $httpClient = null,
        RequestFactoryInterface $reqFactory = null,
        array $clientAgents = [],
        StreamFactoryInterface $streamFactory = null
    ) {
        $this->baseUrl = $url;
        $this->apiKey = $apiKey;
        $this->http = $httpClient ?? Psr18ClientDiscovery::find();
        $this->requestFactory = $reqFactory ?? new Psr17Factory();
        $this->streamFactory = $streamFactory ?? ($this->requestFactory instanceof StreamFactoryInterface ? $this->requestFactory : new Psr17Factory());

        $this->headers = array_filter([
            'User-Agent' => implode(';', array_merge($clientAgents, [Logsnag::qualifiedVersion()])),
            'Content-Type' => 'application/json',
        ]);

        if (null !== $this->apiKey) {
            $this->headers['Authorization'] = sprintf('Bearer %s', $this->apiKey);
        }

        $this->json = new Json();
    }

    /**
     * @param mixed|null $body
     *
     * @return mixed
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     * @throws CommunicationException
     * @throws JsonEncodingException
     */
    public function post(string $path, $body = null)
    {
        $body = $this->json->serialize($body);

        $request = $this->requestFactory->createRequest(
            'POST',
            $this->baseUrl.$path
        )->withBody($this->streamFactory->createStream($body));

        return $this->execute($request);
    }

    /**
     * @param mixed|null $body
     *
     * @return mixed
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     * @throws CommunicationException
     * @throws JsonEncodingException
     */
    public function patch(string $path, $body = null)
    {
        $request = $this->requestFactory->createRequest(
            'PATCH',
            $this->baseUrl.$path
        )->withBody($this->streamFactory->createStream($this->json->serialize($body)));

        return $this->execute($request);
    }

    /**
     * @return mixed
     *
     * @throws ApiException
     * @throws ClientExceptionInterface
     * @throws CommunicationException
     */
    private function execute(RequestInterface $request)
    {
        foreach ($this->headers as $header => $value) {
            $request = $request->withAddedHeader($header, $value);
        }

        try {
            return $this->parseResponse($this->http->sendRequest($request));
        } catch (NetworkExceptionInterface $e) {
            throw new CommunicationException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return mixed
     *
     * @throws ApiException
     * @throws InvalidResponseBodyException
     * @throws JsonDecodingException
     */
    private function parseResponse(ResponseInterface $response)
    {
        if (204 === $response->getStatusCode()) {
            return null;
        }

        if (!\in_array('application/json', $response->getHeader('content-type'), true)) {
            throw new InvalidResponseBodyException($response, $response->getBody()->getContents());
        }

        if ($response->getStatusCode() >= 300) {
            $body = $this->json->unserialize($response->getBody()->getContents()) ?? $response->getReasonPhrase();

            throw new ApiException($response, $body);
        }

        return $this->json->unserialize($response->getBody()->getContents());
    }
}
