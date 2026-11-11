<?php

declare(strict_types=1);

require_once __DIR__ . '/../Dto/StudentPersistenceDto.php';
require_once __DIR__ . '/../Entity/StudentEntity.php';

require_once __DIR__ . '/../../../../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentName.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentLastName.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentBirthDate.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentSemester.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentEmail.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentPhone.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentProgram.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentUniversity.php';

final class StudentPersistenceMapper
{
    public function fromModelToDto(StudentModel $student): StudentPersistenceDto
    {
        return new StudentPersistenceDto(
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

    public function fromDtoToEntity(StudentPersistenceDto $dto): StudentEntity
    {
        return new StudentEntity(
            $dto->id(),
            $dto->name(),
            $dto->lastName(),
            $dto->birthDate(),
            $dto->semester(),
            $dto->email(),
            $dto->gender(),
            $dto->phone(),
            $dto->program(),
            $dto->university()
        );
    }

    public function fromRowToEntity(array $row): StudentEntity
    {
        return new StudentEntity(
            (string) $row['id'],
            (string) $row['name'],
            (string) $row['last_name'],
            (string) $row['birth_date'],
            (string) $row['semester'],
            (string) $row['email'],
            (string) $row['gender'],
            (string) $row['phone'],
            (string) $row['program'],
            (string) $row['university'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(StudentEntity $entity): StudentModel
    {
        return new StudentModel(
            new StudentId($entity->id()),
            new StudentName($entity->name()),
            new StudentLastName($entity->lastName()),
            new StudentBirthDate($entity->birthDate()),
            new StudentSemester($entity->semester()),
            new StudentEmail($entity->email()),
            $entity->gender(),
            new StudentPhone($entity->phone()),
            new StudentProgram($entity->program()),
            new StudentUniversity($entity->university())
        );
    }

    public function fromRowToModel(array $row): StudentModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return StudentModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();

        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }

        return $models;
    }
}
