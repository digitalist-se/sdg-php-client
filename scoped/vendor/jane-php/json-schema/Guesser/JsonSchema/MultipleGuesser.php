<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\MultipleType;
use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\TypeGuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class MultipleGuesser implements GuesserInterface, TypeGuesserInterface, ChainGuesserAwareInterface
{
    protected $bannedTypes = [];
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        $class = $this->getSchemaClass();
        return $object instanceof $class && \is_array($object->getType());
    }
    protected function getSchemaClass() : string
    {
        return JsonSchema::class;
    }
    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type
    {
        $typeGuess = new MultipleType($object);
        $fakeSchema = clone $object;
        foreach ($object->getType() as $type) {
            if (\in_array($type, $this->bannedTypes)) {
                continue;
            }
            $fakeSchema->setType($type);
            $typeGuess->addType($this->chainGuesser->guessType($fakeSchema, $name, $reference, $registry));
        }
        return $typeGuess;
    }
}
