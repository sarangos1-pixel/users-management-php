<?php

declare(strict_types=1);

class InvalidStudentLastNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student last name must not be empty.');
    }

    public static function becauseLengthIsTooShort(int $minLength): self
    {
        return new self('The student last name must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The student last name must not exceed ' . $maxLength . ' characters.');
    }
}