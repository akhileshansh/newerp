
    <div class="content-wrapper" >
      
  
    <section class="main_wrapper" id="myDiv">
          <style type="text/css">
        .main_wrapper {
            margin-top: 5%;
        }

        .logo_img {
            text-align: center;
        }

        .logo_img img {
            border-radius: 0px;
        }
        .table{
            width: 99%;
        }
        .heading {
           
            text-align: center;
            font-weight: bold;
        }

        .table tbody tr td,
        .table thead tr th {
            width: 16.666%;
        }

        #myDiv th{
            text-align: center;
        }
        .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
            border: 1px solid gray;
        }
        .row1{
            display: flex;
            width: 100%;
                align-items: center;
    justify-content: center;
        }
        .row1 .col-sm-4{
            width: 33%;
        }
    </style>
        <div class="container">

            <div class="row1">
                <div class="col-sm-4">
                    <div class="logo_img">
                        <img src="<?php echo base_url(); ?>uploads/school_content/admin_logo/<?php $this->setting_model->getAdminlogo();?>" style="margin-top:10px; width:150px"> 


                    </div>
                </div>
                <div class="col-sm-4" style="width:33%;text-align:center;">
                    <h4>ISLAMIA INTER COLLEGE</h4>
                    <p>
                        <b>Address</b> - Aman
                        Shaheed Hamirpur
                        Hamirpur, Uttar
                        Pradesh
                        India - 210301
                    </p>
                </div>
                <div class="col-sm-4">
                    <div class="logo_img">
                      <img src="<?php echo base_url().$student['image'];?>" style="margin-top:10px; width:150px"> 
                    </div>
                </div>
            </div>
         
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="heading">Student Application Form</h4><br>
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6">Official Details</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr >
                                <td ><b>Application No</b></td>
                                <td ><?=  $student['admission_no']?></td>
                                 <td ><b>Academic Year</b></td>
                                <td colspan="3"><?php echo $this->setting_model->getCurrentSessionName(); ?></td>
                            </tr>
                            <tr>
                               <td><b>Class</b></td>
                                <td><?php echo $student['class'];?></td>
                                 <td><b>Subjects</b></td>
                                <td><?=  $student['subjects']?></td>
                                
                                <td><b>Section</b></td>
                                <td><?= $student['section'];?></td>
                            </tr>
                           
                        </tbody>

                    </table>
                </div>
            </div>
<br>
            <!-- personal details section -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6">Personal Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>First Name</b></td>
                                <td><?php echo $student['firstname'] ?></td>
                                <td><b>Middle Name</b></td>
                                <td><?php echo $student['middlename'] ?> </td>
                                <td><b>Last Name</b></td>
                                <td><?php echo $student['lastname'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Date of birth</b></td>
                                <td><?php  $dob=date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob'])); echo $dob;?></td>
                                <td><b>Gender</b></td>
                                <td><?php echo $student['gender']?> </td>
                                <td><b>Blood Group</b></td>
                                <td><?php echo $student['blood_group'] ?></td>
                            </tr>
                            <tr>
                                <td><b>Caste</b></td>
                                <td><?php echo $student['cast'] ?></td>
                                <td><b>Nationality</b></td>
                                <td><?php echo $student['religion'] ?> </td>
                                <td><b>Category</b></td>
                                <td><?php echo $student['category'];?></td>
                            </tr>
                            <tr>
                                <td><b>Phone Number</b></td>
                                <td>------</td>
                                <td><b>Mobile Number</b></td>
                                <td><?= $student['mobileno']?> </td>
                                <td><b>Email Id</b></td>
                                <td><?= $student['email'];?></td>
                            </tr>
                            <tr>
                                <td><b>Aadhaar Card</b></td>
                                <td><?php echo $student['student_adhar_no'];?></td>
                                <td><b>Pan Card</b></td>
                                <td><?php echo $student['pan_card'];?></td>
                                <td><b>-------</b></td>
                                <td>-------</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
<br>
            <!-- contact details -->
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                          
                            <tr align="center">
                                <th colspan="6">Current Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $student['current_address'] ?></td>
                                
                            </tr>
                       
                         
                        </tbody>
                       
                        </tr>

                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            
                            <tr align="center">
                                <th colspan="6">Permanent Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $student['permanent_address']?></td>
                                
                            </tr>
                       
                         
                        </tbody>
                        

                    </table>
                </div>
            </div>
<br>
             <!-- father details -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6">Father Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Name</b></td>
                                <td><?php echo $student['father_name']?></td>
                                <td><b>Phone No</b></td>
                                <td><?= $student['father_phone'];?> </td>
                                <td><b>Occupation</b></td>
                                <td><?= $student['father_occupation']?></td>
                            </tr>
                           <tr>
                               <td><b>Aadhaar Card No</b></td>
                               <td><?= $student['father_adhar_no']?></td>
                               <td><b>Pan Card No</b></td>
                               <td><?= $student['father_pan_card']?></td>
                               <td></td>
                               <td></td>
                           </tr>
                            
                         
                        </tbody>
                       
                    </table>
                </div>
            </div>
<br>
            <!-- mother details -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6">Mother Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Name</b></td>
                                <td><?php echo $student['mother_name']?></td>
                                <td><b>Phone No</b></td>
                                <td><?= $student['mother_phone'];?> </td>
                                <td><b>Occupation</b></td>
                                <td><?= $student['mother_occupation']?></td>
                            </tr>
                           <tr>
                               <td><b>Aadhaar Card No</b></td>
                               <td><?= $student['mother_adhar_no']?></td>
                               <td><b>Pan Card No</b></td>
                               <td><?= $student['mother_pan_card']?></td>
                               <td></td>
                               <td></td>
                           </tr>              
                        </tbody>
                    </table>
                </div>
            </div>
<br>
            <!-- Previous School Qualification Details -->

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6">Previous School Qualification Details </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?=$student['previous_school']?></td>
                                 
                            </tr>
                           
                        
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered" style="width:99%">
                        <thead>
                            <tr align="center">
                                <th colspan="6"> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Parent Signature</b></td>
                                <td> </td>
                                <td><b>Student Signature</b></td>
                                <td> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
<br>
            
       <div class="box-footer">
                                  <a href="<?php echo base_url('student/search')?>" class="print btn btn-primary pull-right">Back</a>
                                <button  onclick="printFunction()" class="print btn btn-info pull-right">Print</button>
            </div>
             
        </div>
    </section>
    
 </div>

<script type="text/javascript">
          function printFunction(e) { 
           $('.print').hide();
           
            //  var divContents = document.getElementById("myDiv").innerHTML;
            // var prnt = window.open('');
            //  prnt.document.write(divContents);
            // prnt.document.close();
            // prnt .print();
                 window.print(); 
  $('.print').show();

              }

</script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/dist/js/savemode.js"></script>