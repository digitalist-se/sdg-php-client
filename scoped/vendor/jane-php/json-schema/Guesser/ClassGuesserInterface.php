<?php

namespace SdgScoped\Jane\JsonSchema\Guesser;

use SdgScoped\Jane\JsonSchema\Registry\Registry;
interface ClassGuesserInterface
{
    /**
     * Guess model.
     *
     * This guesser should create a Model and the associated File
     * The file must be inject into the context
     *
     * @internal
     */
    public function guessClass($object, string $name, string $reference, Registry $registry) : void;
}
