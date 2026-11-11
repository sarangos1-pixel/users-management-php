<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/UpdateStudentUseCase.php';
require_once __DIR__ . '/../Ports/Out/UpdateStudentPort.php';
require_once __DIR__ . '/../Ports/Out/GetStudentByIdPort.php';
require_once __DIR__ . '/../Ports/Out/GetStudentByEmailPort.php';
require_once __DIR__ . '/Mappers/StudentApplicationMapper.php';

require_once __DIR__ . '/../../Domain/Exceptions/StudentAlreadyExistsException.php';
require_once __DIR__ . '/../../Domain/Exceptions/StudentNotFoundException.php';
require_once __DIR__ . '/../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../Domain/ValueObjects/StudentId.php';
require_once __DIR__ . '/../../Domain/ValueObjects/StudentEmail.php';

final class UpdateStudentService implements UpdateStudentUseCase
{
    private UpdateStudentPort $updateStudentPort;
    private GetStudentByIdPort $getStudentByIdPort;
    private GetStudentByEmailPort $getStudentByEmailPort;

    public function __construct(
        UpdateStudentPort $updateStudentPort,
        GetStudentByIdPort $getStudentByIdPort,
        GetStudentByEmailPort $getStudentByEmailPort
    ) {
        $this->updateStudentPort = $updateStudentPort;
        $this->getStudentByIdPort = $getStudentByIdPort;
        $this->getStudentByEmailPort = $getStudentByEmailPort;
    }

    public function execute(UpdateStudentCommand $command): StudentModel
    {
        $studentId = new StudentId($command->getId());
        $currentStudent = $this->getStudentByIdPort->getById($studentId);

        if ($currentStudent === null) {
            throw StudentNotFoundException::becauseIdWasNotFound($studentId->value());
        }

        $newEmail = new StudentEmail($command->getEmail());
        $studentWithSameEmail = $this->getStudentByEmailPort->getByEmail($newEmail);

        if ($studentWithSameEmail !== null && !$studentWithSameEmail->id()->equals($studentId)) {
            throw StudentAlreadyExistsException::becauseEmailAlreadyExists($newEmail->value());
        }

        $studentToUpdate = StudentApplicationMapper::fromUpdateCommandToModel($command);

        return $this->updateStudentPort->update($studentToUpdate);
    }
}
