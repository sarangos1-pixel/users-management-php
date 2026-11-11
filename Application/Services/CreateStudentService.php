<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/CreateStudentUseCase.php';
require_once __DIR__ . '/../Ports/Out/SaveStudentPort.php';
require_once __DIR__ . '/../Ports/Out/GetStudentByEmailPort.php';
require_once __DIR__ . '/Mappers/StudentApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/StudentAlreadyExistsException.php';
require_once __DIR__ . '/../../Domain/ValueObjects/StudentEmail.php';

final class CreateStudentService implements CreateStudentUseCase
{
    private SaveStudentPort $saveStudentPort;
    private GetStudentByEmailPort $getStudentByEmailPort;

    public function __construct(
        SaveStudentPort $saveStudentPort,
        GetStudentByEmailPort $getStudentByEmailPort
    ) {
        $this->saveStudentPort = $saveStudentPort;
        $this->getStudentByEmailPort = $getStudentByEmailPort;
    }

    public function execute(CreateStudentCommand $command): StudentModel
    {
        $email = new StudentEmail($command->getEmail());
        $existingStudent = $this->getStudentByEmailPort->getByEmail($email);

        if ($existingStudent !== null) {
            throw StudentAlreadyExistsException::becauseEmailAlreadyExists($email->value());
        }

        $student = StudentApplicationMapper::fromCreateCommandToModel($command);

        return $this->saveStudentPort->save($student);
    }
}
