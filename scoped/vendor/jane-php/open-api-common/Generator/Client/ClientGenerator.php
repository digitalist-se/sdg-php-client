<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Client;

use SdgScoped\Http\Discovery\Psr17FactoryDiscovery;
use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Registry\Schema as BaseSchema;
use SdgScoped\Jane\OpenApiRuntime\Client\Client;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonDecode;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncode;
use SdgScoped\Symfony\Component\Serializer\Encoder\JsonEncoder;
use SdgScoped\Symfony\Component\Serializer\Serializer;
trait ClientGenerator
{
    protected abstract function getHttpClientCreateExpr(Context $context) : array;
    protected function getSuffix() : string
    {
        return '';
    }
    protected function createResourceClass(string $name) : Stmt\Class_
    {
        return new Stmt\Class_($name, ['extends' => new Node\Name\FullyQualified(Client::class)]);
    }
    protected function getFactoryMethod(BaseSchema $schema, Context $context) : Stmt
    {
        $params = [new Node\Param(new Expr\Variable('httpClient'), new Expr\ConstFetch(new Name('null'))), new Node\Param(new Expr\Variable('additionalPlugins'), new Expr\Array_(), 'array')];
        return new Stmt\ClassMethod('create', ['flags' => Stmt\Class_::MODIFIER_STATIC | Stmt\Class_::MODIFIER_PUBLIC, 'params' => $params, 'stmts' => [new Stmt\If_(new Expr\BinaryOp\Identical(new Expr\ConstFetch(new Name('null')), new Expr\Variable('httpClient')), ['stmts' => $this->getHttpClientCreateExpr($context)]), new Stmt\Expression(new Expr\Assign(new Expr\Variable('requestFactory'), new Expr\StaticCall(new Name\FullyQualified(Psr17FactoryDiscovery::class), 'findRequestFactory'))), new Stmt\Expression(new Expr\Assign(new Expr\Variable('streamFactory'), new Expr\StaticCall(new Name\FullyQualified(Psr17FactoryDiscovery::class), 'findStreamFactory'))), new Stmt\Expression(new Expr\Assign(new Expr\Variable('serializer'), new Expr\New_(new Name\FullyQualified(Serializer::class), [new Node\Arg(new Expr\Array_([new Expr\ArrayItem(new Expr\New_(new Name('SdgScoped\\Symfony\\Component\\Serializer\\Normalizer\\ArrayDenormalizer'))), new Expr\ArrayItem(new Expr\New_(new Name('\\' . $context->getCurrentSchema()->getNamespace() . '\\Normalizer\\JaneObjectNormalizer')))])), new Node\Arg(new Expr\Array_([new Expr\ArrayItem(new Expr\New_(new Name\FullyQualified(JsonEncoder::class), [new Node\Arg(new Expr\New_(new Name\FullyQualified(JsonEncode::class))), new Node\Arg(new Expr\New_(new Name\FullyQualified(JsonDecode::class), [new Node\Arg(new Expr\Array_([new Expr\ArrayItem(new Expr\ConstFetch(new Name('true')), new Scalar\String_('json_decode_associative'))]))]))]))]))]))), new Stmt\Return_(new Expr\New_(new Name('static'), [new Node\Arg(new Expr\Variable('httpClient')), new Node\Arg(new Expr\Variable('requestFactory')), new Node\Arg(new Expr\Variable('serializer')), new Node\Arg(new Expr\Variable('streamFactory'))]))]]);
    }
}
