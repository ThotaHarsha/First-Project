<h2>Select an Image to Update</h2>

    <div class="">
            <?=form_open_multipart("tours/update_image/{$images->images_id}/{$this->uri->segment(4)}");?>
        <div class="form-group">
            <label for="images">Select Image</label>
            <?=form_upload(['type'=>'file', 'name'=>'userFiles']);?>
        </div>
    </div>   
   
<?= form_submit(['type'=>'submit','name'=>'submit', 'class'=>'btn btn-primary', 'value'=>'Submit']);?>
<?=form_close();?>
