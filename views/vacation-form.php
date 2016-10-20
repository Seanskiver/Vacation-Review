<form method="POST" action="." enctype="multipart/form-data">
    <input type="hidden" name="action" value="post_vacation" />
    
    <label>name</label><br>
    <input type="text" name="name"><br><br>
    
    <label for="description">Description</label><br>
    <input type="text" name="description"><br><br>
    
    <label for="img_upload">Image: </label><br>
    <input type="file" name="img_upload" /><br><br>
    <input type="submit" value="Submit"/>
</form>

<?php if (isset($error)) : ?>
    <span class="error"><?= $error ?></span>
<?php endif; ?>

<?php if (isset($exists)) : ?>
    <span>That vacation spot already exists </span>
    <a href=".?action=view_vacation&vacId=<?= $exists['id'] ?>">review it now</a> 
<?php endif; ?>