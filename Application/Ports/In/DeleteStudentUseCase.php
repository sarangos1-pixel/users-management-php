<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Services/Dto/Commands/DeleteStudentCommand.php';

interface DeleteStudentUseCase
{
    public function execute(DeleteStudentCommand $command): void;
}
