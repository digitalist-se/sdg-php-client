<?php

declare (strict_types=1);
namespace SdgScoped\Doctrine\Inflector\Rules;

use SdgScoped\Doctrine\Inflector\WordInflector;
class Transformations implements WordInflector
{
    /** @var Transformation[] */
    private $transformations;
    public function __construct(Transformation ...$transformations)
    {
        $this->transformations = $transformations;
    }
    public function inflect(string $word) : string
    {
        foreach ($this->transformations as $transformation) {
            if ($transformation->getPattern()->matches($word)) {
                return $transformation->inflect($word);
            }
        }
        return $word;
    }
}
