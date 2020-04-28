<form
    method="<?= $form->getMethod(); ?>"
    <?php if (!empty($form->getName())) : ?>
        id="<?= $form->getName(); ?>"
    <?php endif; ?>
    action="<?= $form->getTarget(); ?>"
    <?php if (!empty($form->getClass())) : ?>
        class="<?= $form->getClass() ?>"
    <?php endif; ?>
>
    <?php foreach($form->getElements() as $Element) : ?>
    <?php
        $name = $Element->getName();
        $label = $Element->getLabel();
        $type = $Element->getType();
        $class = $Element->getClass();
        $placeholder = $Element->getPlaceholder();
        $errors = $Element->getErrors();
    ?>
    <div
        class="<?= !empty($errors) ? 'form-errors ' : ''?>+
        form-wrapper"
    >
        <?php if($Element->isSelect()) : ?>
            <?php require(__DIR__. '/FormElements/select.php'); ?>
        <?php elseif($type === 'textarea') : ?>
            <?php require(__DIR__. '/FormElements/textarea.php'); ?>
        <?php elseif($type === 'button') : ?>
            <?php require(__DIR__. '/FormElements/button.php'); ?>
        <?php else : ?>
            <?php require(__DIR__.'/FormElements/input.php'); ?>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</form>