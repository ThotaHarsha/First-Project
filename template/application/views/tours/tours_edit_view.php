 <!-- ### $App Screen Content ### -->
 <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">


<?PHP if($this->session->flashdata('failed')){?>
<div class="alert alert-danger">
<strong>Oops!</strong> <?= $this->session->flashdata('failed'); ?>
</div>
<?PHP } ?>


<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20">
        <h4 class="c-grey-900 mB-20"><span style="color:red;">Tours Edit<san>
            <a href="<?=base_url('tours');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Back</a>
        </h4>




        <?=form_open();?>
        <div class="col-lg-6">
                <div class="form-group">
                    <label for="title">Title</label>
                    <?= form_input(['class'=>'form-control', 'id'=>'title', 'name'=>'title', 'value'=>set_value('title',$tours->title)]);?>
                    <?=form_error('title');?>
                </div>
                <div class="form-group">
                    <label for="des">Description</label></br>
                    <?=form_textarea(['class'=>'form-control', 'name'=>'des', 'id'=>'des', 'cols'=>"30", 'rows'=>'5', 'value'=>set_value('des',$tours->des)]);?>
                    <?=form_error('des');?>
                </div>
                <div class="form-group">
                    <label for="select_city">Select City</label>
                    <select name="select_city" class="form-control">
                        <option value="">Select City</option>
                        <?php if(count($cities)): ?>
                            <?php foreach($cities as $city):


                                $selected="";
                                if($city->city_id == $tours->city_id):
                                    $selected="selected='select'";
                                endif;
                            ?>  
                                <option value="<?=$city->city_id; ?>" <?=$selected?>><?=$city->name;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    <?= form_error('select_city');?>
                </div>
                <div class="form-group">
                    <label for="select_category">Select Category</label>
                    <select name="select_category" class="form-control">
                        <option value="">Select Category</option>
                        <?php if(count($category)): ?>
                            <?php foreach($category as $c):
                                $selected="";
                                if($c->category_id == $tours->category_id):
                                    $selected="selected='select'";
                                endif;
                            ?>  
                                <option value="<?=$c->category_id; ?>" <?=$selected?>><?=$c->category_name;?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    </select>
                    <?= form_error('select_category');?>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" value="<?=$tours->price; ?>">
                        <?= form_error('price');?>
                    </div>
                    <input type="hidden" name="tour_id" id="tour_id" value="<?=$tours->tour_id?>">
                    <?= form_submit(['type'=>'submit','name'=>'submit', 'class'=>'btn btn-default', 'value'=>'Update']);?>
                </div>
                </div>
                </div>
            </div>

            </div>
        </div>
        </div>
    </div>
</main>