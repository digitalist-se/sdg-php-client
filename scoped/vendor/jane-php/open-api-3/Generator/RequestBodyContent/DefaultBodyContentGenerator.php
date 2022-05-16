<?php

namespace SdgScoped\Jane\OpenApi3\Generator\RequestBodyContent;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\OpenApi3\JsonSchema\Model\MediaType;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
class DefaultBodyContentGenerator extends AbstractBodyContentGenerator
{
    /**
     * {@inheritdoc}
     */
    public function getSerializeStatements(MediaType $content, string $contentType, string $reference, Context $context) : array
    {
        return [new Stmt\Return_(new Expr\Array_([new Expr\Array_([new Expr\ArrayItem(new Expr\Array_([new Expr\ArrayItem(new Scalar\String_($contentType))]), new Scalar\String_('Content-Type'))]), new Expr\PropertyFetch(new Expr\Variable('this'), 'body')]))];
    }
}
