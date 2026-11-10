<?php

declare(strict_types=1);

require_once __DIR__ . '/../ValueObjects/StudentId.php';
require_once __DIR__ . '/../ValueObjects/StudentName.php';
require_once __DIR__ . '/../ValueObjects/StudentLastName.php';
require_once __DIR__ . '/../ValueObjects/StudentBirthDate.php';
require_once __DIR__ . '/../ValueObjects/StudentSemester.php';
require_once __DIR__ . '/../ValueObjects/StudentEmail.php';
require_once __DIR__ . '/../ValueObjects/StudentPhone.php';
require_once __DIR__ . '/../ValueObjects/StudentProgram.php';
require_once __DIR__ . '/../ValueObjects/StudentUniversity.php';
require_once __DIR__ . '/../Enums/StudentGenderEnum.php';

final class StudentModel
{
    private StudentId $id;
    private StudentName $name;
    private StudentLastName $lastName;
    private StudentBirthDate $birthDate;
    private StudentSemester $semester;
    private StudentEmail $email;
    private string $gender;
    private StudentPhone $phone;
    private StudentProgram $program;
    private StudentUniversity $university;

    public function __construct(
        StudentId $id,
        StudentName $name,
        StudentLastName $lastName,
        StudentBirthDate $birthDate,
        StudentSemester $semester,
        StudentEmail $email,
        string $gender,
        StudentPhone $phone,
        StudentProgram $program,
        StudentUniversity $university
    ) {
        StudentGenderEnum::ensureIsValid($gender);

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

    public static function create(
        StudentId $id,
        StudentName $name,
        StudentLastName $lastName,
        StudentBirthDate $birthDate,
        StudentSemester $semester,
        StudentEmail $email,
        string $gender,
        StudentPhone $phone,
        StudentProgram $program,
        StudentUniversity $university
    ): self {
        return new self(
            $id,
            $name,
            $lastName,
            $birthDate,
            $semester,
            $email,
            $gender,
            $phone,
            $program,
            $university
        );
    }

    public function id(): StudentId
    {
        return $this->id;
    }

    public function name(): StudentName
    {
        return $this->name;
    }

    public function lastName(): StudentLastName
    {
        return $this->lastName;
    }

    public function birthDate(): StudentBirthDate
    {
        return $this->birthDate;
    }

    public function semester(): StudentSemester
    {
        return $this->semester;
    }

    public function email(): StudentEmail
    {
        return $this->email;
    }

    public function gender(): string
    {
        return $this->gender;
    }

    public function phone(): StudentPhone
    {
        return $this->phone;
    }

    public function program(): StudentProgram
    {
        return $this->program;
    }

    public function university(): StudentUniversity
    {
        return $this->university;
    }

    // El modelo es inmutable: cada cambio devuelve una copia nueva.

    public function changeName(StudentName $name): self
    {
        $copy = clone $this;
        $copy->name = $name;

        return $copy;
    }

    public function changeLastName(StudentLastName $lastName): self
    {
        $copy = clone $this;
        $copy->lastName = $lastName;

        return $copy;
    }

    public function changeBirthDate(StudentBirthDate $birthDate): self
    {
        $copy = clone $this;
        $copy->birthDate = $birthDate;

        return $copy;
    }

    public function changeSemester(StudentSemester $semester): self
    {
        $copy = clone $this;
        $copy->semester = $semester;

        return $copy;
    }

    public function advanceSemester(): self
    {
        return $this->changeSemester(new StudentSemester($this->semester->value() + 1));
    }

    public function changeEmail(StudentEmail $email): self
    {
        $copy = clone $this;
        $copy->email = $email;

        return $copy;
    }

    public function changeGender(string $gender): self
    {
        StudentGenderEnum::ensureIsValid($gender);

        $copy = clone $this;
        $copy->gender = $gender;

        return $copy;
    }

    public function changePhone(StudentPhone $phone): self
    {
        $copy = clone $this;
        $copy->phone = $phone;

        return $copy;
    }

    public function changeProgram(StudentProgram $program): self
    {
        $copy = clone $this;
        $copy->program = $program;

        return $copy;
    }

    public function changeUniversity(StudentUniversity $university): self
    {
        $copy = clone $this;
        $copy->university = $university;

        return $copy;
    }

    public function toArray(): array
    {
        return array(
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'lastName' => $this->lastName->value(),
            'birthDate' => $this->birthDate->value(),
            'semester' => $this->semester->value(),
            'email' => $this->email->value(),
            'gender' => $this->gender,
            'phone' => $this->phone->value(),
            'program' => $this->program->value(),
            'university' => $this->university->value()
        );
    }
}
