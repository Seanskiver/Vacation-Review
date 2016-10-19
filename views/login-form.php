<h4>User Login</h4>
    <form class="" action="." method="POST">
    <input type="hidden" name="action" value="login">
    <label for="title">Username</label>
    <input name="username" id="username" type="text" class="validate" value="<?php echo htmlspecialchars($username);?>"><br>
    <?= $fields->getField('username')->getHTML(); ?>
    
    <label for="password">Password</label>
    <input name="password" id="password" type="password" class="validate" value="<?php echo htmlspecialchars($password);?>">
    <?= $fields->getField('password')->getHTML(); ?>
    <?= $fields->getField('userError')->getHTML(); ?>
    
    <input id="submit" type="submit" name="submit" value="submit" class="btn"/>
</form>
