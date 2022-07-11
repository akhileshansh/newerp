<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('liveClass') . " " . $this->lang->line('list') ?></h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@mdo">Add <i class="fa fa-plus"></i></button>

                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <div class="mailbox-messages">
                            <table class="table table-striped table-bordered table-hover   live-class-list"
                                data-export-title="<?php echo $this->lang->line('liveClass') . " " . $this->lang->line('list'); ?>"
                                id="gmeetTable">
                                <thead>
                                    <tr>

                                        <th style="width:12%"><?php echo $this->lang->line('class_title'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('created_by'); ?></th>
                                        <th><?php echo $this->lang->line('created_for'); ?></th>
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right noExport "><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      
                                    if (!empty($liveClassResult)) {
                                   
                                        foreach ($liveClassResult as $key => $value) {
                                            
                                           
                                            $sessionReturn = $this->Gmeet_model->getSectionClass($value['id']);
                                             
                                            if ($staff_id == $value['created_by']) {
                                                $row = 'Self';
                                            } else {
                                                $staff     = $this->Gmeet_model->getstaffDetails($value['created_by']);
                                               
                                                if ($staff) {
                                                    $row = @$staff['name'] . '(' .
                                                        $staff['staff_role'] . ':' . @$staff['employee_id'] . ')';
                                                }
                                            }
                                          
                                            $create_for  = $this->Gmeet_model->getstaffDetails($value['staff_id']);
                                            
                                            if ($create_for) {
                                                $createdfor = @$create_for['name'] . '(' .
                                                    @$create_for['staff_role'] . ':' . @$create_for['employee_id'] . ')';
                                            }
                                    ?>
                                    <tr>
                                        <td><?= $value['class_title']; ?></td>
                                        <td><?= $value['date']; ?></td>
                                        <td><?= $row; ?></td>
                                        <td><?= $createdfor; ?></td>
                                        <td>
                                            <ul class="liststyle1">
                                                <?php
                                                        foreach ($sessionReturn as $rows) { ?>


                                                <li><i class="fa fa-check-square-o"></i> <?= $rows->class; ?>(
                                                    <?= @$rows->section; ?>) </li>
                                                <?php   }

                                                        ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <form class="chgstatus_form" method="POST"
                                                action="<?php echo base_url('admin/gmeet/chgstatus') ?>">
                                                <input   type="hidden" name="gmeet_id" value="<?= $value['id'] ?>">
                                                <select class="form-control chgstatus_dropdown" name="chg_status"
                                                    autocomplete="off">
                                                    <?php
                                                            if ($value['status'] == '1') { ?>
                                                    <option value="0">Awaited</option>
                                                    <option value="1" selected="selected">Cancelled </option>
                                                    <option value="2">Finished </option>
                                                    <?php } elseif ($value['status'] == '2') { ?>

                                                    <option value="0">Awaited</option>
                                                    <option value="1">Cancelled </option>
                                                    <option value="2" selected="selected">Finished </option>
                                                    <?php } else { ?>
                                                    <option value="0" selected="selected">Awaited</option>
                                                    <option value="1">Cancelled </option>
                                                    <option value="2">Finished </option>
                                                    <?php }

                                                            ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <?php
                                              if ($staff_id == $value['created_by'] || $role_id == '7' || $role_id == '1' || $staff_id == $value['staff_id']) { ?>
                                            <a href="<?php echo base_url('admin/gmeet/start/' . $value['id'] . '/class') ?>"
                                                class="btn label-success btn-xs start-mr-20" target="_blank">
                                                <span class="label"><i class="fa fa-video-camera"></i> Start</span>
                                            </a>
                                            <?php }

                                            if ($staff_id == $value['created_by'] || $role_id == '7' || $role_id == '1') {?>
                    <a href="<?php echo base_url('admin/gmeet/delete/' . $value['id']) ?> " class='btn btn-default btn-xs' data-toggle='tooltip'  title="<?= $this->lang->line('delete')?>" onclick='return confirm("<?php echo $this->lang->line("delete_confirm") ?>"  )'><i class='fa fa fa-remove'></i></a>
           <?php     }
                                                    ?>
                                        </td>
                                    </tr>
                                    <?php

                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->

                </div>
            </div>
            <!--/.col (left) -->
            <!-- right column -->

        </div>
<div class="modal fade" id="exampleModal" data-toggle="modal" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="Gmeet/liveClasStore" id="formsubject" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><b><?php echo $this->lang->line('class_title'); ?></b></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label for="class_title" class="col-form-label"><?php echo $this->lang->line('class_title'); ?>:</label><small class="req"> *</small>
                                    <input type="text" class="form-control" name="class_title" id="class_title">
                                    <span class="text text-danger class_title_error"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                    <label for="auto_publish_date" class="col-form-label"><?php echo $this->lang->line('class_date'); ?>:</label>
                                    <small class="req"> *</small>
                                    <div class="input-group">
                                        <input class="form-control tddm200 datetime_twelve_hour" name="auto_publish_date" type="text" id="auto_publish_date">
                                        <span class="input-group-addon" id="basic-addon2"> <i class="fa fa-calendar">
                                            </i>
                                        </span>
                                    </div>
                                    <span class="text text-danger auto_publish_date_error"></span>
                                </div>
                                <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                    <label for="duration" class="col-form-label"><?php echo $this->lang->line('class_duration_minutes'); ?>:</label><small class="req"> *</small>
                                    <input type="text" class="form-control timepicker" id="duration" name="duration">
                                    <span class="text text-danger duration_error"></span>

                                </div>

                                <?php if ($role != '2') { ?>
                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="role"><?php echo $this->lang->line('role'); ?></label><small class="req"> *</small>
                                        <select name="role" class="form-control select2" id="role">
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($roles as $key => $role) {
                                            ?>
                                                <option value="<?php echo $role['id'] ?>" <?php echo set_select('role', $role['id'], set_value('role')); ?>>
                                                    <?php echo $role["name"] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                        <span class="text text-danger role_error"></span>
                                    </div>

                                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                        <label for="message-text" class="col-form-label"><?php echo $this->lang->line('staff'); ?>:</label>
                                        <small class="req"> *</small>
                                        <select id="staff_id" name="staff_id" class="form-control select2" autocomplete="off">
                                            <option value="">Select</option>
                                        </select>
                                        <span class="text text-danger staff_id_error"></span>
                                    </div>
                                <?php } ?>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label><?php echo $this->lang->line('class'); ?></label>
                                    <small class="req">*</small>
                                    <select autofocus="" name="class_id" class="form-control select2" id="class_id">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        <?php foreach ($classlist as $class) {  ?>
                                            <option value="<?php echo $class['id'] ?>" <?php
                                                                                        if (set_value('class_id') == $class['id']) {
                                                                                            echo "selected=selected";
                                                                                        } ?>>
                                                <?php echo $class['class'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="text text-danger class_id_error"></span>

                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label for="section_id"><?php echo $this->lang->line('section'); ?></label><small class="req"> *</small>
                                    <select name="section_id[]" class="form-control select2" multiple id="section_id">
                                        <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    </select>
                                    <span class="text text-danger section_id_error"></span>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label for="gmeet_url" class="col-form-label"><?php echo $this->lang->line('gmeet_url'); ?>:</label><small class="req"> *</small>
                                    <input type="text" class="form-control" name="gmeet_url">
                                    <span class="text text-danger gmeet_url_error"></span>
                                </div>
                                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                    <label for="description" class="col-form-label"><?php echo $this->lang->line('description'); ?> :</label>
                                    <textarea class="form-control" name="description"></textarea>
                                    <span class="text text-danger description_error"></span>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="load" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Saving..."><?php echo $this->lang->line('save') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
    integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
    integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).on('change', '#class_id', function(e) {
    $('#section_id').html("");
    var class_id = $(this).val();
    getSectionByClass(class_id, section_id);
});


function getSectionByClass(class_id, section_id) {

    if (class_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {
                'class_id': class_id
            },
            dataType: "json",
            beforeSend: function() {
                $('#section_id').addClass('dropdownloading');
            },
            success: function(data) {
                $.each(data, function(i, obj) {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section +
                        "</option>";
                });
                $('#section_id').append(div_data);
            },
            complete: function() {
                $('#section_id').removeClass('dropdownloading');
            }
        });
    }
}
$(document).on('change', '#role', function(e) {
    var role_id = $(this).val();
    $('#staff_id').html("");
    getStaffNameByrole(role_id);
});

function getStaffNameByrole(role_id) {
    if (role_id != "") {
        $('#staff_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';


        $.ajax({
            type: "GET",
            url: base_url + "admin/gmeet/getbyRole",
            data: {
                'role_id': role_id
            },
            dataType: "json",
            beforeSend: function() {
                $('#staff_id').addClass('dropdownloading');
            },
            success: function(data) {
                console.log(data);
                $.each(data, function(i, obj) {
                    var sel = "";
                    // if (role_id == obj.role_id) {
                    //     sel = "selected";
                    // }
                    div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name +
                        "</option>";
                });
                $('#staff_id').append(div_data);
            },
            complete: function() {
                $('#staff_id').removeClass('dropdownloading');
            }
        });
    }
}

$(document).on('change', '.chgstatus_dropdown', function() {
    $(this).parent('form.chgstatus_form').submit()
});
$("form.chgstatus_form").submit(function(e) {
    e.preventDefault();
    var form = $(this);
    var url = form.attr('action');
    
   $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
 
            success: function(data) {
                console.log(data);
               if (data.status == 0) {
                         
                        errorMsg(data.message);
                    } else {
                     
                        successMsg(data.message);
                        window.location.reload(true);
                    }
            },
            error: function(xhr) {
                alert(JSON.stringify(xhr)); 
            },
           
        });
});


$("form#formsubject").submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        // $("span[id$='_error']").html("");
        var form = $(this);
        var url = form.attr('action');
        var submit_button = form.find(':submit');
        var post_params = form.serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(), // serializes the form's elements.
            dataType: "JSON", // serializes the form's elements.
            beforeSend: function() {
                $("[class$='_error']").html("");
                submit_button.button('loading');
            },
            success: function(data) {
                if (!data.status) {
                    var message = "";
                    $.each(data.error, function(index, value) {
                        message += value;
                    });
                    errorMsg(message);
                } else {
                    successMsg(data.message);
                    $('#exampleModal').modal('hide');

                    window.location.reload(true);

                }
            },
            error: function(xhr) {
                // if error occured
                submit_button.button('reset');
                alert("Error occured.please try again");

            },
            complete: function() {
                submit_button.button('reset');
            }
        });
    });


$('.select2').select2({
    dropdownParent: $('#exampleModal')
});

 $(document).ready(function () {
        $('#gmeetTable').DataTable();
    });
</script>