<?php
/**
 * Created by PhpStorm.
 * User: Yessika
 * Date: 01/09/2016
 * Time: 0:08
 */
?>
<?php if (!empty($authors_report)): ?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Posts</th>
            <th>Latest Post</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($authors_report as $author): ?>
            <tr>
                <td><?php echo $author['name'] ?></td>
                <td><?php echo $author['email'] ?></td>
                <td><?php echo $author['posts'] ?></td>
                <td>
                    <a href="<?php echo site_url('news/'.$author['news_id']); ?>"><strong><?php echo $author['title']; ?></strong></a>
                    <br/>
                    <small><?php echo !empty($author['posted_on']) ? "on" . date('M d, Y H:i:s', $author['posted_on']) : ''; ?></small>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>