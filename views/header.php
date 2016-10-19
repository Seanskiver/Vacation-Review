<!DOCTYPE html>
<html>
    <head>
        <?php // Get all CSS files and place them in the footer ?>
        <?php $slim_dir = array_diff( scandir( $_SERVER['DOCUMENT_ROOT'].'/css' ), Array( ".", ".." ) );  ?>
        
        <?php foreach (($slim_dir) as $file) : ?>
            <?php // dont include . and .. hidden directories ?>
            <?php if ($file != '.' && $file != '..') : ?>
                <script src="../css/<?= $file ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    </head>
    <body>
        