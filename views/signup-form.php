
<h4>Sign up</h4>

<form class="" action="." method="POST">
    <input type="hidden" name="action" value="signup">
    
    <label for="username">Username</label><br>
    <input name="username" id="username" type="text" class="validate" value="<?php echo htmlspecialchars($username);?>">
    
    <?= $fields->getField('username')->getHTML(); ?>
    <div id="usernameErr"><?= $fields->getField('userError')->getHTML(); ?></div><br>
    
    <label for="password">Password</label><br>
    <input name="password" id="password" type="password" class="validate"><br>
    <?= $fields->getField('password')->getHTML(); ?><br>

    <label for="password_verify">Verify Password</label><br>    
    <input name="password_verify" id="verify" type="password" class="validate"><br><br>
    <?= $fields->getField('password_verify')->getHTML(); ?>
    
    <input style="margin-bottom: 20px;" id="submit" type="submit" name="submit" value="submit" class="btn"/>
</form>
