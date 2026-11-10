<?php

declare(strict_types=1);

class StudentAlreadyExistsException extends DomainException
{
    public static function becauseEmailAlreadyExists(string $email): self
    {
        return new self('A student with email ' . $email . ' already exists.');
    }
}
