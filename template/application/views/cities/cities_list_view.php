<!-- ### $App Screen Content ### -->
<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">

                <?php if ($msg=$this->session->flashdata('msg')):
                $msg_class=$this->session->flashdata('msg_class')
                ?>
                <div class="alert<?$msg_class?>">
                <?=$msg;?>
                </div> 
                <?php endif;?>


                <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
                <div class="row">
                <div class="col-md-12">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20"><span style="color:red";>Cities List</span>
                    <a href="<?=base_url('cities/insert_form');?>" class="btn btn-primary c-grey-900 mB-20 pull-right">Add New</a>
                    </h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>City_id</th>
                                <th>Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>City_id</th>
                                <th>Name</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach($cities as $city):?>
                                <tr id="<?php echo $city->city_id;?>">
                                    <td><?= $city->city_id;?></td>
                                    <td><?= $city->name;?></td>
                                    <td><?= $city->lat;?></td>
                                    <td><?= $city->lng;?></td>
                                    <td><?= $city->status;?></td>
                                    <td><?=anchor ("cities/edit/{$city->city_id}",'Edit',['class'=>'btn btn-success']);?></td>
                                    <td>

                                        <button type="submit" class="btn btn-danger btn-xs remove"> Delete</button>
                                    
                                    
                                    </td>
                                </tr>
                            <?php endforeach;?>    
                        </tbody>
                    </table>
                    </div><!--end of bgc-white bd bdrs-3 p-20 mB-20-->
                </div><!--end of col-md-12-->
            </div><!--end of row-->
        </div><!--end of full container-->
    </div><!--end of main content-->
</main>

<script type="text/javascript">
	$(".remove").click(function(){
		var id = $(this).parents("tr").attr("id");
		//alert(id);
		var url = "<?php echo base_url();?>";

		if(confirm('Are you sure to remove this record ?'))
		{
			$.ajax({
				url: url+'cities/del_city/'+id,
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