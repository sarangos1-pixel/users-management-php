<?php

declare(strict_types=1);

final class UpdateStudentCommand
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

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getSemester(): string
    {
        return $this->semester;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getProgram(): string
    {
        return $this->program;
    }

    public function getUniversity(): string
    {
        return $this->university;
    }
}
