<?php
/**
 * Author Register Page
 * Created by PhpStorm.
 * User: Yessika
 * Date: 31/08/2016
 * Time: 22:40
 */

$errors = validation_errors();
if (!empty($errors)) {
    echo "<div class='alert alert-danger' role='alert'>
        <strong>".$errors."</strong>
    </div><hr/>";
}

?>
<div class="row">
    <div class="col-md-8">
        <?php echo form_open(site_url('authors/register'), array('id' => 'create_frm', 'name' => 'create_frm', 'class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label for="email" class="control-label col-md-3">
                Name<small style="color: red">*</small>
            </label>
            <div class="col-md-9"><input type="text" name="name" id="name" class="form-control"
                                          value="<?php echo set_value('name'); ?>" placeholder="Your name..."/>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="control-label col-md-3">
                Email<small style="color: red">*</small>
            </label>
            <div class="col-md-9"><input type="text" name="email" id="email" class="form-control"
                                          value="<?php echo set_value('email'); ?>" placeholder=" Email"/>
            </div>
        </div>
        <div class="form-group">
            <label for="text" class="control-label col-md-3">
                Password<small style="color: red">*</small>
            </label>
            <div class="col-md-9"><input type="password" name="password" id="password" class="form-control"
                                          placeholder="Password"/>
                <small style="color: red">(min 6 characters)</small></div>
        </div>
        <div class="form-group">
            <label for="text" class="control-label col-md-3">
                Re-type Password<small style="color: red">*</small>
            </label>
            <div class="col-md-9"><input type="password" name="passconf" id="passconf" class="form-control"
                                          placeholder="Password confirmation"/></div>
        </div>
        <div class="form-group">
            <div class="col-md-3"></div>
            <div class="col-md-9" style="text-align: right">
                <?php echo form_submit('submit', 'Submit', array('class' => 'btn btn-default')) ?>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>