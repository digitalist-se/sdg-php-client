<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\MultipleType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class AnyOfGuesser implements GuesserInterface, ClassGuesserInterface, TypeGuesserInterface, ChainGuesserAwareInterface
{
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        foreach ($object->getAnyOf() as $anyOfKey => $anyOfObject) {
            $this->chainGuesser->guessClass($anyOfObject, $name . 'AnyOf', $reference . '/anyOf/' . $anyOfKey, $registry);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        if (1 == \count($object->getAnyOf())) {
            return $this->chainGuesser->guessType($object->getAnyOf()[0], $name, $reference . '/anyOf/0', $registry);
        }
        $type = new MultipleType($object);
        foreach ($object->getAnyOf() as $anyOfKey => $anyOfObject) {
            $type->addType($this->chainGuesser->guessType($anyOfObject, $name, $reference . '/anyOf/' . $anyOfKey, $registry));
        }
        return $type;
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return $object instanceof JsonSchema && \is_array($object->getAnyOf()) && \count($object->getAnyOf()) > 0;
    }
}
