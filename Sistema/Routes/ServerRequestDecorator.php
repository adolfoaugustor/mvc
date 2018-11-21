<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 26/01/18
 * Time: 12:44
 */

namespace Sistema\Routes;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

abstract class ServerRequestDecorator implements ServerRequestInterface
{
    protected $request;

    public function __construct(ServerRequestInterface $request)
    {
        $this->request = $request;
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->request, $name], $arguments);
    }

    /**
     * @inheritDoc
     */
    public function getProtocolVersion()
    {
        return $this->request->getProtocolVersion();
    }

    /**
     * @inheritDoc
     */
    public function withProtocolVersion($version)
    {
        return $this->request->withProtocolVersion($version);
    }

    /**
     * @inheritDoc
     */
    public function getHeaders()
    {
        return $this->request->getHeaders();
    }

    /**
     * @inheritDoc
     */
    public function hasHeader($name)
    {
        return $this->request->hasHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeader($name)
    {
        return $this->request->getHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getHeaderLine($name)
    {
        return $this->request->getHeaderLine($name);
    }

    /**
     * @inheritDoc
     */
    public function withHeader($name, $value)
    {
        return $this->request->withHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withAddedHeader($name, $value)
    {
        return $this->request->withAddedHeader($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withoutHeader($name)
    {
        return $this->request->withoutHeader($name);
    }

    /**
     * @inheritDoc
     */
    public function getBody()
    {
        return $this->request->getBody();
    }

    /**
     * @inheritDoc
     */
    public function withBody(StreamInterface $body)
    {
        return $this->request->withBody($body);
    }

    /**
     * @inheritDoc
     */
    public function getRequestTarget()
    {
        return $this->request->getRequestTarget();
    }

    /**
     * @inheritDoc
     */
    public function withRequestTarget($requestTarget)
    {
        return $this->request->withRequestTarget($requestTarget);
    }

    /**
     * @inheritDoc
     */
    public function getMethod()
    {
        return $this->request->getMethod();
    }

    /**
     * @inheritDoc
     */
    public function withMethod($method)
    {
        return $this->request->withMethod($method);
    }

    /**
     * @inheritDoc
     */
    public function getUri()
    {
        return $this->request->getUri();
    }

    /**
     * @inheritDoc
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        return $this->request->withUri($uri, $preserveHost);
    }

    /**
     * @inheritDoc
     */
    public function getServerParams()
    {
        return $this->request->getServerParams();
    }

    /**
     * @inheritDoc
     */
    public function getCookieParams()
    {
        return $this->request->getCookieParams();
    }

    /**
     * @inheritDoc
     */
    public function withCookieParams(array $cookies)
    {
        return $this->request->withCookieParams($cookies);
    }

    /**
     * @inheritDoc
     */
    public function getQueryParams()
    {
        return $this->request->getQueryParams();
    }

    /**
     * @inheritDoc
     */
    public function withQueryParams(array $query)
    {
        return $this->request->withQueryParams($query);
    }

    /**
     * @inheritDoc
     */
    public function getUploadedFiles()
    {
        return $this->request->getUploadedFiles();
    }

    /**
     * @inheritDoc
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        return $this->request->withUploadedFiles($uploadedFiles);
    }

    /**
     * @inheritDoc
     */
    public function getParsedBody()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @inheritDoc
     */
    public function withParsedBody($data)
    {
        return $this->request->withParsedBody($data);
    }

    /**
     * @inheritDoc
     */
    public function getAttributes()
    {
        return $this->request->getAttributes();
    }

    /**
     * @inheritDoc
     */
    public function getAttribute($name, $default = null)
    {
        return $this->request->getAttribute($name, $default);
    }

    /**
     * @inheritDoc
     */
    public function withAttribute($name, $value)
    {
        return $this->request->withAttribute($name, $value);
    }

    /**
     * @inheritDoc
     */
    public function withoutAttribute($name)
    {
        return $this->request->withoutAttribute($name);
    }
}