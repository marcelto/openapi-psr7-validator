<?php

declare(strict_types=1);

namespace OpenAPIValidation\PSR7\Exception\Response;

use OpenAPIValidation\PSR7\Exception\NoResponseCode;
use OpenAPIValidation\PSR7\ResponseAddress;
use Throwable;
use function sprintf;

class ResponseBodyMismatch extends NoResponseCode
{
    public static function fromAddrAndCauseException(ResponseAddress $addr, Throwable $cause) : self
    {
        $i = new self(
            sprintf(
                'OpenAPI spec does not match the body of the response [%s,%s,%d]: %s',
                $addr->path(),
                $addr->method(),
                $addr->responseCode(),
                $cause->getMessage()
            ),
            0,
            $cause
        );

        $i->path         = $addr->path();
        $i->method       = $addr->method();
        $i->responseCode = $addr->responseCode();

        return $i;
    }
}
