<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Parameter;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Tools\InflectorTrait;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Parser;
abstract class ParameterGenerator
{
    use InflectorTrait;
    /**
     * @var Parser
     */
    protected $parser;
    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }
    /**
     * @param $parameter
     */
    public function generateMethodParameter($parameter, Context $context, string $reference) : ?Node\Param
    {
        return null;
    }
    /**
     * @param $parameter
     */
    public function generateMethodDocParameter($parameter, Context $context, string $reference) : string
    {
        return '';
    }
    /**
     * @param $parameter
     *
     * @return Node\Expr[]
     */
    protected function generateInputParamArguments($parameter) : array
    {
        return [];
    }
}
