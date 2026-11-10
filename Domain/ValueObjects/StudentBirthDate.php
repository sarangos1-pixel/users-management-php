<?php

declare(strict_types=1);

require_once __DIR__ . '/../Exceptions/InvalidStudentBirthDateException.php';

final class StudentBirthDate
{
    private const FORMAT = 'Y-m-d';
    private const MAX_AGE_YEARS = 120;

    private string $value;
    private DateTimeImmutable $date;

    public function __construct($value)
    {
        $normalizedValue = trim((string) $value);

        if ($normalizedValue === '') {
            throw InvalidStudentBirthDateException::becauseValueIsEmpty();
        }

        $date = DateTimeImmutable::createFromFormat('!' . self::FORMAT, $normalizedValue);

        // createFromFormat acepta fechas "desbordadas" (2000-02-31 -> 2000-03-02);
        // por eso se compara el resultado con el texto original.
        if ($date === false || $date->format(self::FORMAT) !== $normalizedValue) {
            throw InvalidStudentBirthDateException::becauseFormatIsInvalid($normalizedValue);
        }

        $today = new DateTimeImmutable('today');

        if ($date > $today) {
            throw InvalidStudentBirthDateException::becauseDateIsInTheFuture();
        }

        if ($date < $today->modify('-' . self::MAX_AGE_YEARS . ' years')) {
            throw InvalidStudentBirthDateException::becauseDateIsTooOld(self::MAX_AGE_YEARS);
        }

        $this->value = $normalizedValue;
        $this->date = $date;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function toDateTime(): DateTimeImmutable
    {
        return $this->date;
    }

    public function age(): int
    {
        return $this->date->diff(new DateTimeImmutable('today'))->y;
    }

    public function equals(StudentBirthDate $other): bool
    {
        return $this->value === $other->value();
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
