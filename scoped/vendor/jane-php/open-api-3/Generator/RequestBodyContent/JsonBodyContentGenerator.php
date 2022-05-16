<?php

namespace SdgScoped\Jane\OpenApi3\Generator\RequestBodyContent;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\MediaType;
use SdgScoped\PhpParser\Node\Arg;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
class JsonBodyContentGenerator extends AbstractBodyContentGenerator
{
    /**
     * {@inheritdoc}
     */
    public function getSerializeStatements(MediaType $content, string $contentType, string $reference, Context $context) : array
    {
        $schema = $content->getSchema();
        $classGuess = $this->guessClass->guessClass($schema, $reference . '/schema', $context->getRegistry(), $array);
        if (null === $classGuess) {
            return [new Stmt\Return_(new Expr\Array_([new Expr\Array_([new Expr\ArrayItem(new Expr\Array_([new Expr\ArrayItem(new Scalar\String_($contentType))]), new Scalar\String_('Content-Type'))]), new Expr\FuncCall(new Name('json_encode'), [new Arg(new Expr\PropertyFetch(new Expr\Variable('this'), 'body'))])]))];
        }
        return [new Stmt\Return_(new Expr\Array_([new Expr\Array_([new Expr\ArrayItem(new Expr\Array_([new Expr\ArrayItem(new Scalar\String_($contentType))]), new Scalar\String_('Content-Type'))]), new Expr\MethodCall(new Expr\Variable('serializer'), new Name('serialize'), [new Arg(new Expr\PropertyFetch(new Expr\Variable('this'), 'body')), new Arg(new Scalar\String_('json'))])]))];
    }
}
