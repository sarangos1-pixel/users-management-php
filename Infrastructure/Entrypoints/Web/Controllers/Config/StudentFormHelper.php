<?php

declare(strict_types=1);

require_once __DIR__ . '/../../Presentation/Flash.php';
require_once __DIR__ . '/../../../../../Domain/Enums/StudentGenderEnum.php';

/**
 * Lee y valida los formularios web de Estudiante y arma los datos de cada vista.
 * Las reglas replican las del dominio para mostrar mensajes claros
 * antes de llegar a la capa de aplicación.
 */
final class StudentFormHelper
{
    /**
     * @return array<string, string>
     */
    public static function createFormData(): array
    {
        return array(
            'name' => self::post('name'),
            'lastName' => self::post('lastName'),
            'birthDate' => self::post('birthDate'),
            'semester' => self::post('semester'),
            'email' => self::post('email'),
            'gender' => self::post('gender'),
            'phone' => self::post('phone'),
            'program' => self::post('program'),
            'university' => self::post('university'),
        );
    }

    /**
     * @return array<string, string>
     */
    public static function updateFormData(): array
    {
        return array_merge(array('id' => self::post('id')), self::createFormData());
    }

    /**
     * @param array<string, string> $form
     * @return array<string, string>
     */
    public static function validate(array $form): array
    {
        $errors = array();

        self::validateText($errors, $form, 'name', 'El nombre', 2, 100);
        self::validateText($errors, $form, 'lastName', 'El apellido', 2, 100);
        self::validateText($errors, $form, 'program', 'El programa', 1, 100);
        self::validateText($errors, $form, 'university', 'La universidad', 1, 150, true);

        if ($form['birthDate'] === '') {
            $errors['birthDate'] = 'La fecha de nacimiento es obligatoria.';
        } else {
            $date = DateTimeImmutable::createFromFormat('!Y-m-d', $form['birthDate']);

            if ($date === false || $date->format('Y-m-d') !== $form['birthDate']) {
                $errors['birthDate'] = 'La fecha de nacimiento no es válida (formato AAAA-MM-DD).';
            } elseif ($date > new DateTimeImmutable('today')) {
                $errors['birthDate'] = 'La fecha de nacimiento no puede estar en el futuro.';
            } elseif ($date < (new DateTimeImmutable('today'))->modify('-120 years')) {
                $errors['birthDate'] = 'La fecha de nacimiento implica una edad mayor a 120 años.';
            }
        }

        if ($form['semester'] === '') {
            $errors['semester'] = 'El semestre es obligatorio.';
        } elseif (!ctype_digit($form['semester']) || (int) $form['semester'] < 1 || (int) $form['semester'] > 12) {
            $errors['semester'] = 'El semestre debe ser un número entero entre 1 y 12.';
        }

        if ($form['email'] === '') {
            $errors['email'] = 'El correo es obligatorio.';
        } elseif (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'El correo no tiene un formato válido.';
        } elseif (strlen($form['email']) > 150) {
            $errors['email'] = 'El correo no puede superar 150 caracteres.';
        }

        if (!StudentGenderEnum::isValid($form['gender'])) {
            $errors['gender'] = 'Selecciona un género válido.';
        }

        if ($form['phone'] === '') {
            $errors['phone'] = 'El teléfono es obligatorio.';
        } else {
            $normalized = (string) preg_replace('/[\\s\\-\\.\\(\\)]/', '', $form['phone']);

            if (preg_match('/^\\+?[0-9]{7,15}$/', $normalized) !== 1) {
                $errors['phone'] = 'El teléfono debe tener entre 7 y 15 dígitos.';
            }
        }

        return $errors;
    }

    /**
     * @return array<string, string>
     */
    public static function genderLabels(): array
    {
        return array(
            StudentGenderEnum::MALE => 'Masculino',
            StudentGenderEnum::FEMALE => 'Femenino',
            StudentGenderEnum::OTHER => 'Otro',
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function createViewData(): array
    {
        return array(
            'pageTitle' => 'Registrar estudiante',
            'genderLabels' => self::genderLabels(),
            'message' => Flash::message(),
            'success' => Flash::success(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function editViewData(StudentResponse $student): array
    {
        return array(
            'pageTitle' => 'Editar estudiante',
            'student' => $student,
            'genderLabels' => self::genderLabels(),
            'message' => Flash::message(),
            'errors' => Flash::errors(),
            'old' => Flash::old(),
        );
    }

    /**
     * @param StudentResponse[] $students
     * @return array<string, mixed>
     */
    public static function listViewData(array $students): array
    {
        return array(
            'pageTitle' => 'Lista de estudiantes',
            'students' => $students,
            'genderLabels' => self::genderLabels(),
            'message' => Flash::message(),
            'success' => Flash::success(),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public static function showViewData(StudentResponse $student): array
    {
        return array(
            'pageTitle' => 'Detalle de estudiante',
            'student' => $student,
            'genderLabels' => self::genderLabels(),
            'message' => Flash::message(),
        );
    }

    private static function post(string $key): string
    {
        return isset($_POST[$key]) ? trim((string) $_POST[$key]) : '';
    }

    /**
     * @param array<string, string> $errors
     * @param array<string, string> $form
     */
    private static function validateText(array &$errors, array $form, string $key, string $label, int $min, int $max, bool $feminine = false): void
    {
        $length = mb_strlen($form[$key]);

        if ($form[$key] === '') {
            $errors[$key] = $label . ($feminine ? ' es obligatoria.' : ' es obligatorio.');
        } elseif ($length < $min) {
            $errors[$key] = $label . ' debe tener al menos ' . $min . ' caracteres.';
        } elseif ($length > $max) {
            $errors[$key] = $label . ' no puede superar ' . $max . ' caracteres.';
        }
    }
}
