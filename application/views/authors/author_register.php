<?php
/**
 * Created by PhpStorm.
 * User: Yessika
 * Date: 31/08/2016
 * Time: 22:40
 */

$errors = validation_errors();
if (!empty($errors)) {
    echo $errors . '<hr/>';
}

?>
<div class="row">
    <div class="col-md-6">
        <?php echo form_open(site_url('authors/register'), array('id' => 'create_frm', 'name' => 'create_frm', 'class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label for="email" class="control-label col-md-2">Name</label>
            <div class="col-md-10"><input type="text" name="name" id="name" class="form-control"
                                          placeholder="Your name..."/>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-md-2">Email</label>
            <div class="col-md-10"><input type="text" name="email" id="email" class="form-control" placeholder="Email"/>
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="control-label col-md-2">Password</label>
            <div class="col-md-10"><input type="password" name="password" id="password" class="form-control"
                                          placeholder="Password"/></div>
        </div>
        <div class="form-group">
            <div class="col-md-10 pull-right">
                <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-default')) ?>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>