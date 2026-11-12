<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Lista de estudiantes</h1>

<?php if (!empty($message)): ?>
    <div class="alert-error">
        <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <div class="alert-success">
        <?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8') ?>
    </div>
<?php endif; ?>

<?php if (empty($students)): ?>
    <p>No hay estudiantes registrados todavía.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Nombre completo</th>
                <th>Programa</th>
                <th>Semestre</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student->getFullName(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->getProgram(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->getSemester(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->getEmail(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->getPhone(), ENT_QUOTES, 'UTF-8') ?></td>
                    <td class="col-actions">
                        <a class="btn btn-sm" href="?route=students.show&amp;id=<?= urlencode($student->getId()) ?>">Ver</a>
                        <a class="btn btn-warning btn-sm"
                            href="?route=students.edit&amp;id=<?= urlencode($student->getId()) ?>">Editar</a>
                        <form method="POST" action="?route=students.delete" style="display:inline;"
                            onsubmit="return confirmDelete(this);"
                            data-entity="estudiante"
                            data-name="<?= htmlspecialchars($student->getFullName(), ENT_QUOTES, 'UTF-8') ?>">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($student->getId(), ENT_QUOTES, 'UTF-8') ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
