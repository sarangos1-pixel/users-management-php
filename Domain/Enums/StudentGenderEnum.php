<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentGenderException.php';

class StudentGenderEnum
{
    const MALE = 'MALE';
    const FEMALE = 'FEMALE';
    const OTHER = 'OTHER';

    public static function values(): array
    {
        return array(
            self::MALE,
            self::FEMALE,
            self::OTHER
        );
    }

    public static function isValid(string $value): bool
    {
        return in_array($value, self::values(), true);
    }

    public static function ensureIsValid(string $value): void
    {
        if (!self::isValid($value)) {
            throw InvalidStudentGenderException::becauseValueIsInvalid($value);
        }
    }
}
