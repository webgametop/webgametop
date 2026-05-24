<?php

declare(strict_types=1);

namespace App\Helpers;

final class Email
{
    private const DEFAULT_MAX_LOCAL_LENGTH = 64;
    private const DEFAULT_MIN_LOCAL_LENGTH = 5;

    private function __construct()
    {
    }

    public static function validate(
        string $email,
        int $maxLocalLength = self::DEFAULT_MAX_LOCAL_LENGTH,
        int $minLocalLength = self::DEFAULT_MIN_LOCAL_LENGTH,
    ) : bool
    {
        $email = self::normalize($email);

        return self::hasValidSyntax($email)
            && self::hasValidLocalPartLength($email, $maxLocalLength, $minLocalLength)
            && self::hasActiveDomain($email);
    }

    public static function hasValidSyntax(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function hasValidLocalPartLength(
        string $email,
        int $maxLength,
        int $minLength,
    ) : bool
    {
        $localPart = self::extractLocalPart($email);

        if (null === $localPart) {
            return false;
        }

        $length = mb_strlen($localPart);

        return $length >= $minLength
            && $length <= $maxLength;
    }

    public static function hasActiveDomain(string $email): bool
    {
        $domain = self::extractDomain($email);

        if (null === $domain) {
            return false;
        }

        return self::hasMxRecord($domain)
            || self::hasARecord($domain);
    }

    private static function normalize(string $email): string
    {
        return trim(mb_strtolower($email));
    }

    private static function extractLocalPart(string $email): ?string
    {
        $atPosition = strpos($email, '@');

        if (false === $atPosition) {
            return null;
        }

        return substr($email, 0, $atPosition);
    }

    private static function extractDomain(string $email): ?string
    {
        $atPosition = strpos($email, '@');

        if (false === $atPosition) {
            return null;
        }

        return substr($email, $atPosition + 1);
    }

    private static function hasMxRecord(string $domain): bool
    {
        return checkdnsrr($domain, 'MX');
    }

    private static function hasARecord(string $domain): bool
    {
        return checkdnsrr($domain, 'A');
    }
}
