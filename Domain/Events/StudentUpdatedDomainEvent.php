<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../Models/StudentModel.php';

class StudentUpdatedDomainEvent extends DomainEvent
{
    private StudentModel $student;

    public function __construct(StudentModel $student)
    {
        parent::__construct('student.updated');
        $this->student = $student;
    }

    public function student(): StudentModel
    {
        return $this->student;
    }

    public function payload()
    {
        return array(
            'id' => $this->student->id()->value(),
            'name' => $this->student->name()->value(),
            'lastName' => $this->student->lastName()->value(),
            'email' => $this->student->email()->value(),
            'semester' => $this->student->semester()->value(),
            'program' => $this->student->program()->value()
        );
    }
}