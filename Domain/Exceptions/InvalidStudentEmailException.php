<?php

declare(strict_types=1);

class InvalidStudentEmailException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student email must not be empty.');
    }

    public static function becauseFormatIsInvalid(string $email): self
    {
        return new self('The student email format is invalid: ' . $email);
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The student email must not exceed ' . $maxLength . ' characters.');
    }
}