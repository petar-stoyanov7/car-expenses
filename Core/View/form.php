<?php

use Core\Form\Element;
use Core\Form\AbstractForm;

$cace = [];

function renderFormElement(Element $Element)
{
    $name = $Element->getName();
    $label = $Element->getLabel();
    $type = $Element->getType();
    $class = $Element->getClass();
    $placeholder = $Element->getPlaceholder();
    $errors = $Element->getErrors();
    if($Element->isSelect()) {
        require(__DIR__. '/FormElements/select.php');
    } elseif($type === 'textarea') {
        require(__DIR__. '/FormElements/textarea.php');
    } elseif($type === 'button') {
        require(__DIR__. '/FormElements/button.php');
    } else {
        require(__DIR__ . '/FormElements/input.php');
    }
}

function renderElements(array $formElements, AbstractForm $form)
{
    /** TODO: implement grouping! */
    foreach($formElements as $name => $formElement) {
        /** @var Element $Element */
        $Element = $formElement['element'];
        $div = '<div class="form-wrapper';
        if (!empty($Element->getErrors())) {
            $div .= ' form-errors';
        }
        if (!empty($formElement['group'])) {
            $groupName = $formElement['group'];
            if (empty($cache[$groupName])) {
                $group = $form->getGroupElements($groupName);
                $cache[$groupName] = $group;
            } else {
                $group = $cache[$groupName];
            }
            $group = array_keys($group);
            if ($name === $group[0]) {
                $groupId = preg_replace('/[^a-z]/', '', strtolower($groupName));
                $div .= "\" id=\"form-group-{$groupId}\">";
                echo $div;
                renderFormElement($Element);
            } elseif ($name === $group[count($group) - 1]) {
                renderFormElement($Element);
                echo '</div>';
            } else {
                renderFormElement($Element);
            }
        } else {
            $div .= '">';
            echo $div;
            renderFormElement($Element);
            echo '</div>';
        }
    }
}

/** @var AbstractForm $form */
$fieldsetElements = $form->getAllFieldsetElements();
$nonFieldsetElements = $form->getNonFieldsetElements();
?>
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
<?php if (!empty($fieldsetElements)) : ?>
    <?php foreach($fieldsetElements as $fieldsetName => $fieldSetGroup) : ?>
    <?php $fieldsetId = preg_replace('/[^a-z]/', '', strtolower($fieldsetName)); ?>
    <fieldset class="standard-form-fieldset" id="fieldset-<?= $fieldsetId; ?>">
        <legend><?= $fieldsetName; ?></legend>
            <?php renderElements($fieldSetGroup, $form); ?>
    </fieldset>
    <?php endforeach; ?>
<?php endif; ?>

<?php renderElements($nonFieldsetElements, $form); ?>
</form>
