
<?php foreach ($vac as $v) : ?>
    <h2><?= $v['name'] ?></h2>
    <span>Rating: <?= $v['avg_rating'] ?>/5</span>
    
    <p><?= $v['description'] ?></p>
<?php endforeach; ?>


<hr>

<form method="POST" action=".">
    <input type="hidden" name="action" value="post_review"><br><br>
    <input type="hidden" name="vacId" value="<?= $vac[0]['id'] ?>">
    <label>Title </label><br>
    <select>
        <?php for ($i = 1; $i < 6; $i++) : ?>
            <option><?= $i ?></option>
        <?php endfor; ?>
    </select>
    <input type="text" name="title"/><br><br>
    <label>Description</label><br>
    <textarea name="body"></textarea><br><br>
    <input type="submit" value="Submit"/>
</form>
<span>
    <?php if (isset($error)) echo $error ?>
</span>

<h3>Reviews</h3>
<?php if (empty($reviews)) : ?>
    <span>There aren't any reviews for this vacation spot yet</span>
<?php else : ?>
    <?php foreach ($reviews as $r) : ?>
        <p><?= $r['title'] ?></p>
        <p><?= $r['rating'] ?></p>
        <p></p><?= $r['body']; ?></p>
    <?php endforeach; ?>
<?php endif; ?> 
