<?php


namespace App\Exceptions\Formatters;

use Exception;
use Illuminate\Http\JsonResponse;
use Optimus\Heimdal\Formatters\BaseFormatter;
use Symfony\Component\HttpKernel\Exception\HttpException;

class HttpExceptionFormatter extends BaseFormatter
{
    public function format(JsonResponse $response, Exception $e, array $reporterResponses)
    {
        $response->setStatusCode(500);
        $data = [
            'errors' => [
                'message' => 'Something went wrong',
                'code' => $e->getCode(),
            ]
        ];

        if ($e instanceof HttpException) {
            $response->setStatusCode($e->getStatusCode());
            $data['errors']['message'] = $e->getMessage();
        }

        if ($this->debug) {
            $data = array_merge($data, [
                'code'   => $e->getCode(),
                'message'   => $e->getMessage(),
                'exception' => (string) $e,
                'line'   => $e->getLine(),
                'file'   => $e->getFile()
            ]);
        }


        $response->setData($data);
    }
}