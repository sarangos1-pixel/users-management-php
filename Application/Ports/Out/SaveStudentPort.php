<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface SaveStudentPort
{
    public function save(StudentModel $student): StudentModel;
}
