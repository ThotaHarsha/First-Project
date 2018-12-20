<div class="agile-grids">
    <div class="gallery">
        <h1>Gallery</h1>
            <?PHP if($this->session->flashdata('success')){?>
                <div class="alert alert-success">
                <strong>Success!</strong> <?=  $this->session->flashdata('success'); ?>
                </div>
            <?PHP } ?>

            <?PHP if($this->session->flashdata('failed')){?>
                <div class="alert alert-danger">
                <strong>Failed!</strong> <?=  $this->session->flashdata('failed'); ?>
                </div>
            <?PHP } ?>
    </div>

        <?php foreach($images as $image):?>
        
            
        
            <div class="img-thumbnail img-reponsive" style="display:inline-block"><img src="<?= "http://experientia.in/".$image->image_url; ?>" height='200px' width='300px' style='padding-right: 6px'/></div>

            <button type="submit" class="btn btn-danger remove" id="<?= $image->images_id?>"> Delete</button>
            <?=anchor("tours/images_edit/{$image->images_id}/{$this->uri->segment(3)}", 'Edit', ['class'=>'btn btn-primary']);?>

        <?php endforeach;?>

</div>



<script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).attr("id");
        // alert(data);
        // exit;
        var url = "<?php echo base_url();?>";

        // alert(url);
        // exit;

        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
                url: url+'tours/images_delete/'+id,
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