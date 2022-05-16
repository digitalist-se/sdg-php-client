<?php

namespace SdgScoped\Http\Client\Exception;

use SdgScoped\Psr\Http\Message\RequestInterface;
trait RequestAwareTrait
{
    /**
     * @var RequestInterface
     */
    private $request;
    private function setRequest(RequestInterface $request)
    {
        $this->request = $request;
    }
    /**
     * {@inheritdoc}
     */
    public function getRequest() : RequestInterface
    {
        return $this->request;
    }
}
