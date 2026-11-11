<?php require __DIR__ . '/../layouts/header.php'; ?>
<?php require __DIR__ . '/../layouts/menu.php'; ?>

<h1>Registrar estudiante</h1>

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

<form method="POST" action="?route=students.store">

    <div class="form-group">
        <label for="name">Nombre</label><br>
        <input type="text" id="name" name="name"
            value="<?= htmlspecialchars($old['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['name'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="lastName">Apellido</label><br>
        <input type="text" id="lastName" name="lastName"
            value="<?= htmlspecialchars($old['lastName'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['lastName'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['lastName'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="birthDate">Fecha de nacimiento</label><br>
        <input type="date" id="birthDate" name="birthDate" max="<?= date('Y-m-d') ?>"
            value="<?= htmlspecialchars($old['birthDate'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['birthDate'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['birthDate'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="semester">Semestre</label><br>
        <input type="number" id="semester" name="semester" min="1" max="12"
            value="<?= htmlspecialchars($old['semester'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['semester'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['semester'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="email">Correo</label><br>
        <input type="email" id="email" name="email"
            value="<?= htmlspecialchars($old['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['email'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="gender">Género</label><br>
        <select id="gender" name="gender">
            <?php foreach ($genderLabels as $value => $label): ?>
                <option value="<?= htmlspecialchars($value, ENT_QUOTES, 'UTF-8') ?>" <?= ($old['gender'] ?? '' === $value) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if (!empty($errors['gender'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['gender'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="phone">Teléfono</label><br>
        <input type="tel" id="phone" name="phone"
            value="<?= htmlspecialchars($old['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['phone'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['phone'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="program">Programa</label><br>
        <input type="text" id="program" name="program"
            value="<?= htmlspecialchars($old['program'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['program'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['program'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="form-group">
        <label for="university">Universidad</label><br>
        <input type="text" id="university" name="university"
            value="<?= htmlspecialchars($old['university'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
        <?php if (!empty($errors['university'])): ?>
            <div class="field-error"><?= htmlspecialchars($errors['university'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Registrar estudiante</button>
    &nbsp;
    <a class="btn" href="?route=students.index">Cancelar</a>
</form>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
