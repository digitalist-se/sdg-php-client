<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Analysis\ConditionVisitor;

use ast\Node;
use SdgScoped\Phan\Analysis\ConditionVisitor;
use SdgScoped\Phan\Analysis\ConditionVisitorInterface;
use SdgScoped\Phan\Analysis\NegatedConditionVisitor;
use SdgScoped\Phan\AST\UnionTypeVisitor;
use SdgScoped\Phan\Language\Context;
/**
 * This represents a not identical assertion implementation acting on two sides of a condition (!==)
 */
class NotIdenticalCondition implements BinaryCondition
{
    /**
     * Assert that this condition applies to the variable $var (i.e. $var !== $expr)
     *
     * @param Node $var
     * @param Node|int|string|float $expr
     * @override
     */
    public function analyzeVar(ConditionVisitorInterface $visitor, Node $var, $expr) : Context
    {
        return $visitor->updateVariableToBeNotIdentical($var, $expr);
    }
    /**
     * Assert that this condition applies to the variable $object (i.e. get_class($object) !== $expr)
     *
     * @param Node|int|string|float $object
     * @param Node|int|string|float $expr
     * @suppress PhanUnusedPublicMethodParameter
     */
    public function analyzeClassCheck(ConditionVisitorInterface $visitor, $object, $expr) : Context
    {
        return $visitor->getContext();
    }
    public function analyzeCall(ConditionVisitorInterface $visitor, Node $call_node, $expr) : ?Context
    {
        if (!$expr instanceof Node) {
            return null;
        }
        $code_base = $visitor->getCodeBase();
        $context = $visitor->getContext();
        $value = UnionTypeVisitor::unionTypeFromNode($code_base, $context, $expr)->asSingleScalarValueOrNullOrSelf();
        if (!\is_bool($value)) {
            return null;
        }
        if ($value) {
            // e.g. `if (!(is_string($x) === true))`
            return (new NegatedConditionVisitor($code_base, $context))->visitCall($call_node);
        } else {
            // e.g. `if (!(is_string($x) === false))`
            return (new ConditionVisitor($code_base, $context))->visitCall($call_node);
        }
    }
    public function analyzeComplexCondition(ConditionVisitorInterface $visitor, Node $complex_node, $expr) : ?Context
    {
        if (!$expr instanceof Node) {
            return null;
        }
        $code_base = $visitor->getCodeBase();
        $context = $visitor->getContext();
        $value = UnionTypeVisitor::unionTypeFromNode($code_base, $context, $expr)->asSingleScalarValueOrNullOrSelf();
        if (!\is_bool($value)) {
            return null;
        }
        if ($value) {
            // e.g. `if (($x instanceof Xyz) !== true)`
            return (new NegatedConditionVisitor($code_base, $context))->__invoke($complex_node);
        } else {
            // e.g. `if (($x instanceof Xyz) !== false)`
            return (new ConditionVisitor($code_base, $context))->__invoke($complex_node);
        }
    }
}
