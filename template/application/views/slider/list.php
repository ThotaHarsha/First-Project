  <!-- tables -->
    <?PHP if($this->session->flashdata('success')){?>
    <div class="alert alert-success">
    <strong>Success!</strong> <?=  $this->session->flashdata('success'); ?>
    </div>
    <?PHP } ?>


<h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
<div class="row">
<div class="col-md-12">
    <div class="bgc-white bd bdrs-3 p-20 mB-20">
    <h4 class="c-grey-900 mB-20"><span style="color: red">Slider Images List<span>
        <a href="<?=base_url('Slider/new_slider');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Add New</a>
    </h4>
    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
              <th>Sl No.</th>
              <th>City</th>
              <th>Title</th>
              <th>Sub Title</th>
              <th>Images</th>
              <th>Options</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
              <th>Sl No.</th>
              <th>City</th>
              <th>Title</th>
              <th>Sub Title</th>
              <th>Images</th>
              <th>Options</th>
            </tr>
        </tfoot>
        <tbody>
                <?php $i=1; if(!empty($slider)): foreach($slider as $s):?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $s->name;?></td>
                        <td><?= $s->title;?></td>
                        <td><?= $s->sub_title;?></td>
                        <td><img src="<?="http://experientia.in/".$s->slider_image_url;?>" alt="" class="img img-thumbnail" width="50" height="50"></td>
                        <td>
                            <a href="<?= base_url(); ?>users/edit_user?id=<?= $s->slider_id; ?>" class="btn btn-xs btn-success">Edit</a>
                            <a href="<?= base_url(); ?>users/delete_user?id=<?= $s->slider_id; ?>" class="btn btn-xs btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; else:?>
                <tr>
                    <td style="text-align:center;" colspan='6'>No data found</td>
                </tr>
                <?php endif;?>
            </tbody>
            </table>
        </div>
	</div>
</div>
</div>



    