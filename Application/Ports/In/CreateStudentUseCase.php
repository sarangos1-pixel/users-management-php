<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/CreateStudentCommand.php';
require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';

interface CreateStudentUseCase
{
    public function execute(CreateStudentCommand $command): StudentModel;
}
