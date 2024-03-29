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
 * This represents an equals assertion implementation acting on two sides of a condition (==)
 */
class EqualsCondition implements BinaryCondition
{
    /**
     * Assert that this condition applies to the variable $var (i.e. $var === $expr)
     *
     * @param Node $var
     * @param Node|int|string|float $expr
     * @override
     */
    public function analyzeVar(ConditionVisitorInterface $visitor, Node $var, $expr) : Context
    {
        return $visitor->updateVariableToBeEqual($var, $expr);
    }
    /**
     * Assert that this condition applies to the variable $object (i.e. get_class($object) === $expr)
     *
     * @param Node|int|string|float $object
     * @param Node|int|string|float $expr
     */
    public function analyzeClassCheck(ConditionVisitorInterface $visitor, $object, $expr) : Context
    {
        return $visitor->analyzeClassAssertion($object, $expr) ?? $visitor->getContext();
    }
    public function analyzeCall(ConditionVisitorInterface $visitor, Node $call_node, $expr) : ?Context
    {
        $code_base = $visitor->getCodeBase();
        $context = $visitor->getContext();
        $expr_type = UnionTypeVisitor::unionTypeFromNode($code_base, $context, $expr);
        if ($expr_type->isEmpty()) {
            return null;
        }
        // Skip check for `if is_bool`, allow weaker comparisons such as `is_string($x) == 1`
        if (!$expr_type->isExclusivelyBoolTypes() && !UnionTypeVisitor::unionTypeFromNode($code_base, $context, $call_node)->isExclusivelyBoolTypes()) {
            return null;
        }
        if (!$expr_type->containsFalsey()) {
            // e.g. `if (is_string($x) === true)`
            return (new ConditionVisitor($code_base, $context))->visitCall($call_node);
        } elseif (!$expr_type->containsTruthy()) {
            // e.g. `if (is_string($x) === false)`
            return (new NegatedConditionVisitor($code_base, $context))->visitCall($call_node);
        }
        return null;
    }
    public function analyzeComplexCondition(ConditionVisitorInterface $visitor, Node $complex_node, $expr) : ?Context
    {
        $code_base = $visitor->getCodeBase();
        $context = $visitor->getContext();
        $expr_type = UnionTypeVisitor::unionTypeFromNode($code_base, $context, $expr);
        if (!$expr_type->isExclusivelyBoolTypes() && !UnionTypeVisitor::unionTypeFromNode($code_base, $context, $complex_node)->isExclusivelyBoolTypes()) {
            return null;
        }
        if (!$expr_type->containsFalsey()) {
            // e.g. `if (($x instanceof Xyz) == true)`
            return (new ConditionVisitor($code_base, $context))->__invoke($complex_node);
        } elseif (!$expr_type->containsTruthy()) {
            // e.g. `if (($x instanceof Xyz) == false)`
            return (new NegatedConditionVisitor($code_base, $context))->__invoke($complex_node);
        }
        return null;
    }
}
