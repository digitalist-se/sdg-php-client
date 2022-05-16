<?php

declare (strict_types=1);
namespace SdgScoped\Phan\AST;

use ast\Node;
use function is_float;
use function is_int;
use function is_null;
use function is_object;
use function is_string;
use function md5;
/**
 * This converts a PHP AST Node into a hash.
 * This ignores line numbers and spacing.
 */
class ASTHasher
{
    /**
     * @param string|int|null $node
     * @return string a 16-byte binary key for the array key
     * @internal
     */
    public static function hashKey($node) : string
    {
        if (is_string($node)) {
            return md5($node, \true);
        } elseif (is_int($node)) {
            if (\PHP_INT_SIZE >= 8) {
                return "\x00\x00\x00\x00\x00\x00\x00\x00" . \pack('J', $node);
            } else {
                return "\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00" . \pack('N', $node);
            }
        }
        // This is not a valid array key, give up
        return md5((string) $node, \true);
    }
    /**
     * @param Node|string|int|float|null $node
     * @return string a 16-byte binary key for the Node which is unlikely to overlap for ordinary code
     */
    public static function hash($node) : string
    {
        if (!is_object($node)) {
            // hashKey
            if (is_string($node)) {
                return md5($node, \true);
            } elseif (is_int($node)) {
                if (\PHP_INT_SIZE >= 8) {
                    return "\x00\x00\x00\x00\x00\x00\x00\x00" . \pack('J', $node);
                } else {
                    return "\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00" . \pack('N', $node);
                }
            } elseif (is_float($node)) {
                return "\x00\x00\x00\x00\x00\x00\x00\x01" . \pack('e', $node);
            } elseif (is_null($node)) {
                return "\x00\x00\x00\x00\x00\x00\x00\x02\x00\x00\x00\x00\x00\x00\x00\x00";
            }
            // This is not a valid AST, give up
            return md5((string) $node, \true);
        }
        // @phan-suppress-next-line PhanUndeclaredProperty
        return $node->hash ?? ($node->hash = self::computeHash($node));
    }
    /**
     * @param Node $node
     * @return string a newly computed 16-byte binary key
     */
    private static function computeHash(Node $node) : string
    {
        $str = 'N' . $node->kind . ':' . ($node->flags & 0xfffff);
        foreach ($node->children as $key => $child) {
            // added in PhanAnnotationAdder
            if (\is_string($key) && \strncmp($key, 'phan', 4) === 0) {
                continue;
            }
            $str .= self::hashKey($key);
            $str .= self::hash($child);
        }
        return md5($str, \true);
    }
}
