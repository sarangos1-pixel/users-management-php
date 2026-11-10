<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentPhoneException.php';

final class StudentPhone
{
    private string $value;

    public function __construct($value)
    {
        $rawValue = trim((string) $value);

        if ($rawValue === '') {
            throw InvalidStudentPhoneException::becauseValueIsEmpty();
        }

        // Quita espacios, guiones, puntos y parentesis: "(300) 123-4567" -> "3001234567"
        $normalizedValue = preg_replace('/[\s\-\.\(\)]/', '', $rawValue);

        // Opcional "+" inicial y entre 7 y 15 digitos (formato E.164)
        if (preg_match('/^\+?[0-9]{7,15}$/', (string) $normalizedValue) !== 1) {
            throw InvalidStudentPhoneException::becauseFormatIsInvalid($rawValue);
        }

        $this->value = (string) $normalizedValue;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(StudentPhone $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}