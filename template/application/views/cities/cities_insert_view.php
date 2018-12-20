<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bgc-white bd bdrs-3 p-20">
                        <h4 class="c-grey-900 mB-20"><span style="color:red;">Insert Cities<span>
                            <a href="<?=base_url('cities');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Back</a>
                        </h4>
                        <form action="<?= base_url();?>cities/insert_form" method="post">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label  class="text-normal text-dark">City Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Paris">
                                <?=form_error('name');?>
                            </div>
                            <div class="form-group">
                                <label class="text-normal text-dark">Enter Latitude</label>
                                <input type="text" name="lat" id="lat" class="form-control" placeholder="latitude">
                                <?=form_error('lat');?>
                            </div>
                            <div class="form-group">
                                <label class="text-normal text-dark">Enter Longitude</label>
                                <input type="text" name="lng" id="lng" class="form-control" placeholder="longitude">
                                <?=form_error('lng');?>
                            </div>
                            <div class="form-group">
                                <label class="text-normal text-dark">Enter Status</label>
                                <input type="text" name="status" id="status" class="form-control" placeholder="latitude">
                                <?=form_error('status');?>
                            </div>
                                <button name="submit" value="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>  
                </div>
            </div>
        </div>
</main>