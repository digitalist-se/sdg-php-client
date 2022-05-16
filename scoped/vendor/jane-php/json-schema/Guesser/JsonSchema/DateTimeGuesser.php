<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\Guess\DateTimeType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class DateTimeGuesser implements GuesserInterface, TypeGuesserInterface
{
    /** @var string Format of date to use when normalized */
    private $outputDateFormat;
    /** @var string Format of date to use when denormalized */
    private $inputDateFormat;
    /**
     * @var bool|null
     */
    private $preferInterface;
    public function __construct(string $outputDateFormat = \DateTime::RFC3339, ?string $inputDateFormat = null, ?bool $preferInterface = null)
    {
        $this->outputDateFormat = $outputDateFormat;
        $this->inputDateFormat = $inputDateFormat;
        $this->preferInterface = $preferInterface;
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        $class = $this->getSchemaClass();
        return $object instanceof $class && 'string' === $object->getType() && 'date-time' === $object->getFormat();
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        return new DateTimeType($object, $this->outputDateFormat, $this->inputDateFormat, $this->preferInterface);
    }
    protected function getSchemaClass() : string
    {
        return JsonSchema::class;
    }
}
