<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentEmail.php';

interface GetStudentByEmailPort
{
    public function getByEmail(StudentEmail $email): ?StudentModel;
}
