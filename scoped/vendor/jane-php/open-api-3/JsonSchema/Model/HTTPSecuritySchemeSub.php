<?php

declare (strict_types=1);
/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */
namespace SdgScoped\Jane\OpenApi3\JsonSchema\Model;

class HTTPSecuritySchemeSub
{
    /**
     * @var mixed|null
     */
    protected $scheme;
    /**
     * @return mixed
     */
    public function getScheme()
    {
        return $this->scheme;
    }
    /**
     * @param mixed $scheme
     *
     * @return self
     */
    public function setScheme($scheme) : self
    {
        $this->scheme = $scheme;
        return $this;
    }
}
