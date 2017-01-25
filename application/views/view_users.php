                    <?php
                      $uname = $this->session->userdata('uname');
                    ?>
                    <?php
                        echo validation_errors(); 
                    ?>
					
					<?php
                        
                        $message=$this->session->flashdata('message');
                       if($message=="user_deleted")
                       {
                    ?>
                        <div class="alert alert-block alert-success">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
                            </button>
                            User successfully deleted!
                        </div>
                    <?php
                       }
                   ?>
  
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default" style="border:2px solid white; color:rgb(111,111,111); font-weight:bold">
                                <header class="panel-heading bg-red">
                                    System Users

                                </header>
                                <div class="panel-body">
                                    <table class="table table-bordered" style="font-size:12px;">
                                        <thead class="bg-red"><tr>
                                            <th style="width: 10px">#</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Date created</th>
											<th>Action</th>
                                            <!--<th></th>
                                            <th></th>-->
                                            
                                              
                                        </tr></thead>
                                        <tbody id="myTable">
                                         <?php $sn=1 ; 
                                          
                                         ?>
                                        <?php foreach ($users_data as $detail): 
										$user = '#aaa'.$detail['uid'] ;
										$user2 = 'aaa'.$detail['uid'] ;
										?>

                                        <tr>
                                            <td><?php echo $sn."." ?></td>
                                            <td><?php echo $detail['uname'] ; ?></td>
                                            <td><?php echo $detail['fname']." ".$detail['lname']." ".$detail['oname'] ; ?></td>
                                            <td><?php echo $detail['email'] ; ?></td>
                                            <td><?php echo $detail['pword'] ; ?></td>
                                            <td><?php echo $detail['role'] ; ?></td>
                                            <td><?php echo $detail['date_created'] ; ?></td>
                                            <!--<td><a href="#" class="btn btn-default" role="button" >Edit</a></td>
                                            <td><a href="#" class="btn btn-default" role="button" >Delete</a></td>-->
                                            <td>
												<a class="refresh" id="refresh-toggler" href="#" data-href="<?php echo site_url(); ?>/qlip_controller/delete_user/<?php echo $detail['uid'] ?>" data-toggle="modal" data-target="<?php echo $user ; ?>">
                            <i data-toggle="tooltip" data-placement="bottom" data-original-title="Delete" class="glyphicon glyphicon-trash"></i>
                        </a>
						
	<div class="modal fade" id="<?php echo $user2 ; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-footer">
				<button type="button" class="btn btn-default" style="border:0"><strong>Are you sure you want to delete <?php echo $detail['uname'] ; ?> ?</strong></button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok" href="<?php echo site_url(); ?>/qlip_controller/delete_user/<?php echo $detail['uid'] ?>">Delete</a>
            </div>
        </div>
    </div>
	</div>

<script>
$('<?php echo json_encode($user) ; ?>').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
											
											</td>
                                            
                                            
                                        </tr>
                                        <?php $sn=$sn+1 ; ?>
                                        <?php endforeach ?>
                                    </tbody>

                                    </table>
                                    <div class="col-md-12 text-center">
                                     <ul class="pagination pagination-lg pager" id="myPager"></ul>
                                    </div>
                                    <!--<div class="table-foot">
                                        <ul class="pagination pagination-sm no-margin pull-right">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                    </div>-->
                                </div><!-- /.panel-body -->

                            </div><!-- /.panel -->

                            
                        </div><!-- /.col -->
                        
                    </div><!-- /.row -->
					
					
	