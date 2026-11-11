<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Detalle de estudiante</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<table class="detail-table">
    <tr>
        <th>ID</th>
        <td><?= htmlspecialchars($student->getId(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Nombre</th>
        <td><?= htmlspecialchars($student->getName(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Apellido</th>
        <td><?= htmlspecialchars($student->getLastName(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Fecha de nacimiento</th>
        <td><?= htmlspecialchars($student->getBirthDate(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Semestre</th>
        <td><?= htmlspecialchars($student->getSemester(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Correo</th>
        <td><?= htmlspecialchars($student->getEmail(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Género</th>
        <td><?= htmlspecialchars($genderLabels[$student->getGender()] ?? $student->getGender(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Teléfono</th>
        <td><?= htmlspecialchars($student->getPhone(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Programa</th>
        <td><?= htmlspecialchars($student->getProgram(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
    <tr>
        <th>Universidad</th>
        <td><?= htmlspecialchars($student->getUniversity(), ENT_QUOTES, 'UTF-8') ?></td>
    </tr>
</table>

<p style="margin-top: 16px;">
    <a class="btn btn-warning" href="?route=students.edit&amp;id=<?= urlencode($student->getId()) ?>">Editar</a>
    &nbsp;
    <a class="btn" href="?route=students.index">Volver al listado</a>
</p>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
