<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">           
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="bgc-white bd bdrs-3 p-20">
                    <h4 class="c-grey-900 mB-20"><span style="color: red">Tours Insert</span>
                        <a href="<?=base_url('tours');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Back</a>
                    </h4>




                    <?=form_open_multipart('tours/insert_form');?>
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <?= form_input(['class'=>'form-control', 'id'=>'title', 'name'=>'title']);?>
                                <?=form_error('title');?>
                            </div>
                            <div class="form-group">
                                <label for="des">Description</label>
                                <textarea name="des" id="des" cols="30" rows="5" class="form-control"></textarea>
                                <?=form_error('des');?>
                            </div>
                            <div class="form-group">
                                <label for="select_category">Select Category</label>
                                <select name="select_category" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php if(count($category)): ?>
                                        <?php foreach($category as $c):?>
                                            <option value="<?=$c->category_id;?>"><?=$c->category_name;?></option>
                                        <?php endforeach;?>
                                    <?php endif;?>
                                </select>
                                <?= form_error('select_category');?>
                            </div>
                            <div class="form-group">
                                <label for="select_city">Select City</label>
                                <select name="select_city" class="form-control">
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
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control">
                                <?= form_error('price');?>
                            </div>
                            <div class="form-group">
                                <label for="images">Images</label>
                                <?=form_upload(['type'=>'file', 'name'=>'userFiles[]', 'multiple'=>'multiple']);?>
                                <?= form_error('userFiles');?>
                            </div>    
                                <?= form_submit(['type'=>'submit','name'=>'submit', 'class'=>'btn btn-default', 'value'=>'Insert']);?>
                            </div>
                            </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</main>