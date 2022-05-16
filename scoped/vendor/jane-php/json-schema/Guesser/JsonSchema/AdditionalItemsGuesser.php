<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class AdditionalItemsGuesser implements ChainGuesserAwareInterface, GuesserInterface, ClassGuesserInterface
{
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        $this->chainGuesser->guessClass($object->getAdditionalItems(), $name . 'AdditionalItems', $reference . '/additionalItems', $registry);
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        return $object instanceof JsonSchema && $object->getAdditionalItems() instanceof JsonSchema;
    }
}
