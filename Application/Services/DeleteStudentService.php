<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/DeleteStudentUseCase.php';
require_once __DIR__ . '/../Ports/Out/DeleteStudentPort.php';
require_once __DIR__ . '/../Ports/Out/GetStudentByIdPort.php';
require_once __DIR__ . '/Mappers/StudentApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/StudentNotFoundException.php';

final class DeleteStudentService implements DeleteStudentUseCase
{
    private DeleteStudentPort $deleteStudentPort;
    private GetStudentByIdPort $getStudentByIdPort;

    public function __construct(
        DeleteStudentPort $deleteStudentPort,
        GetStudentByIdPort $getStudentByIdPort
    ) {
        $this->deleteStudentPort = $deleteStudentPort;
        $this->getStudentByIdPort = $getStudentByIdPort;
    }

    public function execute(DeleteStudentCommand $command): void
    {
        $studentId = StudentApplicationMapper::fromDeleteCommandToStudentId($command);
        $existingStudent = $this->getStudentByIdPort->getById($studentId);

        if ($existingStudent === null) {
            throw StudentNotFoundException::becauseIdWasNotFound($studentId->value());
        }

        $this->deleteStudentPort->delete($studentId);
    }
}
