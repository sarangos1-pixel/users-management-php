<?php

declare(strict_types=1);

require_once __DIR__ . '/../../../../../Application/Ports/Out/SaveStudentPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/UpdateStudentPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetStudentByIdPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetStudentByEmailPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/GetAllStudentsPort.php';
require_once __DIR__ . '/../../../../../Application/Ports/Out/DeleteStudentPort.php';

require_once __DIR__ . '/../Mapper/StudentPersistenceMapper.php';
require_once __DIR__ . '/../../../../../Domain/Models/StudentModel.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentId.php';
require_once __DIR__ . '/../../../../../Domain/ValueObjects/StudentEmail.php';

final class StudentRepositoryMySQL implements
    SaveStudentPort,
    UpdateStudentPort,
    GetStudentByIdPort,
    GetStudentByEmailPort,
    GetAllStudentsPort,
    DeleteStudentPort
{
    private PDO $pdo;
    private StudentPersistenceMapper $mapper;

    public function __construct(PDO $pdo, StudentPersistenceMapper $mapper)
    {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(StudentModel $student): StudentModel
    {
        $dto = $this->mapper->fromModelToDto($student);

        $sql = '
            INSERT INTO students (
                id,
                name,
                last_name,
                birth_date,
                semester,
                email,
                gender,
                phone,
                program,
                university,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :name,
                :last_name,
                :birth_date,
                :semester,
                :email,
                :gender,
                :phone,
                :program,
                :university,
                NOW(),
                NOW()
            )
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->toParameters($dto));

        $savedStudent = $this->getById(new StudentId($dto->id()));

        if ($savedStudent === null) {
            throw new RuntimeException('The student could not be recovered after save.');
        }

        return $savedStudent;
    }

    public function update(StudentModel $student): StudentModel
    {
        $dto = $this->mapper->fromModelToDto($student);

        $sql = '
            UPDATE students
               SET name = :name,
                   last_name = :last_name,
                   birth_date = :birth_date,
                   semester = :semester,
                   email = :email,
                   gender = :gender,
                   phone = :phone,
                   program = :program,
                   university = :university,
                   updated_at = NOW()
             WHERE id = :id
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute($this->toParameters($dto));

        $updatedStudent = $this->getById(new StudentId($dto->id()));

        if ($updatedStudent === null) {
            throw new RuntimeException('The student could not be recovered after update.');
        }

        return $updatedStudent;
    }

    public function getById(StudentId $studentId): ?StudentModel
    {
        $sql = '
            SELECT
                id,
                name,
                last_name,
                birth_date,
                semester,
                email,
                gender,
                phone,
                program,
                university,
                created_at,
                updated_at
            FROM students
            WHERE id = :id
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $studentId->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getByEmail(StudentEmail $email): ?StudentModel
    {
        $sql = '
            SELECT
                id,
                name,
                last_name,
                birth_date,
                semester,
                email,
                gender,
                phone,
                program,
                university,
                created_at,
                updated_at
            FROM students
            WHERE email = :email
            LIMIT 1
        ';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':email' => $email->value(),
        ));

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    /**
     * @return StudentModel[]
     */
    public function getAll(): array
    {
        $sql = '
            SELECT
                id,
                name,
                last_name,
                birth_date,
                semester,
                email,
                gender,
                phone,
                program,
                university,
                created_at,
                updated_at
            FROM students
            ORDER BY last_name ASC, name ASC
        ';

        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();

        return $this->mapper->fromRowsToModels($rows);
    }

    public function delete(StudentId $studentId): void
    {
        $sql = 'DELETE FROM students WHERE id = :id';

        $statement = $this->pdo->prepare($sql);
        $statement->execute(array(
            ':id' => $studentId->value(),
        ));
    }

    /**
     * @return array<string, string>
     */
    private function toParameters(StudentPersistenceDto $dto): array
    {
        return array(
            ':id' => $dto->id(),
            ':name' => $dto->name(),
            ':last_name' => $dto->lastName(),
            ':birth_date' => $dto->birthDate(),
            ':semester' => $dto->semester(),
            ':email' => $dto->email(),
            ':gender' => $dto->gender(),
            ':phone' => $dto->phone(),
            ':program' => $dto->program(),
            ':university' => $dto->university(),
        );
    }
}
