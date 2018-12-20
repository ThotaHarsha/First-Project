<h2>Select an Image to Update</h2>
<div class="grid-form1">
        <?=form_open_multipart("slider/update_slider_image/{$images->slider_id}");?>
    <div class="form-group">
        <label for="images">Select Image</label>
        <?=form_upload(['type'=>'file', 'name'=>'userFiles']);?>
    </div>
</div>      
<?= form_submit(['type'=>'submit','name'=>'submit', 'class'=>'btn btn-primary', 'value'=>'Submit']);?>
<?=form_close();?>