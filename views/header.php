<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" />
        <?php // Get all CSS files and place them in the footer ?>
        <?php $slim_dir = array_diff( scandir( $_SERVER['DOCUMENT_ROOT'].'/css' ), Array( ".", ".." ) );  ?>
        
        <?php foreach (($slim_dir) as $file) : ?>
            <?php // dont include . and .. hidden directories ?>
            <?php if ($file != '.' && $file != '..') : ?>
                <link rel="stylesheet" href="../css/<?= $file ?>"></script>
            <?php endif; ?>
        <?php endforeach; ?>
    </head>
    <body>
    <?php include 'nav.php'; ?>