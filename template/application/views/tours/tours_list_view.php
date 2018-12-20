<!-- ### $App Screen Content ### -->
<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">



                <?PHP if($this->session->flashdata('success')){?>
                <div class="alert alert-success">
                <strong>Success!</strong> <?=  $this->session->flashdata('success'); ?>
                </div>
                <?PHP } ?>



                <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
                <div class="row">
                <div class="col-md-12">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20"><span style="color:red";>Tours List</soan>
                        <a href="<?=base_url('tours/insert_form');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Add New</a>
                    </h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>City</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Images</th>	
                                <!-- <th>Image_url</th> -->
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>City</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Images</th>	
                                <!-- <th>Image_url</th> -->
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                            <tbody>
                                <?php if($count != 0): foreach($tours as $t):$this->load->helper('text');?>
                                    <tr id="<?php echo $t->tour_id;?>">
                                        <td><?= $t->title; ?></td>
                                        <td><?= word_limiter($t->des, 10); ?></td>
                                        <td><?= $t->name; ?></td>
                                        <td><?= $t->category_name; ?></td>
                                        <td><?= $t->price; ?></td>
                                        <td><?= anchor("tours/images/{$t->tour_id}", 'Images',['class'=>'btn btn-primary btn-xs']);?></td>
                                        <td>
                                        <?php if($t->status==1){ ?>
                                        <a href="<?= base_url(); ?>tours/change_status?id=<?= $t->tour_id; ?>&status=0" class="btn btn-xs btn-danger">In-Active</a>
                                        <?php }else{ ?>
                                        <a href="<?= base_url(); ?>tours/change_status?id=<?= $t->tour_id; ?>&status=1" class="btn btn-xs btn-success">Active</a>
                                        <?php } ?>
                                        </td>
                                        <td><?=anchor("tours/edit/{$t->tour_id}",'Edit',['class'=>'btn btn-info btn-xs']);?></td>
                                        <td>
                                            <button type="submit" class="btn btn-danger btn-xs remove"> Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach;else:?>
                                <tr>
                                    <td style="text-align:center;" colspan='7'>No data found</td>
                                </tr>
                                <?php endif;?>
                            </tbody>
                        </table>
                        <?=$links;?>
                    </div><!--end of bgc-white bd bdrs-3 p-20 mB-20-->
                </div><!--end of col-md-12-->
            </div><!--end of row-->
        </div><!--end of full container-->
    </div><!--end of main content-->
</main>





<!-- JAVASCRIPT AND AJAX USED TO DELETE HTML ELEMENT -->

<script type="text/javascript">
	$(".remove").click(function(){
		var id = $(this).parents("tr").attr("id");
		//alert(id);
		var url = "<?php echo base_url();?>";

		if(confirm('Are you sure to remove this record ?'))
		{
			$.ajax({
				url: url+'tours/del_tour/'+id,
				type: 'DELETE',
				error: function() {
					alert('Something is wrong');
				},
				success: function(data) {
					$("#"+id).remove();
					alert("Record removed successfully");  
				}
			});
			
		}
	});
</script>
