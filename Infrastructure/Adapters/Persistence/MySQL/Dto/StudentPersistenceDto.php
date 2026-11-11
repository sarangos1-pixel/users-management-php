<?php

declare(strict_types=1);

final class StudentPersistenceDto
{
    private string $id;
    private string $name;
    private string $lastName;
    private string $birthDate;
    private string $semester;
    private string $email;
    private string $gender;
    private string $phone;
    private string $program;
    private string $university;

    public function __construct(
        string $id,
        string $name,
        string $lastName,
        string $birthDate,
        string $semester,
        string $email,
        string $gender,
        string $phone,
        string $program,
        string $university
    ) {
        $this->id = trim($id);
        $this->name = trim($name);
        $this->lastName = trim($lastName);
        $this->birthDate = trim($birthDate);
        $this->semester = trim($semester);
        $this->email = trim($email);
        $this->gender = trim($gender);
        $this->phone = trim($phone);
        $this->program = trim($program);
        $this->university = trim($university);
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function birthDate(): string
    {
        return $this->birthDate;
    }

    public function semester(): string
    {
        return $this->semester;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    public function phone(): string
    {
        return $this->phone;
    }

    public function program(): string
    {
        return $this->program;
    }

    public function university(): string
    {
        return $this->university;
    }
}
