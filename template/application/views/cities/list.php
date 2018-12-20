<?php if ($msg=$this->session->flashdata('msg')):
$msg_class=$this->session->flashdata('msg_class')
?>
<div class="alert<?$msg_class?>">
<?=$msg;?>
</div> 
<?php endif;?>

<main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="container-fluid">
              <h4 class="c-grey-900 mT-10 mB-30">Data Tables</h4>
              <div class="row">
                <div class="col-md-12">
                  <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h4 class="c-grey-900 mB-20">Bootstrap Data Table</h4>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th>City_id</th>
                            <th>Name</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cities as $city):?>
                                <tr>
                                    <td><?= $city->city_id;?></td>
                                        <td><?= $city->name;?></td>
                                        <td><?= $city->lat;?></td>
                                        <td><?= $city->lng;?></td>
                                        <td><?= $city->status;?></td>
                                        <td><?=anchor ("cities/edit/{$city->city_id}",'Edit',['class'=>'btn btn-default']);?><td>
                                            <?=
                                                form_open('cities/del_city'),
                                                form_hidden('id', $city->city_id),
                                                form_submit(['name'=>'submit', 'value'=>'Delete', 'class'=>'btn btn-danger']),
                                                form_close();
                                            ?> 
                                        </td>
                                    </tr>
                             <?php endforeach;?>
                        </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </main>
      <?=$links;?>
    </div>
 </div>
</div>