<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Language\Element\Comment;

use SdgScoped\Phan\Language\Context;
use SdgScoped\Phan\Language\Element\Variable;
use SdgScoped\Phan\Language\UnionType;
/**
 * Stores information Phan knows about the PHPDoc parameter of a given function-like.
 * (e.g. of the doc comment of a method, function, closure, or magic method)
 */
class Parameter
{
    private const REFERENCE_DEFAULT = 0;
    private const REFERENCE_OUTPUT = 1;
    private const REFERENCE_IGNORED = 2;
    /**
     * @var string
     * The name of the comment parameter
     */
    private $name;
    /**
     * @var UnionType
     * The type of the parameter
     */
    private $type;
    /**
     * @var int
     * Get the line number.
     */
    private $lineno;
    /**
     * @var bool
     * Whether or not the parameter is variadic (in the comment)
     */
    private $is_variadic;
    /**
     * @var bool
     * Whether or not the parameter is optional (Note: only applies to the comment for (at)method.)
     */
    private $has_default_value;
    /**
     * @var bool
     * Whether or not the parameter is marked as mandatory in phpdoc
     */
    private $is_mandatory_in_phpdoc;
    /**
     * @var int one of the REFERENCE_* constants.
     */
    private $reference_type;
    /**
     * @var ?string the original string for the default value representation
     */
    private $default_value_representation;
    /**
     * @param string $name
     * The name of the parameter
     *
     * @param UnionType $type
     * The type of the parameter
     */
    public function __construct(string $name, UnionType $type, int $lineno = 0, bool $is_variadic = \false, bool $has_default_value = \false, bool $is_output_reference = \false, bool $is_ignored_reference = \false, bool $is_mandatory_in_phpdoc = \false, ?string $default_value_representation = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->lineno = $lineno;
        $this->is_variadic = $is_variadic;
        $this->has_default_value = $has_default_value;
        $this->is_mandatory_in_phpdoc = $is_mandatory_in_phpdoc;
        $this->default_value_representation = $default_value_representation;
        if ($is_ignored_reference) {
            $this->reference_type = self::REFERENCE_IGNORED;
        } elseif ($is_output_reference) {
            $this->reference_type = self::REFERENCE_OUTPUT;
        } else {
            $this->reference_type = self::REFERENCE_DEFAULT;
        }
    }
    /**
     * Returns this comment parameter as a real variable.
     */
    public function asVariable(Context $context) : Variable
    {
        return new Variable($context, $this->name, $this->type, 0);
    }
    /**
     * Converts this parameter to a real parameter,
     * using only the information from the comment.
     *
     * Useful for comments extracted from (at)method, etc.
     */
    public function asRealParameter(Context $context) : \SdgScoped\Phan\Language\Element\Parameter
    {
        $flags = 0;
        if ($this->is_variadic) {
            $flags |= \ast\flags\PARAM_VARIADIC;
        }
        $union_type = $this->type;
        $param = \SdgScoped\Phan\Language\Element\Parameter::create($context, $this->name, $union_type, $flags);
        if ($this->has_default_value) {
            $param->setDefaultValueType($union_type);
            // TODO: could setDefaultValue in a future PR. Would have to run \ast\parse_code on the default value, catch ParseError/CompileError if necessary.
            // If given '= "Default"', then extract the default from '<?php ("Default");'
            // Then get the type from UnionTypeVisitor, for defaults such as SomeClass::CONST.
        }
        $param->setDefaultValueRepresentation($this->default_value_representation);
        return $param;
    }
    /**
     * @return string
     * The name of the parameter
     */
    public function getName() : string
    {
        return $this->name;
    }
    /**
     * @return UnionType
     * The type of the parameter
     */
    public function getUnionType() : UnionType
    {
        return $this->type;
    }
    /**
     * Add types (from another comment) to this comment parameter.
     *
     * @param UnionType $other
     * The type to add to the parameter (for conflicting param tags)
     * @internal
     */
    public function addUnionType(UnionType $other) : void
    {
        $this->type = $this->type->withUnionType($other);
    }
    /**
     * @return int
     * The line number of the parameter
     */
    public function getLineno() : int
    {
        return $this->lineno;
    }
    /**
     * @return bool
     * Whether or not the parameter is variadic
     */
    public function isVariadic() : bool
    {
        return $this->is_variadic;
    }
    /**
     * @return bool
     * Whether or not the parameter is an output reference
     */
    public function isOutputReference() : bool
    {
        return $this->reference_type === self::REFERENCE_OUTPUT;
    }
    /**
     * @return bool
     * Whether or not the parameter is an ignored reference
     */
    public function isIgnoredReference() : bool
    {
        return $this->reference_type === self::REFERENCE_IGNORED;
    }
    /**
     * @return bool
     * Whether or not the parameter is required
     */
    public function isRequired() : bool
    {
        return !$this->isOptional();
    }
    /**
     * @return bool
     * Whether or not the parameter is optional
     */
    public function isOptional() : bool
    {
        return $this->has_default_value || $this->is_variadic;
    }
    /**
     * @return bool
     * Whether or not the parameter is marked as mandatory in phpdoc
     */
    public function isMandatoryInPHPDoc() : bool
    {
        return $this->is_mandatory_in_phpdoc;
    }
    public function __toString() : string
    {
        $string = '';
        if (!$this->type->isEmpty()) {
            $string .= "{$this->type} ";
        }
        if ($this->is_variadic) {
            $string .= '...';
        }
        $string .= '$' . $this->name;
        if ($this->has_default_value) {
            $string .= ' = default';
        }
        return $string;
    }
}
