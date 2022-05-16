<?php

namespace SdgScoped\Jane\JsonSchema\Guesser;

use SdgScoped\Jane\JsonSchema\Guesser\Guess\Type;
use SdgScoped\Jane\JsonSchema\Registry\Registry;
interface TypeGuesserInterface
{
    /**
     * Return all types guessed.
     *
     * @internal
     */
    public function guessType($object, string $name, string $reference, Registry $registry) : Type;
}
