<?php

namespace SdgScoped\Jane\OpenApi3\Generator;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApi3\Generator\RequestBodyContent\AbstractBodyContentGenerator;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\Reference;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\RequestBody;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Param;
use SdgScoped\PhpParser\Node\Stmt;
class RequestBodyGenerator
{
    /** @var RequestBodyContentGeneratorInterface[] */
    private $generators = [];
    /** @var RequestBodyContentGeneratorInterface */
    private $defaultRequestBodyGenerator;
    public function __construct(RequestBodyContentGeneratorInterface $defaultRequestBodyGenerator)
    {
        $this->defaultRequestBodyGenerator = $defaultRequestBodyGenerator;
    }
    public function addRequestBodyGenerator(array $contentTypes, RequestBodyContentGeneratorInterface $requestBodyGenerator)
    {
        foreach ($contentTypes as $contentType) {
            $this->generators[$contentType] = $requestBodyGenerator;
        }
    }
    /**
     * @param $requestBody RequestBody|Reference
     */
    public function generateMethodParameter($requestBody, string $reference, Context $context) : ?Param
    {
        if (!$requestBody->getContent()) {
            return null;
        }
        $name = 'requestBody';
        [$types, $onlyArray] = $this->getTypes($requestBody, $reference, $context);
        $paramType = null;
        if (\count($types) === 1 && $types[0] !== AbstractBodyContentGenerator::PHP_TYPE_MIXED) {
            $paramType = $types[0];
        }
        if ($onlyArray) {
            $paramType = 'array';
        }
        return new Param(new Expr\Variable($name), null, $paramType === null ? $paramType : new Name($paramType));
    }
    /**
     * @param RequestBody|Reference $requestBody
     */
    public function generateMethodDocParameter($requestBody, string $reference, Context $context)
    {
        [$types, $_] = $this->getTypes($requestBody, $reference, $context);
        return \sprintf(' * @param %s $%s %s', \implode('|', $types), 'requestBody', '');
    }
    private function getTypes(?RequestBody $requestBody, string $reference, Context $context) : array
    {
        $types = [];
        if (!$requestBody || !$requestBody->getContent()) {
            return $types;
        }
        $onlyArray = null;
        foreach ($requestBody->getContent() as $contentType => $content) {
            $generator = $this->defaultRequestBodyGenerator;
            if (isset($this->generators[$contentType])) {
                $generator = $this->generators[$contentType];
            }
            [$newTypes, $isArray] = $generator->getTypes($content, $reference . '/content/' . $contentType, $context);
            if ($onlyArray === null) {
                $onlyArray = $isArray;
            } else {
                $onlyArray = $onlyArray && $isArray;
            }
            $types = \array_merge($types, $newTypes);
        }
        return [\array_unique($types), $onlyArray];
    }
    public function getSerializeStatements(?RequestBody $requestBody, string $reference, Context $context) : array
    {
        if (!$requestBody || !$requestBody->getContent()) {
            return [new Stmt\Return_(new Expr\Array_([new Expr\Array_(), new Expr\ConstFetch(new Name('null'))]))];
        }
        $statements = [];
        foreach ($requestBody->getContent() as $contentType => $content) {
            $generator = $this->defaultRequestBodyGenerator;
            if (isset($this->generators[$contentType])) {
                $generator = $this->generators[$contentType];
            }
            $statements[] = new Stmt\If_($generator->getTypeCondition($content, $reference . '/content/' . $contentType, $context), ['stmts' => $generator->getSerializeStatements($content, $contentType, $reference . '/content/' . $contentType, $context)]);
        }
        $statements[] = new Stmt\Return_(new Expr\Array_([new Expr\Array_(), new Expr\ConstFetch(new Name('null'))]));
        return $statements;
    }
}
