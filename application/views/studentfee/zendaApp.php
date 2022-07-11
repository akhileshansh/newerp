   <div class="content-wrapper">
    <div class="row">
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body" style="padding-top:0;">
                        
                       
                        <div class="table-responsive">
                            <div class="download_label "><?php echo $this->lang->line('student_fees') . ": " . $student['firstname'] . " " . $student['lastname'] ?> </div>
                            <table class="table table-striped table-bordered table-hover example table-fixed-header" id="gmeetTable">
                                <thead class="header">
                                    <tr>
                                     
                                        <th align="left">Student Name</th>
                                        <th align="left">Admission No</th>
                                        <th align="left" class="text text-left">father_name</th>
                                        <th align="left" class="text text-left"> guardian_phone</th>
                                        <th class="text text-right">receiptNo</th>
                                        <th class="text text-right">AppTransactionId</th>
                                        <th class="text text-left">transactionNo</th>
                                        <th class="text text-right"><?php echo $this->lang->line('amount') ?>  </th>
                                      
                                       
                                        <th>Advance Amount</th>
                                        <th>Total Tax</th>

                                        <th>paymentStatus</th>
                                         <th  class="text text-left"><?php echo $this->lang->line('date'); ?></th>
                                          <th class="text text-right">totalAmount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
 							 
                                  foreach($fees_list as $fs){
                                  
                                  	?>
                                  	<tr>
                                  		<td> <?php echo $fs->studentName; ?> </td>
                                  		<td> <?php echo $fs->registerNo; ?> </td>
                                  		<td> <?php echo $fs->student_details->father_name?$fs->student_details->father_name:'' ?> </td>
                                  		<td> <?php echo $fs->student_details->guardian_phone?$fs->student_details->guardian_phone:'' ?> </td>
                                  		<td> <?php echo $fs->receiptNo; ?> </td>
                                  		<td> <?php echo $fs->onlinePaymentAppTransactionId; ?> </td>
                                  		<td> <?php echo $fs->transactionNo; ?> </td>
                                  	    <td> <?php echo $fs->invoiceAmount; ?> </td>
                                  		
                                  		<td><?= $fs->advanceAmount?></td>
                                  		<td><?= $fs->totalTaxAmt?></td>	
                                  		<td><?= $fs->paymentStatus?></td>	
                                  		<td> <?php echo $fs->created_at; ?> </td>
                                  		<td> <?php echo $fs->totalAmount; ?> </td>
                                  	</tr>
                                    <?php if($fs->invoices){
                                    	foreach($fs->invoices as $inv){ ?>
                                  	<tr  >
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td align="left"></td>
                                        <td class="text-right"><img src="<?php echo base_url(); ?>backend/images/table-arrow.png" alt="" /></td>
                                        <td class="text text-left">
                                            <a href="#" data-toggle="popover" class="detail_popover" ><?php echo $inv->invoiceNo?$inv->invoiceNo:'' ?>
                                            </a>
											<div class="fee_detail_popover" style="display: none">
                                            <?php
											if ($inv->invoiceNo) {?>
                                            <p class="text text-danger">Invoice Details</p>
                                            <?php } ?>
                                            </div>
										</td>
                                        <td class="text text-left">
                                            <a href="#" data-toggle="popover" class="detail_popover" ><?php echo $inv->invoiceDueAmt?$inv->invoiceDueAmt:'' ?>
                                            	
                                            </a>

                                            <div class="fee_detail_popover" style="display: none">
                                            <?php
											if ($inv->invoiceDueAmt) {
                   							?>
                                            <p class="text text-danger">Invoice DueAmt</p>
                                            <?php
											}  ?>
                                            </div>
										</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
                                </tr>
                                  	<?php
                                  } }
                               }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!--/.col (left) -->
        </div>
    </section>
</div>
</div>

 