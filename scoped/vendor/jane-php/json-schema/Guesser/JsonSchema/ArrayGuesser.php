<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\ArrayType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\MultipleType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
use SdgScoped\Jane\JsonSchema\Registry\Schema;
class ArrayGuesser implements GuesserInterface, TypeGuesserInterface, ChainGuesserAwareInterface, ClassGuesserInterface
{
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        if (\is_a($object->getItems(), $this->getSchemaClass())) {
            $this->chainGuesser->guessClass($object->getItems(), $name . 'Item', $reference . '/items', $registry);
        }
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return $object instanceof JsonSchema && 'array' === $object->getType();
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        $items = $object->getItems();
        if (null === $items || \is_array($items) && 0 === \count($items)) {
            return new ArrayType($object, new Type($object, 'mixed'));
        }
        if (!\is_array($items)) {
            return new ArrayType($object, $this->chainGuesser->guessType($items, $name . 'Item', $reference . '/items', $registry));
        }
        $type = new MultipleType($object);
        foreach ($items as $key => $item) {
            $type->addType(new ArrayType($object, $this->chainGuesser->guessType($item, $name . 'Item', $reference . '/items/' . $key, $registry)));
        }
        return $type;
    }
    protected function getSchemaClass() : string
    {
        return Schema::class;
    }
}
