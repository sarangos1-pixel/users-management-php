<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentUniversityException.php';

final class StudentUniversity
{
    private const MAX_LENGTH = 150;

    private string $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentUniversityException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidStudentUniversityException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentUniversity $other): bool
    {
        return $this->value === $other->value();
    }
