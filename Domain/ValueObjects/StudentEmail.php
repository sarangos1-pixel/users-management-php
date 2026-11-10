<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentEmailException.php';

final class StudentEmail
{
    private const MAX_LENGTH = 150;

    private string $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentEmailException::becauseValueIsEmpty();
        }

        if (strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidStudentEmailException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        if (!filter_var($normalizedValue, FILTER_VALIDATE_EMAIL)) {
            throw InvalidStudentEmailException::becauseFormatIsInvalid($normalizedValue);
        }

        $this->value = strtolower($normalizedValue);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentEmail $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
