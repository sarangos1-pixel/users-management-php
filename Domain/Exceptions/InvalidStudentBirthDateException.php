<?php

declare(strict_types=1);

class InvalidStudentBirthDateException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student birth date must not be empty.');
    }

    public static function becauseFormatIsInvalid(string $date): self
    {
        return new self('The student birth date must be a valid date with format YYYY-MM-DD: ' . $date);
    }

    public static function becauseDateIsInTheFuture(): self
    {
        return new self('The student birth date must not be in the future.');
    }

    public static function becauseDateIsTooOld(int $maxAge): self
    {
        return new self('The student birth date implies an age greater than ' . $maxAge . ' years.');
    }
}
