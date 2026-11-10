<?php

declare(strict_types=1);

require_once __DIR__ . '/EventDomain.php';
require_once __DIR__ . '/../ValueObjects/StudentId.php';

class StudentDeletedDomainEvent extends DomainEvent
{
    private StudentId $studentId;

    public function __construct(StudentId $studentId)
    {
        parent::__construct('student.deleted');
        $this->studentId = $studentId;
    }

    public function studentId(): StudentId
    {
        return $this->studentId;
    }

    public function payload()
    {
        return array(
            'id' => $this->studentId->value()
        );
    }
}
