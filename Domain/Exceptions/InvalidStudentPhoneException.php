<?php

declare(strict_types=1);

class InvalidStudentPhoneException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student phone must not be empty.');
    }

    public static function becauseFormatIsInvalid(string $phone): self
    {
        return new self('The student phone format is invalid: ' . $phone);
    }
}
