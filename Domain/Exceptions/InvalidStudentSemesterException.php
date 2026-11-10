<?php

declare(strict_types=1);

class InvalidStudentSemesterException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student semester must not be empty.');
    }

    public static function becauseValueIsNotNumeric(string $semester): self
    {
        return new self('The student semester must be a whole number: ' . $semester);
    }

    public static function becauseValueIsOutOfRange(int $min, int $max): self
    {
        return new self('The student semester must be between ' . $min . ' and ' . $max . '.');
    }
}