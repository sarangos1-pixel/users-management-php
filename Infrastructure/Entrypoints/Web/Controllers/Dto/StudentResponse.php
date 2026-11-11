<?php

declare(strict_types=1);

final class StudentResponse
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
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->birthDate = $birthDate;
        $this->semester = $semester;
        $this->email = $email;
        $this->gender = $gender;
        $this->phone = $phone;
        $this->program = $program;
        $this->university = $university;
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

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->lastName;
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return array(
            'id' => $this->id,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'birthDate' => $this->birthDate,
            'semester' => $this->semester,
            'email' => $this->email,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'program' => $this->program,
            'university' => $this->university
        );
    }
}
