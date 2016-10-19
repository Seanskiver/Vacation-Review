    <?php $slim_dir = array_diff( scandir( $_SERVER['DOCUMENT_ROOT'].'/js' ), Array( ".", ".." ) );  ?>
    
    <?php print_r($slim_dir); ?>
    
    <?php foreach (scandir($_SERVER['DOCUMENT_ROOT'].'/js') as $file) : ?>
        <?php // dont include . and .. hidden directories ?>
        <?php if ($file != '.' && $file != '..') : ?>
            <script src="../js/<?= $file ?>"></script>
        <?php endif; ?>
    <?php endforeach; ?>
    </body>
</html>