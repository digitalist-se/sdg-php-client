<?php

namespace SdgScoped\Jane\JsonSchema\Guesser;

use SdgScoped\Jane\JsonSchema\Guesser\Guess\Property;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
interface PropertiesGuesserInterface
{
    /**
     * Return all properties guessed.
     *
     * @internal
     *
     * @return Property[]
     */
    public function guessProperties($object, string $name, string $reference, Registry $registry) : array;
}
