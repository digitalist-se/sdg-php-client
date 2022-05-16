<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Plugin\Internal;

use Error;
use SdgScoped\Phan\CodeBase;
use SdgScoped\Phan\Phan;
use SdgScoped\Phan\Plugin\Internal\IssueFixingPlugin\IssueFixer;
use SdgScoped\Phan\PluginV3;
use SdgScoped\Phan\PluginV3\FinalizeProcessCapability;
/**
 * This plugin fixes a small number of issues automatically.
 * This uses heuristics to guess where the fix should be applied.
 */
class IssueFixingPlugin extends PluginV3 implements FinalizeProcessCapability
{
    /**
     * @override
     * @throws Error if a syntax check process fails to shut down.
     */
    public function finalizeProcess(CodeBase $code_base) : void
    {
        $instances = Phan::getIssueCollector()->getCollectedIssues();
        if (\count($instances) > 0) {
            IssueFixer::applyFixes($code_base, $instances);
        }
    }
}
// Every plugin needs to return an instance of itself at the
// end of the file in which it's defined.
return new IssueFixingPlugin();
