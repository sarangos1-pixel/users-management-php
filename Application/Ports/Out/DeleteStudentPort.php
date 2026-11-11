<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/ValueObjects/StudentId.php';

interface DeleteStudentPort
{
    public function delete(StudentId $studentId): void;
}
