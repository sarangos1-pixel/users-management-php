<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentId.php';

interface GetStudentByIdPort
{
    public function getById(StudentId $studentId): ?StudentModel;
}

