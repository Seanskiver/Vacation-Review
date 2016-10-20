    <?php $slim_dir = array_diff( scandir( $_SERVER['DOCUMENT_ROOT'].'/js' ), Array( ".", ".." ) );  ?>
    
    <?php foreach (scandir($_SERVER['DOCUMENT_ROOT'].'/js') as $file) : ?>
        <?php // dont include . and .. hidden directories ?>
        <?php if ($file != '.' && $file != '..') : ?>
            <script src="../js/<?= $file ?>"></script>
        <?php endif; ?>
    <?php endforeach; ?>
    
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- RateYo! CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.css">
    <!-- RateYo! JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.2.0/jquery.rateyo.min.js"></script>
    </body>
</html>