<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetStudentByIdUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetStudentByIdPort.php';
require_once __DIR__ . '/Mappers/StudentApplicationMapper.php';
require_once __DIR__ . '/../../Domain/Exceptions/StudentNotFoundException.php';

final class GetStudentByIdService implements GetStudentByIdUseCase
{
    private GetStudentByIdPort $getStudentByIdPort;

    public function __construct(GetStudentByIdPort $getStudentByIdPort)
    {
        $this->getStudentByIdPort = $getStudentByIdPort;
    }

    public function execute(GetStudentByIdQuery $query): StudentModel
    {
        $studentId = StudentApplicationMapper::fromGetStudentByIdQueryToStudentId($query);
        $student = $this->getStudentByIdPort->getById($studentId);

        if ($student === null) {
            throw StudentNotFoundException::becauseIdWasNotFound($studentId->value());
        }

        return $student;
    }
}
