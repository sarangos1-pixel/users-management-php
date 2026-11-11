<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/Commands/CreateStudentCommand.php';
require_once __DIR__ . '/../Dto/Commands/UpdateStudentCommand.php';
require_once __DIR__ . '/../Dto/Commands/DeleteStudentCommand.php';
require_once __DIR__ . '/../Dto/Queries/GetStudentByIdQuery.php';

require_once __DIR__ . '/../../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentId.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentName.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentLastName.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentBirthDate.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentSemester.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentEmail.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentPhone.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentProgram.php';
require_once __DIR__ . '/../../../Domain/ValueObjects/StudentUniversity.php';

final class StudentApplicationMapper
{
    public static function fromCreateCommandToModel(CreateStudentCommand $command): StudentModel
    {
        return StudentModel::create(
            new StudentId($command->getId()),
            new StudentName($command->getName()),
            new StudentLastName($command->getLastName()),
            new StudentBirthDate($command->getBirthDate()),
            new StudentSemester($command->getSemester()),
            new StudentEmail($command->getEmail()),
            $command->getGender(),
            new StudentPhone($command->getPhone()),
            new StudentProgram($command->getProgram()),
            new StudentUniversity($command->getUniversity())
        );
    }

    public static function fromUpdateCommandToModel(UpdateStudentCommand $command): StudentModel
    {
        return new StudentModel(
            new StudentId($command->getId()),
            new StudentName($command->getName()),
            new StudentLastName($command->getLastName()),
            new StudentBirthDate($command->getBirthDate()),
            new StudentSemester($command->getSemester()),
            new StudentEmail($command->getEmail()),
            $command->getGender(),
            new StudentPhone($command->getPhone()),
            new StudentProgram($command->getProgram()),
            new StudentUniversity($command->getUniversity())
        );
    }

    public static function fromGetStudentByIdQueryToStudentId(GetStudentByIdQuery $query): StudentId
    {
        return new StudentId($query->getId());
    }

    public static function fromDeleteCommandToStudentId(DeleteStudentCommand $command): StudentId
    {
        return new StudentId($command->getId());
    }

    /**
     * @return array<string, string|int>
     */
    public static function fromModelToArray(StudentModel $student): array
    {
        return $student->toArray();
    }

    /**
     * @param StudentModel[] $students
     * @return array<int, array<string, string|int>>
     */
    public static function fromModelsToArray(array $students): array
    {
        $result = array();

        foreach ($students as $student) {
            $result[] = self::fromModelToArray($student);
        }

        return $result;
    }
}
