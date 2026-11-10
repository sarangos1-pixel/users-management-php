<?php

declare(strict_types=1);

class InvalidStudentNameException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student name must not be empty.');
    }

    public static function becauseLengthIsTooShort(int $minLength): self
    {
        return new self('The student name must contain at least ' . $minLength . ' characters.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The student name must not exceed ' . $maxLength . ' characters.');
    }
}