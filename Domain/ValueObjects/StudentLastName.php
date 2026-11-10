<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentLastNameException.php';

final class StudentLastName
{
    private const MIN_LENGTH = 2;
    private const MAX_LENGTH = 100;

    private string $value;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentLastNameException::becauseValueIsEmpty();
        }

        if (mb_strlen($normalizedValue) < self::MIN_LENGTH) {
            throw InvalidStudentLastNameException::becauseLengthIsTooShort(self::MIN_LENGTH);
        }

        if (mb_strlen($normalizedValue) > self::MAX_LENGTH) {
            throw InvalidStudentLastNameException::becauseLengthIsTooLong(self::MAX_LENGTH);
        }

        $this->value = $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentLastName $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
