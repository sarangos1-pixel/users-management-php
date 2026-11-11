<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface GetAllStudentsPort
{
    /**
     * @return StudentModel[]
     */
    public function getAll(): array;
}