<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
        <?php foreach ($vacations as $v) : ?>
                <div class="card">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-lg-8"><h3 class="card-title">
                                <?= $v['name'] ?></h3>
                                <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                            </div>
                            
                            <div class="col-lg-4">
                                Rating: <?= $v['avg_rating'] ?>
                            </div>
                        </div>
                        
                        
                    </div>
                    
                    <img src="<?= './img/'.$v['img'] ?>" alt="Card image" class="card-image">
                    
                    <div class="card-block">
                        <p class="card-text"><?= $v['description'] ?></p>
                        <a href="/vacation/?action=view_vacation&vacId=<?= $v['id'] ?>" class="card-link"><i class="glyphicon glyphicon-comment"></i>&nbsp;<?= $v['num_reviews'] ?> Reviews</a>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>