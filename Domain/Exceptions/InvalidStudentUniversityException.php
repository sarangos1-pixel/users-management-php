<?php

declare(strict_types=1);

class InvalidStudentUniversityException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student university must not be empty.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The student university must not exceed ' . $maxLength . ' characters.');
    }
}