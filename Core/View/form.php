<form
    method="<?= $form->getMethod(); ?>"
    id="<?= $form->getName(); ?>"
    target="<?= $form->getTarget(); ?>"
    <?php if (!empty($form->getClass())) : ?>
        class="<?= $form->getClass() ?>"
    <?php endif; ?>
>
    <?php foreach($form->getElements() as $Element) : ?>
    <?php $name = $Element->getName(); ?>
    <div class="form-wrapper">
        <?php if($Element->isSelect()) : ?>
            <?php if (!empty($Element->getLabel())) : ?>
                <label for="<?= $name; ?>"><?= $Element->getLabel(); ?></label>
            <?php endif; ?>
            <select
                    id="<?= $name ?>"
                    name="<?= $name?>"
                    <?php if (!empty($Element->getClass())) : ?>
                        class="<?= $Element->getClass(); ?>"
                    <?php endif; ?>
            >
                <?php foreach($Element->getOptions() as $index => $option) : ?>
                    <option value="<?= $index; ?>"><?= $option ?></option>
                <?php endforeach; ?>
            </select>
        <?php elseif($Element->getType() === 'button') : ?>
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
                    <?php if (!empty($Element->getClass())) : ?>
                        class="<?= $Element->getClass(); ?>"
                    <?php endif; ?>

            >
                <?php
                if (empty($Element->getLabel())) {
                    echo $Element->getLabel();
                } else {
                    echo $name;
                }
                ?>

            </button>
        <?php else : ?>
            <?php if (!empty($Element->getLabel())) : ?>
                <label for="<?= $name; ?>"><?= $Element->getLabel(); ?></label>
            <?php endif; ?>
            <input
                name="<?=$name; ?>"
                id="<?=$name; ?>"
                <?php if (!empty($Element->getClass())) : ?>
                    class="<?= $Element->getClass(); ?>"
                <?php endif; ?>
                value="<?=$Element->getValue(); ?>"
                >
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</form>