<?php

namespace SdgScoped\Jane\JsonSchema\Generator\Model;

use SdgScoped\Jane\JsonSchema\Generator\Naming;
use SdgScoped\PhpParser\Comment\Doc;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
trait ClassGenerator
{
    /**
     * The naming service.
     */
    protected abstract function getNaming() : Naming;
    /**
     * Return a model class.
     *
     * @param Node[] $properties
     * @param Node[] $methods
     */
    protected function createModel(string $name, array $properties, array $methods, bool $hasExtensions = \false, bool $deprecated = \false) : Stmt\Class_
    {
        $attributes = [];
        if ($deprecated) {
            $attributes['comments'] = [new Doc(<<<EOD
/**
 *
 * @deprecated
 */
EOD
)];
        }
        return new Stmt\Class_($this->getNaming()->getClassName($name), ['stmts' => \array_merge($properties, $methods), 'extends' => $hasExtensions ? new Name('\\ArrayObject') : null], $attributes);
    }
}
