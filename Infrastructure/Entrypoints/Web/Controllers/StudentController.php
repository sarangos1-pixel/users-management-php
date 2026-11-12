<?php

declare(strict_types=1);

require_once __DIR__ . '/Mapper/StudentWebMapper.php';

require_once __DIR__ . '/../../../../Application/Ports/In/CreateStudentUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/UpdateStudentUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetStudentByIdUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/GetAllStudentsUseCase.php';
require_once __DIR__ . '/../../../../Application/Ports/In/DeleteStudentUseCase.php';

require_once __DIR__ . '/../../../../Application/Services/Dto/Queries/GetAllStudentsQuery.php';

final class StudentController
{
    private CreateStudentUseCase $createStudentUseCase;
    private UpdateStudentUseCase $updateStudentUseCase;
    private GetStudentByIdUseCase $getStudentByIdUseCase;
    private GetAllStudentsUseCase $getAllStudentsUseCase;
    private DeleteStudentUseCase $deleteStudentUseCase;
    private StudentWebMapper $mapper;

    public function __construct(
        CreateStudentUseCase $createStudentUseCase,
        UpdateStudentUseCase $updateStudentUseCase,
        GetStudentByIdUseCase $getStudentByIdUseCase,
        GetAllStudentsUseCase $getAllStudentsUseCase,
        DeleteStudentUseCase $deleteStudentUseCase,
        StudentWebMapper $mapper
    ) {
        $this->createStudentUseCase = $createStudentUseCase;
        $this->updateStudentUseCase = $updateStudentUseCase;
        $this->getStudentByIdUseCase = $getStudentByIdUseCase;
        $this->getAllStudentsUseCase = $getAllStudentsUseCase;
        $this->deleteStudentUseCase = $deleteStudentUseCase;
        $this->mapper = $mapper;
    }

    /**
     * @return StudentResponse[]
     */
    public function index(): array
    {
        $students = $this->getAllStudentsUseCase->execute(new GetAllStudentsQuery());

        return $this->mapper->fromModelsToResponses($students);
    }

    public function show(string $id): StudentResponse
    {
        $query = $this->mapper->fromIdToGetByIdQuery($id);
        $student = $this->getStudentByIdUseCase->execute($query);

        return $this->mapper->fromModelToResponse($student);
    }

    public function store(CreateStudentWebRequest $request): StudentResponse
    {
        $command = $this->mapper->fromCreateRequestToCommand($request);
        $student = $this->createStudentUseCase->execute($command);

        return $this->mapper->fromModelToResponse($student);
    }

    public function update(UpdateStudentWebRequest $request): StudentResponse
    {
        $command = $this->mapper->fromUpdateRequestToCommand($request);
        $student = $this->updateStudentUseCase->execute($command);

        return $this->mapper->fromModelToResponse($student);
    }

    public function delete(string $id): void
    {
        $command = $this->mapper->fromIdToDeleteCommand($id);
        $this->deleteStudentUseCase->execute($command);
    }
}
