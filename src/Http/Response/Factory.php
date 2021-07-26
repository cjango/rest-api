<?php

namespace Jason\Rest\Http\Response;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class Factory
{

    /**
     * 返回状态码
     * @var int
     */
    protected int $statusCode = Response::HTTP_OK;

    /**
     * 自定义的头信息
     * @var array
     */
    protected array $headers = [];

    /**
     * Notes   : 单条数据返回
     * @Date   : 2021/7/23 4:23 下午
     * @Author : < Jason.C >
     * @param $item
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function item($item): Response
    {
        return $this->respond($item);
    }

    /**
     * Notes   : 返回集合
     * @Date   : 2021/7/23 4:23 下午
     * @Author : < Jason.C >
     * @param $collection
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function collection($collection): Response
    {
        return $this->respond($collection);
    }

    /**
     * Notes   : 返回带分页的数据
     * @Date   : 2021/7/26 4:17 下午
     * @Author : < Jason.C >
     * @param  \Illuminate\Contracts\Pagination\Paginator  $paginator
     * @return \Illuminate\Http\JsonResponse
     */
    public function paginator(Paginator $paginator): JsonResponse
    {
        return $this->respond($paginator);
    }

    /**
     * Notes   : 创建成功的返回 201
     * @Date   : 2021/7/23 4:21 下午
     * @Author : < Jason.C >
     * @param  string|null  $message
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function created(?string $message = null): Response
    {
        $this->setStatusCode(Response::HTTP_CREATED);

        return $this->respond($message);
    }

    /**
     * Notes   :
     * @Date   : 2021/7/26 4:32 下午
     * @Author : < Jason.C >
     * @param  null  $content
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accepted($content = null): Response
    {
        $this->setStatusCode(Response::HTTP_ACCEPTED);

        return $this->respond($content);
    }

    /**
     * Notes   : 无内容返回 204
     * @Date   : 2021/7/23 4:22 下午
     * @Author : < Jason.C >
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function noContent(): Response
    {
        $this->setStatusCode(Response::HTTP_NO_CONTENT);

        return $this->respond();
    }

    /**
     * Notes   : 设置返回的状态码
     * @Date   : 2021/7/26 10:58 上午
     * @Author : < Jason.C >
     * @param  int  $statusCode
     * @return $this
     */
    protected function setStatusCode(int $statusCode): static
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Notes   : 设置头信息
     * @Date   : 2021/7/26 11:00 上午
     * @Author : < Jason.C >
     * @param  array  $headers
     * @return $this
     */
    protected function setHeaders(array $headers): static
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Notes   : 最终的返回
     * @Date   : 2021/7/26 11:01 上午
     * @Author : < Jason.C >
     * @param  null  $content
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respond($content = null): JsonResponse
    {
        $response = new JsonResponse($content);

        $response->setStatusCode($this->statusCode);
        $response->header('X-Powered-By', 'Jason.Chen');
        $response->withHeaders($this->headers);

        return $response;
    }

}