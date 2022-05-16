<?php

declare (strict_types=1);
namespace SdgScoped\Phan\PluginV3;

use Closure;
use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\IssueInstance;
use SdgScoped\Phan\Library\FileCacheEntry;
use SdgScoped\Phan\Plugin\Internal\IssueFixingPlugin\FileEditSet;
/**
 * AutomaticFixCapability is used when you want to support --automatic-fix
 * for issue types emitted by the plugin (or other issue types)
 */
interface AutomaticFixCapability
{
    /**
     * This method is called to fetch the issue names the plugin can sometimes automatically fix.
     * Returns a map from issue name to the closure to generate a fix for instances of that issue.
     *
     * @return array<string,Closure(CodeBase,FileCacheEntry,IssueInstance):(?FileEditSet)>
     */
    public function getAutomaticFixers() : array;
}
