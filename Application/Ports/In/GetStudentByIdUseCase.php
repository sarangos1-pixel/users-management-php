<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Queries/GetStudentByIdQuery.php';
require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface GetStudentByIdUseCase
{
    public function execute(GetStudentByIdQuery $query): StudentModel;
}
