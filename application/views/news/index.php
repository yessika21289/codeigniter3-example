<a href="/news/create" class="btn btn-info" role="button">Add news</a>
<a href="/authors/report" class="btn btn-default" role="button">Authors Report</a>
<?php foreach ($news as $news_item): ?>
    <div class="row">
        <div class="col-lg-8">

            <!-- the actual news item: title/author/date/content -->
            <h1>
                <a href="<?php echo site_url('news/'.$news_item['id']); ?>"><?php echo $news_item['title']; ?></a>
            </h1>
            <p class="lead">
                <i class="fa fa-user"></i> by <?= isset($news_item['name']) ? $news_item['name'] : 'Unknown' ?>
            </p>
            <hr>
            <p>
                <i class="fa fa-calendar"></i> Posted on <?= isset($news_item['posted_on']) ? date('M d, Y H:i:s', $news_item['posted_on']) : 'Unknown' ?>
            </p>
            <hr>
            <p class="lead"><?php echo $news_item['text']; ?></p>
            <br/>
        </div>
    </div>
<?php endforeach; ?>
