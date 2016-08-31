    <div class="row">
        <div class="col-lg-8">
            <p class="lead">
                <i class="fa fa-user"></i> by <?= isset($news_item['name']) ? $news_item['name'] : 'Unknown' ?>
            </p>
            <hr>
            <p>
                <i class="fa fa-calendar"></i> Posted on <?= isset($news_item['posted_on']) ? date('M d, Y H:i:s', $news_item['posted_on']) : 'Unknown' ?>
            </p>
            <hr>
            <p class="lead"><?=$news_item['text']?></p>
            <a href="/news" class="btn btn-link" role="button">Home</a>
        </div>
    </div>
