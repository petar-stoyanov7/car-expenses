</div>
</main>
<div class="bottom-spacer"></div>
<footer>
Copyright pest media. All wrongs reserved.
</footer>
<script src="/js/main.js"></script>
<script src="/js/account.js"></script>
<?php if (isset($jsArray) && count($jsArray) > 0) : ?>
    <?php foreach($jsArray as $jsFile) : ?>
        <script src="/js/<?=$jsFile?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</html>

