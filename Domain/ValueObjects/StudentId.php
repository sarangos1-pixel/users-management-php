<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentIdException.php';

final class StudentId
{
    private string $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentIdException::becauseValueIsEmpty();
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentId $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}