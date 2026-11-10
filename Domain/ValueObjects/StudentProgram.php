<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentProgramException.php';

final class StudentProgram
{
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentProgramException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidStudentProgramException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentProgram $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}