<?php

declare(strict_types=1);

require_once __DIR__ . '/../Ports/In/GetAllStudentsUseCase.php';
require_once __DIR__ . '/../Ports/Out/GetAllStudentsPort.php';

final class GetAllStudentsService implements GetAllStudentsUseCase
{
    private GetAllStudentsPort $getAllStudentsPort;

    public function __construct(GetAllStudentsPort $getAllStudentsPort)
    {
        $this->getAllStudentsPort = $getAllStudentsPort;
    }

    /**
     * @return StudentModel[]
     */
    public function execute(GetAllStudentsQuery $query): array
    {
        return $this->getAllStudentsPort->getAll();
    }
}