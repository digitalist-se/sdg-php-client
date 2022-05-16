<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Scope;

use InvalidArgumentException;
use SdgScoped\Phan\Language\Scope;
use SdgScoped\Phan\Language\Type\TemplateType;
/**
 * A scope that adds (at)template annotations to the current outer scope.
 * Used for parsing phpdoc comments.
 */
class TemplateScope extends Scope
{
    /**
     * @param TemplateType[] $template_type_list
     */
    public function __construct(Scope $other, array $template_type_list)
    {
        parent::__construct($other, $other->fqsen, $other->flags);
        if (\count($template_type_list) === 0) {
            throw new InvalidArgumentException("TemplateScope should only be used to add templates");
        }
        foreach ($template_type_list as $template_type) {
            $this->addTemplateType($template_type);
        }
    }
}
