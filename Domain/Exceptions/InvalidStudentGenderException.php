<?php

declare(strict_types=1);

class InvalidStudentGenderException extends InvalidArgumentException
{
    public static function becauseValueIsInvalid(string $gender): self
    {
        return new self('The student gender is invalid: ' . $gender);
    }
}

