<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/CreateStudentRequest.php';
require_once __DIR__ . '/../Dto/UpdateStudentRequest.php';
require_once __DIR__ . '/../Dto/StudentResponse.php';

require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/CreateStudentCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/UpdateStudentCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Commands/DeleteStudentCommand.php';
require_once __DIR__ . '/../../../../../Application/Services/Dto/Queries/GetStudentByIdQuery.php';

require_once __DIR__ . '/../../../../../Domain/Models/StudentModel.php';

final class StudentWebMapper
{
    public function fromCreateRequestToCommand(CreateStudentWebRequest $request): CreateStudentCommand
    {
        return new CreateStudentCommand(
            $request->getId(),
            $request->getName(),
            $request->getLastName(),
            $request->getBirthDate(),
            $request->getSemester(),
            $request->getEmail(),
            $request->getGender(),
            $request->getPhone(),
            $request->getProgram(),
            $request->getUniversity()
        );
    }

    public function fromUpdateRequestToCommand(UpdateStudentWebRequest $request): UpdateStudentCommand
    {
        return new UpdateStudentCommand(
            $request->getId(),
            $request->getName(),
            $request->getLastName(),
            $request->getBirthDate(),
            $request->getSemester(),
            $request->getEmail(),
            $request->getGender(),
            $request->getPhone(),
            $request->getProgram(),
            $request->getUniversity()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetStudentByIdQuery
    {
        return new GetStudentByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteStudentCommand
    {
        return new DeleteStudentCommand($id);
    }

    public function fromModelToResponse(StudentModel $student): StudentResponse
    {
        return new StudentResponse(
            $student->id()->value(),
            $student->name()->value(),
            $student->lastName()->value(),
            $student->birthDate()->value(),
            (string) $student->semester()->value(),
            $student->email()->value(),
            $student->gender(),
            $student->phone()->value(),
            $student->program()->value(),
            $student->university()->value()
        );
    }

    /**
     * @param StudentModel[] $students
     * @return StudentResponse[]
     */
    public function fromModelsToResponses(array $students): array
    {
        $responses = array();

        foreach ($students as $student) {
            $responses[] = $this->fromModelToResponse($student);
        }

        return $responses;
    }
}
