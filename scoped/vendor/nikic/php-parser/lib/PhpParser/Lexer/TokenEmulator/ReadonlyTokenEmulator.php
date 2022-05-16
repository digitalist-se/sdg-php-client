<?php

declare (strict_types=1);
namespace SdgScoped\PhpParser\Lexer\TokenEmulator;

use SdgScoped\PhpParser\Lexer\Emulative;
final class ReadonlyTokenEmulator extends KeywordEmulator
{
    public function getPhpVersion() : string
    {
        return Emulative::PHP_8_1;
    }
    public function getKeywordString() : string
    {
        return 'readonly';
    }
    public function getKeywordToken() : int
    {
        return \T_READONLY;
    }
}
