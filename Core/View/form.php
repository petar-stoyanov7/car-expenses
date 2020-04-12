<form
    method="<?= $form->getMethod(); ?>"
    <?php if (!empty($form->getName())) : ?>
        id="<?= $form->getName(); ?>"
    <?php endif; ?>
    target="<?= $form->getTarget(); ?>"
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
    ?>
    <div class="form-wrapper">
        <?php if($Element->isSelect()) : ?>
            <?php if (!empty($label)) : ?>
                <label for="<?= $name; ?>"><?= $label; ?></label>
            <?php endif; ?>
            <select
                    id="<?= $name ?>"
                    name="<?= $name?>"
                    <?php if (!empty($class)) : ?>
                        class="<?= $class; ?>"
                    <?php endif; ?>
            >
                <?php foreach($Element->getOptions() as $index => $option) : ?>
                    <option value="<?= $index; ?>"><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        <?php elseif($type === 'textarea') : ?>
            <textarea
                id="<?= $name; ?>"
                name="<?= $name; ?>"
                <?php if (!empty($class)) : ?>
                    class="<?= $class; ?>"
                <?php endif; ?>
                <?php if (!empty($placeholder)) : ?>
                    placeholder="<?=$placeholder; ?>"
                <?php endif; ?>
            ><?= $Element->getValue(); ?></textarea>
        <?php elseif($type === 'button') : ?>
            <button
                    id="<?= $name; ?>"
                    <?php if (!empty($Element->getButtonType())) : ?>
                        type="<?= $Element->getButtonType() ?>"
                    <?php else : ?>
                        type="submit"
                    <?php endif; ?>
                    <?php if (!empty($Element->getOnClick())) : ?>
                        onclick="<?=$Element->getOnClick() ?>"
                    <?php endif; ?>
                    <?php if (!empty($class)) : ?>
                        class="<?= $class; ?>"
                    <?php endif; ?>

            >
                <?= empty($label) ? $name : $label; ?>
            </button>
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
                <?php if (!empty($placeholder)) : ?>
                    placeholder="<?=$placeholder; ?>"
                <?php endif; ?>
                value="<?=$Element->getValue(); ?>"
                >
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</form>