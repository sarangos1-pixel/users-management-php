<?php

declare(strict_types=1);

/**
 * Pruebas automáticas del módulo Estudiante (sin dependencias externas).
 *
 * Se ejecutan con:   php tests/run.php
 * Terminan con código 0 si todo pasa y con código 1 si algo falla,
 * que es lo que necesita GitHub Actions para marcar el job en rojo o verde.
 *
 * Qué se prueba:
 *   1. Dominio:     reglas de validación de los Value Objects y del modelo.
 *   2. Aplicación:  casos de uso (crear, consultar, actualizar, eliminar)
 *                   usando un repositorio en memoria en vez de MySQL.
 */

require_once __DIR__ . '/../Common/ClassLoader.php';
ClassLoader::register();

// Mini framework de pruebas

$passed = 0;
$failed = 0;

function check(string $name, bool $condition): void
{
    global $passed, $failed;

    if ($condition) {
        $passed++;
        echo "  OK    {$name}\n";
        return;
    }

    $failed++;
    echo "  FALLO {$name}\n";
}

/**
 * Comprueba que ejecutar $action lance una excepción de la clase indicada.
 */
function checkThrows(string $name, string $exceptionClass, callable $action): void
{
    try {
        $action();
        check($name . ' (no lanzó excepción)', false);
    } catch (Throwable $e) {
        check($name, $e instanceof $exceptionClass);
    }
}

function section(string $title): void
{
    echo "\n{$title}\n";
}

// Repositorio en memoria: implementa los puertos de salida

final class InMemoryStudentRepository implements
    SaveStudentPort,
    UpdateStudentPort,
    GetStudentByIdPort,
    GetStudentByEmailPort,
    GetAllStudentsPort,
    DeleteStudentPort
{
    /** @var array<string, StudentModel> */
    public array $rows = array();

    public function save(StudentModel $student): StudentModel
    {
        $this->rows[$student->id()->value()] = $student;
        return $student;
    }

    public function update(StudentModel $student): StudentModel
    {
        $this->rows[$student->id()->value()] = $student;
        return $student;
    }

    public function getById(StudentId $studentId): ?StudentModel
    {
        return $this->rows[$studentId->value()] ?? null;
    }

    public function getByEmail(StudentEmail $email): ?StudentModel
    {
        foreach ($this->rows as $student) {
            if ($student->email()->equals($email)) {
                return $student;
            }
        }

        return null;
    }

    public function getAll(): array
    {
        return array_values($this->rows);
    }

    public function delete(StudentId $studentId): void
    {
        unset($this->rows[$studentId->value()]);
    }
}

function newStudent(array $overrides = array()): StudentModel
{
    $data = array_merge(array(
        'id' => '1',
        'name' => 'Sebastian',
        'lastName' => 'Arango',
        'birthDate' => '2003-05-17',
        'semester' => '5',
        'email' => 'Seb@Mail.com',
        'gender' => 'MALE',
        'phone' => '(300) 123-4567',
        'program' => 'Ingenieria de Sistemas',
        'university' => 'Universidad Ejemplo',
    ), $overrides);

    return StudentModel::create(
        new StudentId($data['id']),
        new StudentName($data['name']),
        new StudentLastName($data['lastName']),
        new StudentBirthDate($data['birthDate']),
        new StudentSemester($data['semester']),
        new StudentEmail($data['email']),
        $data['gender'],
        new StudentPhone($data['phone']),
        new StudentProgram($data['program']),
        new StudentUniversity($data['university'])
    );
}

// 1. DOMINIO

section('Dominio: modelo y normalización');

$student = newStudent();
check('el correo se guarda en minúsculas', $student->email()->value() === 'seb@mail.com');
check('el teléfono se guarda sin espacios ni símbolos', $student->phone()->value() === '3001234567');
check('el semestre es un entero', $student->semester()->value() === 5);
check('toArray devuelve el apellido', $student->toArray()['lastName'] === 'Arango');

$changed = $student->changeName(new StudentName('Carlos'));
check('el modelo es inmutable: el original no cambia', $student->name()->value() === 'Sebastian');
check('el modelo es inmutable: la copia sí cambia', $changed->name()->value() === 'Carlos');
check('advanceSemester suma un semestre', $student->advanceSemester()->semester()->value() === 6);

section('Dominio: validaciones');

