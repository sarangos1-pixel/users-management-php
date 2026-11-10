<?php

declare(strict_types=1);

class StudentNotFoundException extends DomainException
{
    public static function becauseIdWasNotFound(string $id): self
    {
        return new self('The student with id ' . $id . ' was not found.');
    }
}
