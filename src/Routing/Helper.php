<?php

namespace Jason\Rest\Routing;

use Symfony\Component\HttpFoundation\Response;

trait Helper
{

    /**
     * 返回状态码
     * @var int
     */
    protected int   $statusCode = Response::HTTP_OK;

    protected array $headers;

    public function success($data)
    {
        $this->setStatusCode(Response::HTTP_OK);

        return $this->respond($data);
    }

    public function failed()
    {
        $this->setStatusCode(Response::HTTP_BAD_REQUEST);

        return $this->respond();
    }

    protected function setStatusCode(int $statusCode): Helper
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function setHeaders(array $headers): Helper
    {
        $this->headers = $headers;

        return $this;
    }

    protected function respond($data = null)
    {
        return Response::json($data, $this->statusCode, $this->headers);
    }

}