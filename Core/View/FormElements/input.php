<?php if ($type === 'checkbox') : ?>
    <input
            type="<?= $type?>"
            name="<?=$name; ?>"
            id="<?=$name; ?>"
        <?php if (!empty($class)) : ?>
            class="<?= $class; ?>"
        <?php endif; ?>
        <?php if (!empty($placeholder)) : ?>
            placeholder="<?=$placeholder; ?>"
        <?php endif; ?>
            value="<?=$Element->getValue(); ?>"
        <?= (bool)$Element->getDisabled() ? 'disabled' : '' ?>
    >
    <?php if (!empty($label) && $type !== 'hidden') : ?>
        <label for="<?= $name; ?>"><?= $label; ?></label>
    <?php endif; ?>
<?php else : ?>
    <?php if (!empty($label) && $type !== 'hidden') : ?>
        <label for="<?= $name; ?>"><?= $label; ?></label>
    <?php endif; ?>
    <input
        type="<?= $type?>"
        name="<?=$name; ?>"
        id="<?=$name; ?>"
        <?php if (!empty($class)) : ?>
            class="<?= $class; ?>"
        <?php endif; ?>
        <?php if ($type === "file") : //TODO: if you don't rework this hack - please fix it!?>
            accept=".csv"
        <?php endif; ?>
        <?php if (!empty($placeholder)) : ?>
            placeholder="<?=$placeholder; ?>"
        <?php endif; ?>
        value="<?=$Element->getValue(); ?>"
        <?= (bool)$Element->getDisabled() ? 'disabled' : '' ?>
    >
<?php endif; ?>