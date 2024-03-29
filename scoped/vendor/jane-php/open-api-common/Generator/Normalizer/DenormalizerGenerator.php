<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Normalizer;

use SdgScoped\Jane\JsonSchema\Generator\Context\Context;
use SdgScoped\Jane\JsonSchema\Generator\Normalizer\DenormalizerGenerator as JsonSchemaDenormalizerGenerator;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ClassGuess;
use SdgScoped\Jane\OpenApiCommon\Guesser\Guess\MultipleClass;
use SdgScoped\PhpParser\Node\Arg;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Scalar;
use SdgScoped\PhpParser\Node\Stmt;
trait DenormalizerGenerator
{
    use JsonSchemaDenormalizerGenerator {
        denormalizeMethodStatements as jsonSchemaDenormalizeMethodStatements;
    }
    protected function denormalizeMethodStatements(ClassGuess $classGuess, Context $context) : array
    {
        $statements = $this->jsonSchemaDenormalizeMethodStatements($classGuess, $context);
        if ($classGuess instanceof MultipleClass) {
            foreach ($classGuess->getReferences() as $name => $reference) {
                $statements[] = new Stmt\If_(new Expr\BinaryOp\LogicalAnd(new Expr\FuncCall(new Name('array_key_exists'), [new Arg(new Scalar\String_($classGuess->getDiscriminator())), new Arg(new Expr\Variable('data'))]), new Expr\BinaryOp\Identical(new Scalar\String_($name), new Expr\ArrayDimFetch(new Expr\Variable('data'), new Scalar\String_($classGuess->getDiscriminator())))), ['stmts' => [new Stmt\Return_(new Expr\MethodCall(new Expr\PropertyFetch(new Expr\Variable('this'), 'denormalizer'), 'denormalize', [new Expr\Variable('data'), new Scalar\String_(\sprintf('%s\\Model\\%s', $context->getCurrentSchema()->getNamespace(), $this->getNaming()->getClassName($name))), new Expr\Variable('format'), new Expr\Variable('context')]))]]);
            }
        }
        return $statements;
    }
}
