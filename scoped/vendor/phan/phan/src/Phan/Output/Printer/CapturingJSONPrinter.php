<?php

declare (strict_types=1);
namespace SdgScoped\Phan\Output\Printer;

use SdgScoped\Phan\Issue;
use SdgScoped\Phan\IssueInstance;
use SdgScoped\Phan\Library\StringUtil;
use SdgScoped\Symfony\Component\Console\Output\OutputInterface;
/**
 * This prints issues as raw JSON to the configured OutputInterface.
 * The output is intended for use by other programs (or processes)
 */
class CapturingJSONPrinter extends JSONPrinter
{
    /** @var list<array<string,mixed>> the issue data to be JSON encoded. */
    protected $messages = [];
    public function print(IssueInstance $instance) : void
    {
        $issue = $instance->getIssue();
        $message = [
            'type' => 'issue',
            'type_id' => $issue->getTypeId(),
            'check_name' => $issue->getType(),
            'description' => Issue::getNameForCategory($issue->getCategory()) . ' ' . $issue->getType() . ' ' . $instance->getMessage(),
            // suggestion included separately
            'severity' => $issue->getSeverity(),
            'location' => ['path' => $instance->getDisplayedFile(), 'lines' => ['begin' => $instance->getLine(), 'end' => $instance->getLine()]],
        ];
        if ($instance->getColumn() > 0) {
            $message['location']['lines']['begin_column'] = $instance->getColumn();
        }
        $suggestion = $instance->getSuggestionMessage();
        if (StringUtil::isNonZeroLengthString($suggestion)) {
            $message['suggestion'] = $suggestion;
        }
        $this->messages[] = $message;
    }
    /** flush printer buffer */
    public function flush() : void
    {
        // Deliberately a no-op
    }
    /**
     * @unused-param $output
     * @override
     */
    public function configureOutput(OutputInterface $output) : void
    {
        // Deliberately a no-op.
    }
    /** @return list<array<string,mixed>> the issue data to be JSON encoded. */
    public function getIssues() : array
    {
        return $this->messages;
    }
}
