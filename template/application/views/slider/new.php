<!-- ### $App Screen Content ### -->
<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">


                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20">
                        <h4 class="c-grey-900 mB-20"><span style="color:red">Insert Slider Images</span>
                            <a href="<?=base_url('slider');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Back</a>
                        </h4>


                        <!-- tables -->
                        <div class="grid-form">
                            <?PHP if($this->session->flashdata('failed')){?>
                            <div class="alert alert-danger">
                            <strong>Oops!</strong> <?= $this->session->flashdata('failed'); ?>
                            </div>
                            <?PHP } ?>



                            <div class="grid-form1"style="margin-top:35px; margin-left:35px;">
                            <div class="col-lg-6">
                                <?=form_open_multipart();?>
                                    <div class="form-group">
                                        <label for="select_city">Select City</label>
                                        <select name="select_city" class="form-control" >
                                            <option value="">Select City</option>
                                            <?php if(count($cities)): ?>
                                                <?php foreach($cities as $city):?>
                                                    <option value="<?=$city->city_id;?>"><?=$city->name;?></option>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                        </select>
                                        <?= form_error('select_city');?>
                                    </div>
                                    <div class="form-group">
                                        <label for="title">Slider Title</label>
                                        <input type="text" name="title" class="form-control" required="">
                                        <?= form_error('title');?>
                                    </div>
                                    <div class="form-group">
                                        <label for="sub_title">Slider Sub Title</label>
                                        <input type="text" name="sub_title" class="form-control">
                                        <?= form_error('sub_title');?>
                                    </div>
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <input type="file" id="file" name="userfile" class="form-control" onchange="return fileValidation();" />
                                        <span id="img_error" class="text-danger"></span>
                                        <div class="col-md-1" style="padding-top: 30px;">
                                            <img id="blah" width="32" src="#" />
                                        </div>
                                    </div>
                                    
                                    <?= form_submit(['type'=>'submit','name'=>'submit', 'class'=>'btn btn-default', 'value'=>'Submit']);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>



<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type="text/javascript">
    function fileValidation()
    {
        var uploadField = document.getElementById("file");
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        var filePath = uploadField.value;
        //alert(filePath);
        if(!allowedExtensions.exec(filePath)){
            document.getElementById('img_error').innerHTML = 'Please upload file having extensions .jpeg/.jpg/.png/.pdf only.';
            uploadField.value = '';
            return false;
        }
        else{
            if(uploadField.files && uploadField.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
               $('#blah')
                   .attr('src', e.target.result)
                   .width(32)
                   .height(32);
                };

                reader.readAsDataURL(uploadField.files[0]);
            }
        }
        document.getElementById('img_error').innerHTML = "";
    }
</script>