<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="full-container">


        <div style="margin-bottom: 50px; margin-top: 50px; margin-left: 50px;">

            <a href="<?= base_url('dashboard');?>"><span style="color:red;"><h3>Home</h3><span></a>
        </div>
        
        <?PHP if($this->session->flashdata('success')){?>
        <div class="alert alert-success">
        <strong>Success!</strong> <?=  $this->session->flashdata('success'); ?>
        </div>
        <?PHP } ?>  

        



        </div>
    </div>
</main>