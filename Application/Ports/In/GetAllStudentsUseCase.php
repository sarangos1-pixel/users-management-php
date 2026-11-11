<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetAllStudentsQuery.php';
require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface GetAllStudentsUseCase
{
    /**
     * @return StudentModel[]
     */
    public function execute(GetAllStudentsQuery $query): array;
}

