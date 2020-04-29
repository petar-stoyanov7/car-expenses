</main>
<footer>
Copyright pest media. All wrongs reserved.
</footer>
<?php if (isset($jsArray) && count($jsArray) > 0) : ?>
    <?php foreach($jsArray as $jsFile) : ?>
        <script src="/js/<?=$jsFile?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</html>