checkThrows('nombre vacío', InvalidStudentNameException::class, fn() => new StudentName('  '));
checkThrows('nombre de 1 letra', InvalidStudentNameException::class, fn() => new StudentName('A'));
checkThrows('nombre de más de 100 caracteres', InvalidStudentNameException::class, fn() => new StudentName(str_repeat('a', 101)));
checkThrows('apellido vacío', InvalidStudentLastNameException::class, fn() => new StudentLastName(''));
checkThrows('correo sin formato válido', InvalidStudentEmailException::class, fn() => new StudentEmail('no-es-un-correo'));
checkThrows('teléfono con letras', InvalidStudentPhoneException::class, fn() => new StudentPhone('abc123'));
checkThrows('teléfono demasiado corto', InvalidStudentPhoneException::class, fn() => new StudentPhone('12345'));
checkThrows('fecha con formato incorrecto', InvalidStudentBirthDateException::class, fn() => new StudentBirthDate('17/05/2003'));
checkThrows('fecha inexistente (31 de febrero)', InvalidStudentBirthDateException::class, fn() => new StudentBirthDate('2003-02-31'));
checkThrows('fecha en el futuro', InvalidStudentBirthDateException::class, fn() => new StudentBirthDate('2999-01-01'));
checkThrows('fecha de hace más de 120 años', InvalidStudentBirthDateException::class, fn() => new StudentBirthDate('1800-01-01'));
checkThrows('semestre 0', InvalidStudentSemesterException::class, fn() => new StudentSemester('0'));
checkThrows('semestre 13', InvalidStudentSemesterException::class, fn() => new StudentSemester('13'));
checkThrows('semestre no numérico', InvalidStudentSemesterException::class, fn() => new StudentSemester('cinco'));
checkThrows('programa vacío', InvalidStudentProgramException::class, fn() => new StudentProgram(''));
checkThrows('universidad vacía', InvalidStudentUniversityException::class, fn() => new StudentUniversity(''));
checkThrows('género inválido', InvalidStudentGenderException::class, fn() => newStudent(array('gender' => 'X')));
checkThrows('no se puede avanzar del semestre 12', InvalidStudentSemesterException::class, fn() => newStudent(array('semester' => '12'))->advanceSemester());

// 2. APLICACIÓN (casos de uso con repositorio en memoria)

section('Aplicación: casos de uso');

$repository = new InMemoryStudentRepository();
$create = new CreateStudentService($repository, $repository);
$update = new UpdateStudentService($repository, $repository, $repository);
$getById = new GetStudentByIdService($repository);
$getAll = new GetAllStudentsService($repository);
$delete = new DeleteStudentService($repository, $repository);

$newCommand = static function (string $id, string $email): CreateStudentCommand {
    return new CreateStudentCommand(
        $id, 'Sebastian', 'Arango', '2003-05-17', '5', $email,
        'MALE', '3001234567', 'Sistemas', 'Universidad Ejemplo'
    );
};

$created = $create->execute($newCommand('1', 'a@a.com'));
check('crear: devuelve el estudiante guardado', $created->email()->value() === 'a@a.com');
check('crear: queda en el repositorio', count($repository->rows) === 1);

checkThrows('crear: rechaza un correo repetido', StudentAlreadyExistsException::class, fn() => $create->execute($newCommand('2', 'A@a.com')));
checkThrows('crear: rechaza datos inválidos', InvalidStudentSemesterException::class, fn() => $create->execute(new CreateStudentCommand(
    '3', 'Ana', 'Ruiz', '2003-05-17', '99', 'b@b.com', 'FEMALE', '3001234567', 'X', 'Y'
)));

check('consultar por id', $getById->execute(new GetStudentByIdQuery('1'))->name()->value() === 'Sebastian');
checkThrows('consultar: id inexistente', StudentNotFoundException::class, fn() => $getById->execute(new GetStudentByIdQuery('99')));
check('listar: devuelve 1 estudiante', count($getAll->execute(new GetAllStudentsQuery())) === 1);

$update->execute(new UpdateStudentCommand(
    '1', 'Seb', 'Arango', '2003-05-17', '6', 'a@a.com',
    'MALE', '3001234567', 'Sistemas', 'Otra Universidad'
));
$updated = $getById->execute(new GetStudentByIdQuery('1'));
check('actualizar: cambia el nombre', $updated->name()->value() === 'Seb');
check('actualizar: cambia el semestre', $updated->semester()->value() === 6);
checkThrows('actualizar: id inexistente', StudentNotFoundException::class, fn() => $update->execute(new UpdateStudentCommand(
    '77', 'Seb', 'Arango', '2003-05-17', '6', 'z@z.com', 'MALE', '3001234567', 'S', 'U'
)));

$create->execute($newCommand('2', 'c@c.com'));
checkThrows('actualizar: rechaza el correo de otro estudiante', StudentAlreadyExistsException::class, fn() => $update->execute(new UpdateStudentCommand(
    '2', 'Seb', 'Arango', '2003-05-17', '6', 'a@a.com', 'MALE', '3001234567', 'S', 'U'
)));

$delete->execute(new DeleteStudentCommand('2'));
check('eliminar: lo quita del repositorio', count($repository->rows) === 1);
checkThrows('eliminar: id inexistente', StudentNotFoundException::class, fn() => $delete->execute(new DeleteStudentCommand('2')));

// Resultado

echo "\n----------------------------------------\n";
echo "Pasaron: {$passed}   Fallaron: {$failed}\n";

exit($failed === 0 ? 0 : 1);