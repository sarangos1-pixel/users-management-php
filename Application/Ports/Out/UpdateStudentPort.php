<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface UpdateStudentPort
{
    public function update(StudentModel $student): StudentModel;
}