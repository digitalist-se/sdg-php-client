<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Output\Filter;

use SdgScoped\Phan\Issue;
use SdgScoped\Phan\IssueInstance;
use SdgScoped\Phan\Output\IssueFilterInterface;
/**
 * MinimumSeverityFilter is a filter that will filter out issues
 * that are less severe than the provided minimum severity.
 */
final class MinimumSeverityFilter implements IssueFilterInterface
{
    /** @var int the provided minimum severity */
    private $minimum_severity;
    /**
     * MinimumSeverityFilter constructor.
     * @param int $minimum_severity should be a constant from Issue::SEVERITY_*
     */
    public function __construct(int $minimum_severity = Issue::SEVERITY_LOW)
    {
        $this->minimum_severity = $minimum_severity;
    }
    public function supports(IssueInstance $issue) : bool
    {
        return $issue->getIssue()->getSeverity() >= $this->minimum_severity;
    }
}
