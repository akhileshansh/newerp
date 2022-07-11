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
                            <?php echo $this->lang->line('liveClass') . " " . $this->lang->line('list') ?>
                        </h3>

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
                                        <th><?php echo $this->lang->line('class'); ?></th>
                                        <th><?php echo $this->lang->line('class_host'); ?></th>
                                        <th><?php echo $this->lang->line('status'); ?></th>
                                        <th class="text-right noExport "><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($liveClassResult)) {

                                        foreach ($liveClassResult as $key => $value) {
                                    ?>
                                    <tr>
                                        <td><?= $value['class_title']; ?></td>
                                        <td><?= $value['date']; ?></td>

                                        <td>
                                            <?= @$value['class']; ?> (<?= @$value['section']; ?>)
                                        </td>
                                        <td>
                                            <?= $value['staff_name'] ?>
                                            (<?= @$value['staff_role'] . ':' . @$value['employee_id'] ?> )
                                        </td>
                                        <td>
                                            <?php if ($value['status'] == '0') {
                                                    ?>
                                            <span class="label label-warning"> Awaited </span>
                                            <?php

                                                    } elseif ($value['status'] == '1') {
                                                    ?>
                                            <span class="label label-default"> Cancelled </span>
                                            <?php

                                                    } else {
                                                    ?>
                                            <span class="label label-success"> Finished </span>
                                            <?php

                                                    } ?>
                                        </td>
                                        <td class="pull-right">
                                            <?php if ($value['status'] == '0') { ?>
                                            <a href="<?php echo base_url('user/gmeet/start/' . $value['id'] . '/class') ?>"
                                                class="btn label-success btn-xs start-mr-20" target="_blank">
                                                <span class="label"><i class="fa fa-video-camera"></i> Start</span>
                                            </a>
                                            <?php } ?>

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


    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script>
$(document).ready(function() {
    $('#gmeetTable').DataTable();
});
</script>