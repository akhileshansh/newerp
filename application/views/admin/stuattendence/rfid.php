<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
     
    <section class="content">
        <div class="row">
         
            <div class="col-md-<?php
            if ($this->rbac->hasPrivilege('rfid', 'can_add')) {
                echo "12";
            } else {
                echo "12";
            }
            ?>"> 
                <!-- general form elements -->
                <div class="box box-primary" id="hroom">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('rfid'); ?>  </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $this->lang->line('admission_no'); ?></label>
                                    <input id="admission_no" name="admission_no" placeholder="" type="text" class="form-control" />
                                </div>
                            </div>
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->
        </div>	
    </section> 
</div>
            <script type="text/javascript">
                    $(document).ready(function(){
                    	$('#admission_no').focus();
                    });
                
                    $(document).on('change', '#admission_no', function () {
                       
                        var admission_no = $(this).val();
                        var base_url = '<?php echo base_url() ?>';
                        $.ajax({
                            type: "POST",
                            url: base_url + "admin/stuattendence/rfidsave",
                            data: {'admission_no': admission_no},
                            dataType: "json",
                            success: function (data) {
                                if (data.status == 1) {
                         			successMsg(data.message);
                         			console.log(data.data);
                         			$('#admission_no').val('');
                         			$('#admission_no').focus();
                    			}else if (data.status == 2) {
                         			errorMsg(data.message);
                         			$('#admission_no').val('');
                         			$('#admission_no').focus();
                    			} else {
                                  $('#admission_no').val('');
                         			$('#admission_no').focus();
                        		errorMsg(data.message);
                        		}  
                            },
                             error: function(xhr) {
                				alert(JSON.stringify(xhr)); 
            				},
                        });
                    });
 
            </script>
         