<?php

declare(strict_types=1);

class InvalidStudentIdException extends InvalidArgumentException
{
    public static function becauseValueIsEmpty(): self
    {
        return new self('The student id must not be empty.');
    }
}