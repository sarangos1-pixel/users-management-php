<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentSemesterException.php';

final class StudentSemester
{
    private const MIN = 1;
    private const MAX = 12;

    private int $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentSemesterException::becauseValueIsEmpty();
        }

        if (!ctype_digit($normalizedValue)) {
            throw InvalidStudentSemesterException::becauseValueIsNotNumeric($normalizedValue);
        }

        $semester = (int) $normalizedValue;

        if ($semester < self::MIN || $semester > self::MAX) {
            throw InvalidStudentSemesterException::becauseValueIsOutOfRange(self::MIN, self::MAX);
        }

        $this->value = $semester;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(StudentSemester $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return (string) $this->value;
    }
}
