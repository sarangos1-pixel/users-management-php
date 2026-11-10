<?php

declare(strict_types=1);

class InvalidStudentProgramException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student program must not be empty.');
    }

    public static function becauseLengthIsTooLong(int $maxLength): self
    {
        return new self('The student program must not exceed ' . $maxLength . ' characters.');
    }
}