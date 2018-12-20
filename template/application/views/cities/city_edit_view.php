<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20">
                        <h4 class="c-grey-900 mB-20"><span style="color:red;">Edit Cities<span>
                            <a href="<?=base_url('cities');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Back</a>
                        </h4>
                        <?=form_open("cities/update_city/{$cities->city_id}");?>
                        <div class="col-lg-6">
                                <div class="form-group">
                                    <label  class="text-normal text-dark">City Name</label>
                                    <?= form_input(['class'=>'form-control', 'id'=>'name', 'name'=>'name', 'value'=>set_value('name', $cities->name)]);?>
                                    <?=form_error('name');?>
                                </div>
                                <div class="form-group">
                                    <label class="text-normal text-dark">Enter Latitude</label>
                                    <?= form_input(['class'=>'form-control', 'id'=>'lat', 'name'=>'lat', 'value'=>set_value('lat', $cities->lat)]);?>
                                    <?=form_error('lat');?>
                                </div>
                                <div class="form-group">
                                    <label class="text-normal text-dark">Enter Longitude</label>
                                    <?= form_input(['class'=>'form-control', 'id'=>'lng', 'name'=>'lng', 'value'=>set_value('lng', $cities->lng)]);?>
                                    <?=form_error('lng');?>
                                </div>
                                <div class="form-group">
                                    <label class="text-normal text-dark">Enter Status</label>
                                    <?= form_input(['class'=>'form-control', 'id'=>'status', 'name'=>'status', 'value'=>set_value('status', $cities->status)]);?>
                                    <?=form_error('status');?>
                                </div>
                                    <?= form_submit(['type'=>'submit', 'class'=>'btn btn-default', 'value'=>'Submit']);?>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
</main>
