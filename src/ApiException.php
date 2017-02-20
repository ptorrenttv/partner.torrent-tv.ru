<?php

namespace TorrentTv\PartnerApi;

use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception when api error occurs.
 */
class ApiException extends BadResponseException {

    /** @var string */
    private $errorCode;

    public function __construct(
        $errorCode, RequestInterface $request, ResponseInterface $response = null, \Exception $previous = null,
        array $handlerContext = []
    ) {
        parent::__construct("Api request returns error: $errorCode", $request, $response, $previous, $handlerContext);

        $this->errorCode = $errorCode;
    }

    /**
     * Возвращает код ошибки api.
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }
}
