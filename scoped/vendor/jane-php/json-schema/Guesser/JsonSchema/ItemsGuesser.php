<?php

namespace SdgScoped\Jane\JsonSchema\Guesser\JsonSchema;

use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareInterface;
use SdgScoped\Jane\JsonSchema\Guesser\ChainGuesserAwareTrait;
use SdgScoped\Jane\JsonSchema\Guesser\ClassGuesserInterface;
use SdgScoped\Jane\JsonSchema\Guesser\GuesserInterface;
use SdgScoped\Jane\JsonSchema\JsonSchema\Model\JsonSchema;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
class ItemsGuesser implements GuesserInterface, ClassGuesserInterface, ChainGuesserAwareInterface
{
    use ChainGuesserAwareTrait;
    /**
     * {@inheritdoc}
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void
    {
        if ($object->getItems() instanceof JsonSchema) {
            $this->chainGuesser->guessClass($object->getItems(), $name . 'Item', $reference . '/items', $registry);
        } else {
            foreach ($object->getItems() as $key => $item) {
                $this->chainGuesser->guessClass($item, $name . 'Item' . $key, $reference . '/items/' . $key, $registry);
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    public function supportObject($object) : bool
    {
        $class = $this->getSchemaClass();
        return $object instanceof $class && ($object->getItems() instanceof $class || \is_array($object->getItems()) && \count($object->getItems()) > 0);
    }
    protected function getSchemaClass() : string
    {
        return JsonSchema::class;
    }
}
