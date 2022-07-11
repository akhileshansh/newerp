<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*.table td:last-child, th:last-child {float: none;text-align: start;}*/
</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <section class="content-header" style="padding-right: 0;">
                <h1>
                    <i class="fa fa-user-plus"></i> <?php echo $this->lang->line('student_information'); ?> <small><?php echo $this->lang->line('student1'); ?></small></h1>

            </section>
        </div>

        <div>
            <a id="sidebarCollapse" class="studentsideopen"><i class="fa fa-navicon"></i></a>
            <aside class="studentsidebar">
                <div class="stutop" id="">

                    <!-- Create the tabs -->
                    <div class="studentsidetopfixed">
                     
                        <p class="classtap"><?php echo $student["class"]; ?> <a href="#" data-toggle="control-sidebar" class="studentsideclose"><i class="fa fa-times"></i></a></p>
                        <ul class="nav nav-justified studenttaps">
                            <?php foreach ($class_section as $skey => $svalue) {
    ?>
                                <li <?php
if ($student["section_id"] == $svalue["section_id"]) {
        echo "class='active'";
    }
    ?> ><a href="#section<?php echo $svalue["section_id"] ?>" data-toggle="tab"><?php print_r($svalue["section"]);?></a></li>
                                <?php }?>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content">

                        <?php foreach ($class_section as $skey => $snvalue) {
    ?>
                            <div class="tab-pane <?php
if ($student["section_id"] == $snvalue["section_id"]) {
        echo "active";
    }
    ?>" id="section<?php echo $snvalue["section_id"]; ?>">
                                 <?php
foreach ($studentlistbysection as $stkey => $stvalue) {
        if ($stvalue['section_id'] == $snvalue["section_id"]) {

            ?>
                                        <div class="studentname">
                                            <a class="" href="<?php echo base_url() . "student/view/" . $stvalue["id"] ?>">
                                                <div class="icon">
                                                <?php if ($sch_setting->student_photo) {
                ?>
                                                <img src="<?php
if (!empty($stvalue["image"])) {
                    echo base_url() . $stvalue["image"];
                } else {

                    if ($student['gender'] == 'Female') {
                        echo base_url() . "uploads/student_images/default_female.jpg";
                    } elseif ($student['gender'] == 'Male') {
                        echo base_url() . "uploads/student_images/default_male.jpg";
                    }

                }
                ?>" alt="User Image">
                                                <?php }?>
                                                </div>
                                                <div class="student-tittle"><?php echo $this->customlib->getFullName($stvalue['firstname'], $stvalue['middlename'], $stvalue['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></div></a>
                                        </div>
                                        <?php
}
    }
    ?>
                            </div>
                        <?php }?>
                        <div class="tab-pane" id="sectionB">
                            <h3 class="control-sidebar-heading">Recent Activity 2</h3>
                        </div>

                        <div class="tab-pane" id="sectionC">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <div class="tab-pane" id="sectionD">
                            <h3 class="control-sidebar-heading">Recent Activity 3</h3>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                </div>
            </aside>
        </div>
        <!-- /.control-sidebar -->
    </div>

    <section class="content">
        <div class="row">
            <!-- <div class="col-md-3">

                <div class="box box-primary"  <?php
if ($student["is_active"] == "no") {
    echo "style='background-color:#f0dddd;'";
}
?>>
                    <div class="box-body box-profile">
                        <?php if ($sch_setting->student_photo) {
    ?>
                        <img class="profile-user-img img-responsive img-circle" src="<?php
if (!empty($student["image"])) {
        echo base_url() . $student["image"];
    } else {

        if ($student['gender'] == 'Female') {
            echo base_url() . "uploads/student_images/default_female.jpg";
        } else {
            echo base_url() . "uploads/student_images/default_male.jpg";
        }

    }
    ?>" alt="User profile picture">
                        <?php }?>
                        <h3 class="profile-username text-center"><?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></h3>

                        <ul class="list-group list-group-unbordered">
                            <?php
if ($student['is_active'] == 'no') {
    ?>



                                <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('reason') ?></b> <span class="pull-right text-aqua"><?php echo $reason_data['reason'] ?></span>
                                </li>
                                <li class="list-group-item listnoback">
                                     <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('note') ?></b> <span class="pull-right text-aqua"><?php echo $student['dis_note'] ?></span>
                                </li>
                                 <li class="list-group-item listnoback">
                                    <b><?php echo $this->lang->line('disable') . " " . $this->lang->line('date') ?></b> <span class="pull-right text-aqua"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['disable_at'])); ?></span>
                                </li>


                            <?php }?>

                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                            </li>
                        <?php
if ($sch_setting->roll_no) {
    ?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                            </li>
                            <?php
}?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class'] . " (" . $session . ")"; ?></a>
                            </li>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                            </li>
                            <?php if ($sch_setting->rte) {?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                            </li>
                            <?php }?>
                            <li class="list-group-item listnoback">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $this->lang->line(strtolower($student['gender'])); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
if (!empty($siblings)) {
    ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo $this->lang->line('sibling'); ?></h3>
                        </div>
                        <!-- /.box-header -->

                        <div class="box-body">
                            <?php
foreach ($siblings as $sibling_key => $sibling_value) {
        ?>
                                <div class="box box-widget widget-user-2">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="siblingview">
                                        <img class="" src="<?php echo base_url() . $sibling_value->image; ?>" alt="User Avatar">
                                        <h4><a href="<?php echo site_url('student/view/' . $sibling_value->id) ?>"><?php echo $this->customlib->getFullName($sibling_value->firstname, $sibling_value->middlename, $sibling_value->lastname, $sch_setting->middlename, $sch_setting->lastname); ?></a></h4>
                                    </div>
                                    <div class="box-footer no-padding">
                                        <ul class="list-group list-group-unbordered">
                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('admission_no'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->admission_no; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->class; ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $sibling_value->section; ?></a>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
}
    ?>

                        </div>
                        <!-- /.box-body -->
                    </div>

                    <?php
}
?>

            </div> -->
            <div class="col-md-9">

                <div class="nav-tabs-custom theme-shadow">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#exam" data-toggle="tab" aria-expanded="true"><?php echo $this->lang->line('exam'); ?></a></li>
                      
                        
                    </ul>
                    <div class="tab-content">
                <div class="download_label">
                        <?php echo $this->lang->line('exam') . " " . $this->lang->line('result'); ?>
                     </div>
                     <?php
if (empty($exam_result)) {
    ?>
                     <div class="alert alert-danger">
                        <?php echo $this->lang->line('no_record_found'); ?>
                     </div>
                     <?php
}
if (!empty($exam_result)) {
    ?>
                     <div class="dt-buttons btn-group pull-right miusDM40">
                        <a class="btn btn-default btn-xs dt-button no_print" id="print"  data-id="17"><i class="fa fa-print"></i></a>
                     </div>
                     <?php
foreach ($exam_result as $exam_key => $exam_value) {
        ?>
                     <div class="tshadow mb25">
                        <h4 class="pagetitleh">
                           <?php
echo $exam_value->exam;
        ?>
                        </h4>
                        <?php
if (!empty($exam_value->exam_result)) {
            if ($exam_value->exam_result['exam_connection'] == 0) {
                if (!empty($exam_value->exam_result['result'])) {
                    $exam_quality_points = 0;
                    $exam_total_points   = 0;
                    $exam_credit_hour    = 0;
                    $exam_grand_total    = 0;
                    $exam_get_total      = 0;
                    $exam_pass_status    = 1;
                    $exam_absent_status  = 0;
                    $total_exams         = 0;
                    ?>
                        <div class="table-responsive">
                           <table class="table table-striped table-hover ptt10" id="headerTable">
                              <thead>
                                 <th><?php echo $this->lang->line('subject'); ?></th>
                                 <?php
if ($exam_value->exam_type == "gpa") {
                        ?>
                                 <th><?php echo $this->lang->line('grade') . " " . $this->lang->line('point'); ?></th>
                                 <th><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?></th>
                                 <th><?php echo $this->lang->line('quality') . " " . $this->lang->line('points') ?></th>
                                 <?php
}
                    ?>
                                 <?php
if ($exam_value->exam_type != "gpa") {
                        ?>
                                 <th><?php echo $this->lang->line('max') . " " . $this->lang->line('marks'); ?></th>
                                 <th><?php echo $this->lang->line('min') . " " . $this->lang->line('marks') ?></th>
                                 <th><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained'); ?></th>
                                 <?php
}
                    ?>
                                 <?php
if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                        ?>
                                 <th><?php echo $this->lang->line('grade'); ?> </th>
                                 <?php
}

                    if ($exam_value->exam_type == "basic_system") {
                        ?>
                                 <th>
                                    <?php echo $this->lang->line('result'); ?>
                                 </th>
                                 <?php
}
                    ?>
                                 <th><?php echo $this->lang->line('note'); ?></th>
                              </thead>
                              <tbody>
                                 <?php
if (!empty($exam_value->exam_result['result'])) {
                        $total_exams = 1;
                        foreach ($exam_value->exam_result['result'] as $exam_result_key => $exam_result_value) {
                            $exam_grand_total = $exam_grand_total + $exam_result_value->max_marks;
                            $exam_get_total   = $exam_get_total + $exam_result_value->get_marks;
                            $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                            if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                $exam_pass_status = 0;
                            }
                            ?>
                                 <tr>
                                    <td><?php echo ($exam_result_value->name); ?></td>
                                    <?php
if ($exam_value->exam_type != "gpa") {
                                ?>
                                    <td><?php echo ($exam_result_value->max_marks); ?></td>
                                    <td><?php echo ($exam_result_value->min_marks); ?></td>
                                    <td>
                                       <?php
echo $exam_result_value->get_marks;

                                if ($exam_result_value->attendence == "absent") {
                                    $exam_absent_status = 1;
                                    echo "&nbsp;" . $this->lang->line('abs');
                                }
                                ?>
                                    </td>
                                    <?php
} elseif ($exam_value->exam_type == "gpa") {
                                ?>
                                    <td>
                                       <?php

                                $percentage_grade  = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                $point             = findGradePoints($exam_grade, $exam_value->exam_type, $percentage_grade);
                                $exam_total_points = $exam_total_points + $point;
                                echo number_format($point, 2, '.', '');
                                ?>
                                    </td>
                                    <td> <?php
echo $exam_result_value->credit_hours;
                                $exam_credit_hour = $exam_credit_hour + $exam_result_value->credit_hours;
                                ?></td>
                                    <td><?php
echo number_format($exam_result_value->credit_hours * $point, 2, '.', '');
                                $exam_quality_points = $exam_quality_points + ($exam_result_value->credit_hours * $point);
                                ?></td>
                                    <?php
}
                            ?>

                                    <?php
if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                ?>
                                    <td><?php echo findExamGrade($exam_grade, $exam_value->exam_type, $percentage_grade); ?></td>
                                    <?php
}
                            if ($exam_value->exam_type == "basic_system") {
                                ?>
                                    <td>
                                       <?php
if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                    ?>
                                       <label class="label label-danger"><?php echo $this->lang->line('fail') ?></label>
                                       <?php
} else {
                                    ?>
                                       <label class="label label-success"><?php echo $this->lang->line('pass') ?></label>
                                       <?php
}
                                ?>
                                    </td>
                                    <?php
}
                            ?>
                                    <td><?php echo ($exam_result_value->note); ?></td>
                                 </tr>
                                 <?php
}
                    }
                    ?>
                              </tbody>
                           </table>
                        </div>
                        <?php ?>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="bgtgray">
                                 <?php
if ($exam_value->exam_type != "gpa") {
                        ?>
                                 <div class="col-sm-3 col-lg-3 col-md-3">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('percentage') ?> :  <span class="description-text"><?php
$exam_percentage = ($exam_get_total * 100) / $exam_grand_total;
                        echo number_format($exam_percentage, 2, '.', '');
                        ?></span></h5>
                                    </div>
                                 </div>
                                 <div class="col-sm-4 col-lg-4 col-md-4 border-right">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('result') ?> :<span class="description-text">
                                          <?php
if ($total_exams) {
                            if ($exam_absent_status) {
                                ?>
                                          <span class='label label-danger'>
                                          <?php
echo $this->lang->line('fail');
                                ?>
                                          </span>
                                          <?php
} else {

                                if ($exam_pass_status) {
                                    ?>
                                          <span class='label bg-green' style="margin-right: 5px;">
                                          <?php
echo $this->lang->line('pass');
                                    ?>
                                          </span> <?php
} else {
                                    ?>
                                          <span class='label label-danger'>
                                          <?php
echo $this->lang->line('fail');
                                    ?>
                                          </span>
                                          </span><?php
}

                                if ($exam_pass_status) {

                                    echo $this->lang->line('division');
                                    if ($exam_percentage >= 60) {
                                        echo " : " . $this->lang->line('first');
                                    } elseif ($exam_percentage >= 50 && $exam_percentage < 60) {
                                        echo " : " . $this->lang->line('second');
                                    } elseif ($exam_percentage >= 0 && $exam_percentage < 50) {
                                        echo " : " . $this->lang->line('third');
                                    } else {

                                    }
                                }
                            }
                        }
                        ?>
                                       </h5>
                                    </div>
                                 </div>
                                 <div class="col-sm-2 col-lg-2 col-md-2 border-right">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('grand') . " " . $this->lang->line('total') ?> : <span class="description-text"><?php echo $exam_grand_total; ?></span></h5>
                                    </div>
                                 </div>
                                 <div class="col-sm-3 col-lg-3 col-md-3 border-right">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('total') . " " . $this->lang->line('obtain') . " " . $this->lang->line('marks') ?> :  <span class="description-text"><?php echo $exam_get_total; ?></span></h5>
                                    </div>
                                 </div>
                                 <?php
} elseif ($exam_value->exam_type == "gpa") {
                        ?>

                                 <div class="col-sm-2">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?> :  <span class="description-text"><?php echo $exam_credit_hour; ?></span></h5>
                                    </div>
                                 </div>
                                 <div class="col-sm-3">
                                    <div class="description-block">
                                       <h5 class="description-header"><?php echo $this->lang->line('quality') . " " . $this->lang->line('points') ?> :  <span class="description-text">
                                        <?php
if ($exam_credit_hour <= 0) {
                            echo "--";
                        } else {
                            $exam_grade_percentage = ($exam_get_total * 100) / $exam_grand_total;
                            echo $exam_quality_points . "/" . $exam_credit_hour . '=' . number_format($exam_quality_points / $exam_credit_hour, 2, '.', '') . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $exam_grade_percentage) . "]";
                        }

                        ?>
                                          </span>

                                          <?php
?>
                                       </h5>
                                    </div>
                                 </div>
                                 <?php
}
                    ?>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
}
            } elseif ($exam_value->exam_result['exam_connection'] == 1) {

                $exam_connected_exam = ($exam_value->exam_result['exam_result']['exam_result_' . $exam_value->exam_group_class_batch_exam_id]);

                if (!empty($exam_connected_exam)) {
                    $exam_quality_points = 0;
                    $exam_total_points   = 0;
                    $exam_credit_hour    = 0;
                    $exam_grand_total    = 0;
                    $exam_get_total      = 0;
                    $exam_pass_status    = 1;
                    $exam_absent_status  = 0;
                    $total_exams         = 0;
                    ?>
                     <table class="table table-striped ">
                        <thead>
                           <th><?php echo $this->lang->line('subject') ?></th>
                           <?php
if ($exam_value->exam_type == "gpa") {
                        ?>
                           <th><?php echo $this->lang->line('grade') . " " . $this->lang->line('point') ?> </th>
                           <th><?php echo $this->lang->line('credit') . " " . $this->lang->line('hours') ?></th>
                           <th><?php echo $this->lang->line('quality') . " " . $this->lang->line('points'); ?></th>
                           <?php
}
                    ?>
                           <?php
if ($exam_value->exam_type != "gpa") {
                        ?>
                           <th><?php echo $this->lang->line('max') . " " . $this->lang->line('marks') ?></th>
                           <th><?php echo $this->lang->line('min') . " " . $this->lang->line('marks') ?></th>
                           <th><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?> </th>
                           <?php
}
                    ?>
                           <?php
if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                        ?>
                           <th><?php echo $this->lang->line('grade'); ?></th>
                           <?php
}

                    if ($exam_value->exam_type == "basic_system") {
                        ?>
                           <th>
                              <?php echo $this->lang->line('result'); ?>
                           </th>
                           <?php
}
                    ?>
                           <th><?php echo $this->lang->line('remark') ?></th>
                        </thead>
                        <tbody>
                           <?php
if (!empty($exam_connected_exam)) {
                        $total_exams = 1;
                        foreach ($exam_connected_exam as $exam_result_key => $exam_result_value) {
                            $exam_grand_total = $exam_grand_total + $exam_result_value->max_marks;
                            $exam_get_total   = $exam_get_total + $exam_result_value->get_marks;
                            $percentage_grade = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                            if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                $exam_pass_status = 0;
                            }
                            ?>
                           <tr>
                              <td><?php echo ($exam_result_value->name); ?></td>
                              <?php
if ($exam_value->exam_type != "gpa") {
                                ?>
                              <td><?php echo ($exam_result_value->max_marks); ?></td>
                              <td><?php echo ($exam_result_value->min_marks); ?></td>
                              <td>
                                 <?php
echo $exam_result_value->get_marks;

                                if ($exam_result_value->attendence == "absent") {
                                    $exam_absent_status = 1;
                                    echo "&nbsp; " . $this->lang->line('abs');
                                }
                                ?>
                              </td>
                              <?php
} elseif ($exam_value->exam_type == "gpa") {
                                ?>
                              <td style="">
                                 <?php
$percentage_grade  = ($exam_result_value->get_marks * 100) / $exam_result_value->max_marks;
                                $point             = findGradePoints($exam_grade, $exam_value->exam_type, $percentage_grade);
                                $exam_total_points = $exam_total_points + $point;
                                echo number_format($point, 2, '.', '');
                                ?>
                              </td>
                              <td> <?php
echo $exam_result_value->credit_hours;
                                $exam_credit_hour = $exam_credit_hour + $exam_result_value->credit_hours;
                                ?></td>
                              <td><?php
echo number_format($exam_result_value->credit_hours * $point, 2, '.', '');
                                $exam_quality_points = $exam_quality_points + ($exam_result_value->credit_hours * $point);
                                ?></td>
                              <?php
}
                            ?>
                              <?php
if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                                ?>
                              <td><?php echo findExamGrade($exam_grade, $exam_value->exam_type, $percentage_grade); ?></td>
                              <?php
}
                            if ($exam_value->exam_type == "basic_system") {
                                ?>
                              <td>
                                 <?php
if ($exam_result_value->get_marks < $exam_result_value->min_marks) {
                                    ?>
                                 <label class="label label-danger">
                                 <?php echo $this->lang->line('fail') ?>
                                 <label>
                                 <?php
} else {
                                    ?>
                                 <label class="label label-success"><?php echo $this->lang->line('pass') ?>
                                 <label>
                                    <?php
}
                                ?>
                              </td>
                              <?php
}
                            ?>
                              <td><?php echo ($exam_result_value->note); ?></td>
                           </tr>
                           <?php
}
                    }
                    ?>
                        </tbody>
                     </table>
                     <div class="row">
                     <div class="col-md-12">
                     <div class="bgtgray">
                     <?php
if ($exam_value->exam_type != "gpa") {
                        ?>
                     <div class="col-sm-3 col-lg-3 col-md-3 pull no-print">
                     <div class="description-block">
                     <h5 class="description-header"> <?php echo $this->lang->line('percentage') ?> :  <span class="description-text">
                     <?php
$exam_percentage = ($exam_get_total * 100) / $exam_grand_total;
                        echo number_format($exam_percentage, 2, '.', '');
                        ?>
                     </span></h5>
                     </div>
                     </div>
                     <div class="col-sm-4 col-lg-4 col-md-4 border-right no-print">
                     <div class="description-block">
                     <h5 class="description-header"><?php echo $this->lang->line('result'); ?> :<span class="description-text">
                     <?php
if ($total_exams) {
                            if ($exam_absent_status) {
                                ?>
                     <span class='label label-danger' style="margin-right: 5px;">
                     <?php
echo $this->lang->line('fail');
                                ?>
                     </span>
                     <?php
} else {

                                if ($exam_pass_status) {
                                    ?>
                     <span class='label bg-green' style="margin-right: 5px;">
                     <?php
echo $this->lang->line('pass');
                                    ?>
                     </span>
                     <?php
} else {
                                    ?>
                     <span class='label label-danger' style="margin-right: 5px;">
                     <?php
echo $this->lang->line('fail');
                                    ?>
                     </span>
                     <?php
}
                            }
                        }
                        ?>
                     <?php
if ($total_exams) {

                            if ($exam_pass_status) {
                                echo $this->lang->line('division');
                                if ($exam_percentage >= 60) {
                                    echo " : " . $this->lang->line('first');
                                } elseif ($exam_percentage >= 50 && $exam_percentage < 60) {

                                    echo " : " . $this->lang->line('second');
                                } elseif ($exam_percentage >= 0 && $exam_percentage < 50) {

                                    echo " : " . $this->lang->line('third');
                                } else {

                                }
                            }
                        }
                        ?>
                     </span></h5>
                     </div>
                     </div>
                     <div class="col-sm-2 col-lg-2 col-md-2 border-right no-print">
                     <div class="description-block">
                     <h5 class="description-header"><?php echo $this->lang->line('grand') . " " . $this->lang->line('total'); ?> : <span class="description-text"><?php echo $exam_grand_total; ?></span></h5>
                     </div>
                     </div>
                     <div class="col-sm-3 border-right no-print">
                     <div class="description-block"><h5 class="description-header"><?php echo $this->lang->line('total') . " " . $this->lang->line('obtain') . " " . $this->lang->line('marks'); ?> :  <span class="description-text"><?php echo $exam_get_total; ?></span></h5>
                     </div>
                     </div>
                     <?php
} elseif ($exam_value->exam_type == "gpa") {
                        ?>
                     <div class="col-sm-3 col-lg-3 col-md-3 pull no-print">
                     <div class="description-block">
                     <h5 class="description-header">
                     <?php echo $this->lang->line('credit') . " " . $this->lang->line('hours'); ?> :
                     <span class="description-text"><?php echo $exam_credit_hour; ?>
                     </span>
                     </h5>
                     </div>
                     </div>
                     <div class="col-sm-3 pull no-print">
                     <div class="description-block">
                     <h5 class="description-header">
                     <?php echo $this->lang->line('quality') . " " . $this->lang->line('points'); ?> :<span class="description-text"><?php
if ($exam_credit_hour <= 0) {
                            echo "--";
                        } else {
                            $exam_grade_percentage = ($exam_get_total * 100) / $exam_grand_total;
                            echo $exam_quality_points . "/" . $exam_credit_hour . '=' . number_format($exam_quality_points / $exam_credit_hour, 2, '.', '') . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $exam_grade_percentage) . "]";
                        }
                        ?>
                     </span>
                     </h5>
                     </div>
                     </div>
                     <?php
}
                }
                ?>
                     </div>
                     </div>
                     </div>
                  </div>
                  <div class="tshadow mb25">
                  <h4 class="pagetitleh">
                  <?php echo $this->lang->line('consolidated') . " " . $this->lang->line('marksheet'); ?>
                  </h4>
                  <?php
$consolidate_exam_result            = false;
                $consolidate_exam_result_percentage = false;
                if ($exam_value->exam_type == "coll_grade_system" || $exam_value->exam_type == "school_grade_system") {
                    ?>
                  <table class="table table-striped ">
                  <thead>
                  <th><?php echo $this->lang->line('exam') ?></th>
                  <?php
foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                        ?>
                  <th>
                  <?php echo $each_exam_value->exam; ?>
                  </th>
                  <?php
}
                    ?>
                  <th><?php echo $this->lang->line('consolidate') ?></th>
                  </thead>
                  <tbody>
                  <tr>
                  <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained'); ?></td>
                  <?php
$consolidate_get_total = 0;
                    $consolidate_max_total = 0;
                    if (!empty($exam_value->exam_result['exams'])) {
                        $consolidate_exam_result = "pass";
                        foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                            ?>
                  <td>
                  <?php
$consolidate_each                = getCalculatedExam($exam_value->exam_result['exam_result'], $each_exam_value->id);
                            $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_each->get_marks);
                            if ($consolidate_each->exam_status == "fail") {
                                $consolidate_exam_result = "fail";
                            }

                            echo $consolidate_get_percentage_mark;
                            $consolidate_get_total = $consolidate_get_total + ($consolidate_get_percentage_mark);
                            $consolidate_max_total = $consolidate_max_total + ($consolidate_each->max_marks);
                            ?>
                  </td>
                  <?php
}
                    }
                    ?>
                  <td>
                  <?php
      $consolidate_percentage_grade =($consolidate_max_total >0) ?($consolidate_get_total * 100) / $consolidate_max_total :0;

                    echo $consolidate_get_total . "/" . $consolidate_max_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                    $consolidate_exam_result_percentage = $consolidate_percentage_grade;
                    ?></td>
                  </tr>
                  </tbody>
                  </table>
                  <?php
} elseif ($exam_value->exam_type == "basic_system") {
                    ?>
                  <table class="table table-striped ">
                  <thead>
                  <th><?php echo $this->lang->line('exam'); ?></th>
                  <?php
foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                        ?>
                  <th>
                  <?php echo $each_exam_value->exam; ?>
                  </th>
                  <?php
}
                    ?>
                  <th><?php echo $this->lang->line('consolidate'); ?></th>
                  </thead>
                  <tbody>
                  <tr>
                  <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></td>
                  <?php
$consolidate_get_total = 0;
                    $consolidate_max_total = 0;
                    if (!empty($exam_value->exam_result['exams'])) {
                        $consolidate_exam_result = "pass";
                        foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {

                            ?>
                  <td>
                  <?php
$consolidate_each                = getCalculatedExam($exam_value->exam_result['exam_result'], $each_exam_value->id);
                            $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_each->get_marks);
                            if ($consolidate_each->exam_status == "fail") {
                                $consolidate_exam_result = "fail";
                            }
                            echo $consolidate_get_percentage_mark;
                            $consolidate_get_total = $consolidate_get_total + ($consolidate_get_percentage_mark);
                            $consolidate_max_total = $consolidate_max_total + ($consolidate_each->max_marks);
                            ?>
                  </td>
                  <?php
}
                    }
                    ?>
                  <td><?php
      $consolidate_percentage_grade =($consolidate_max_total >0) ?($consolidate_get_total * 100) / $consolidate_max_total :0;
                    echo $consolidate_get_total . "/" . $consolidate_max_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                    $consolidate_exam_result_percentage = $consolidate_percentage_grade;
                    ?></td>
                  </tr>
                  </tbody>
                  </table>
                  <?php
} elseif ($exam_value->exam_type == "gpa") {
                    ?>
                  <table class="table table-striped ">
                  <thead>
                  <th><?php echo $this->lang->line('exam') ?></th>
                  <?php
foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {
                        ?>
                  <th>
                  <?php echo $each_exam_value->exam; ?>
                  </th>
                  <?php
}
                    ?>
                  <th><?php echo $this->lang->line('consolidate'); ?></th>
                  </thead>
                  <tbody>
                  <tr>
                  <td><?php echo $this->lang->line('marks') . " " . $this->lang->line('obtained') ?></td>
                  <?php
$consolidate_get_total      = 0;
                    $consolidate_subjects_total = 0;

                    foreach ($exam_value->exam_result['exams'] as $each_exam_key => $each_exam_value) {

                        ?>
                  <td>
                  <?php
$consolidate_each        = getCalculatedExamGradePoints($exam_value->exam_result['exam_result'], $each_exam_value->id, $exam_grade, $exam_value->exam_type);
                        $consolidate_exam_result = ($consolidate_each->total_points / $consolidate_each->total_exams);
                        echo $consolidate_each->total_points . "/" . $consolidate_each->total_exams . "=" . number_format($consolidate_exam_result, 2, '.', '');

                        $consolidate_get_percentage_mark = getConsolidateRatio($exam_value->exam_result['exam_connection_list'], $each_exam_value->id, $consolidate_exam_result);
                        $consolidate_get_total           = $consolidate_get_total + ($consolidate_get_percentage_mark);
                        $consolidate_subjects_total      = $consolidate_subjects_total + $consolidate_each->total_exams;
                        ?>
                  </td>
                  <?php
}
                    ?>
                  <td>
                  <?php
$consolidate_percentage_grade = ($consolidate_get_total * 100) / $consolidate_subjects_total;

                    echo (number_format($consolidate_get_total, 2, '.', '')) . "/" . $consolidate_subjects_total . " [" . findExamGrade($exam_grade, $exam_value->exam_type, $consolidate_percentage_grade) . "]";
                    ?>
                  </td>
                  </tr>
                  </tbody>
                  </table>
                  <?php
}

                if ($consolidate_exam_result) {
                    ?>
                  <div class="row">
                  <div class="col-md-12">
                  <div class="bgtgray">
                  <div class="col-sm-3 pull no-print">
                  <div class="description-block">
                  <h5 class="description-header"><?php echo $this->lang->line('result') ?> :
                  <span class="description-text">
                  <?php
if ($consolidate_exam_result == "pass") {
                        ?>
                  <span class='label label-success' style="margin-right: 5px;">
                  <?php
echo $this->lang->line('pass');
                        ?>
                  </span>
                  <?php
} else {
                        ?>
                  <span class='label label-danger' style="margin-right: 5px;">
                  <?php
echo $this->lang->line('fail');
                        ?>
                  </span>
                  <?php
}
                    ?>
                  </span>
                  </h5>
                  </div>
                  </div>
                  <?php
if ($consolidate_exam_result_percentage) {
                        ?>
                  <div class="col-sm-3 border-right no-print">
                  <div class="description-block">
                  <h5 class="description-header"><?php echo $this->lang->line('division'); ?> :<span class="description-text">
                  <?php
if ($consolidate_exam_result_percentage >= 60) {
                            echo $this->lang->line('first');
                        } elseif ($consolidate_exam_result_percentage >= 50 && $consolidate_exam_result_percentage < 60) {

                            echo $this->lang->line('second');
                        } elseif ($consolidate_exam_result_percentage >= 0 && $consolidate_exam_result_percentage < 50) {

                            echo $this->lang->line('third');
                        } else {

                        }
                        ?>
                  </span></h5>
                  </div>
                  </div>
                  <?php
}
                }
                ?>
                  </div>
                  </div>
                  </div>
                  </div>
                  <?php
}
        }
    }
} else {
    ?>
                  <?php
}

?>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>

</div>



<script type="text/javascript">
$(document).on('click', '#print', function () {
            var print_btn=$(this);
         var id = $(this).data('id');
              
                $.ajax({
                    url: '<?php echo site_url("reportcard/print") ?>',
                    type: 'post',
                    data: {'data': id},
                     beforeSend: function () {
                print_btn.button('loading');
            },
                    success: function (response) {
                        Popup(response);
                    },
                    error: function (xhr) { // if error occured
                print_btn.button('reset');
                errorMsg("<?php echo $this->lang->line('error_occured').", ".$this->lang->line('please_try_again')?>");

            },
            complete: function () {
                print_btn.button('reset');
            }
                });
            
        });

    $(document).ready(function (e) {

        $("#timelineform").on('submit', (function (e) {
            var student_id = $("#student_id").val();

            e.preventDefault();
            $.ajax({
                url: "<?php echo site_url("admin/timeline/add") ?>",
                type: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {

                    if (data.status == "fail") {

                        var message = "";
                        $.each(data.error, function (index, value) {

                            message += value;
                        });
                        errorMsg(message);
                    } else {

                        successMsg(data.message);
                        window.location.reload(true);
                    }

                },
                error: function (e) {
                    alert("Fail");
                    console.log(e);
                }
            });

        }));
    });

    function delete_timeline(id) {

        var student_id = $("#student_id").val();
        if (confirm('<?php echo $this->lang->line("delete_confirm") ?>')) {

            $.ajax({
                url: '<?php echo base_url(); ?>admin/timeline/delete_timeline/' + id,
                success: function (res) {
                    $.ajax({
                        url: '<?php echo base_url(); ?>admin/timeline/student_timeline/' + student_id,
                        success: function (res) {
                            $('#timeline_list').html(res);

                        },
                        error: function () {
                            alert("Fail")
                        }
                    });

                },
                error: function () {
                    alert("Fail")
                }
            });
        }
    }

    function disable_student(id) {
        if (confirm("<?php echo $this->lang->line('are_you_sure_you_want_to_disable_this_student') ?>")) {
            $('#disstudent_id').val(id);
            $('#disable_modal').modal('show');
        }
    }

    $("#disable_form").on('submit', (function (e) {
        e.preventDefault();
        var id = $('#disstudent_id').val();
        var $this = $(this).find("button[type=submit]:focus");

        $.ajax({
            url: "<?php echo site_url("student/disable_reason") ?>",
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $this.button('loading');

            },
            success: function (res)
            {

                if (res.status == "fail") {

                    var message = "";
                    $.each(res.error, function (index, value) {

                        message += value;
                    });
                    errorMsg(message);

                } else {

                    successMsg(res.message);

                    window.location.reload(true);
                }
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                $this.button('reset');
            },
            complete: function () {
                $this.button('reset');
            }

        });
    }));
    function disable(id) {


        if (confirm("Are you sure you want to disable this record.")) {
            var student_id = '<?php echo $student["id"] ?>';
            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {

                    var userid = response.id;
                    changeStatus(userid, 'no', 'student');

                }
            });

        } else {
            return false;
        }

    }

    function enable(id, status, role) {
        if (confirm("<?php echo $this->lang->line('are_you_sure') . ' ' . $this->lang->line('you_want_to_enable_this_record'); ?>")) {
            var student_id = '<?php echo $student["id"] ?>';

            $.ajax({
                type: "post",
                url: base_url + "student/getUserLoginDetails",
                data: {'student_id': student_id},
                dataType: "json",
                success: function (response) {

                    var userid = response.id;

                    changeStatus(userid, 'yes', 'student');


                }
            });

             $.ajax({
                type: "post",
                url: base_url + "student/enablestudent/"+student_id,
                data: {'student_id': student_id},
                dataType: "json",
                success: function (data) {

                 window.location.reload(true);

                }
            });


        } else {
            return false;
        }

    }

    function changeStatus(rowid, status = 'no', role = 'student') {

        var base_url = '<?php echo base_url() ?>';

        $.ajax({
            type: "POST",
            url: base_url + "admin/users/changeStatus",
            data: {'id': rowid, 'status': status, 'role': role},
            dataType: "json",
            success: function (data) {
                successMsg(data.msg);
            }
        });
    }
    $(document).ready(function () {
        $.extend($.fn.dataTable.defaults, {
            searching: false,
            ordering: false,
            paging: false,
            bSort: false,
            info: false
        });
    });

    function send_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $student['username']; ?>';
        var password = '<?php echo $student['password']; ?>';
        var contact_no = '<?php echo $student['mobileno']; ?>';
        var email = '<?php echo $student['email']; ?>';

        $.ajax({
            type: "post",
            url: base_url + "student/sendpassword",
            data: {student_id: student_id, username: username, password: password, contact_no: contact_no, email: email},

            success: function (response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent'); ?>');
            }
        });

    }

    function send_parent_password() {
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student['id']; ?>';
        var username = '<?php echo $guardian_credential['username']; ?>';
        var password = '<?php echo $guardian_credential['password']; ?>';
        var contact_no = '<?php echo $student['guardian_phone']; ?>';
        var email = '<?php echo $student['guardian_email']; ?>';

        $.ajax({
            type: "post",
            url: base_url + "student/send_parent_password",
            data: {student_id: student_id, username: username, password: password, contact_no: contact_no, email: email},

            success: function (response) {
                successMsg('<?php echo $this->lang->line('message_successfully_sent'); ?>');
            }
        });
    }


    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title_logindetail').html("");
        $('.modal-title_logindetail').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var student_id = '<?php echo $student["id"] ?>';
        var student_name = '<?php echo $this->customlib->getFullName($student["firstname"], $student["middlename"], $student["lastname"], $sch_setting->middlename, $sch_setting->lastname); ?>';

        $.ajax({
            type: "post",
            url: base_url + "student/getlogindetail",
            data: {'student_id': student_id},
            dataType: "json",
            success: function (response) {
                var data = "";
                data += '<div class="col-md-12">';
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + student_name +  '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>' + "<?php echo $this->lang->line('user_type'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('username'); ?>" + '</th>';
                data += '<th class="text text-center">' + "<?php echo $this->lang->line('password'); ?>" + '</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    data += '<tr>';
                    data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                    data += '<input type=hidden name=userid id=userid value=' + obj.id + '>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> ' + "<?php echo $this->lang->line('login_url'); ?>" + ': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';
                data += '</div>  ';
                $('.modal-body_logindetail').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }

    $(document).ready(function () {
        getExamResult();
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
    function getExamResult(student_session_id) {
        if (student_session_id != "") {
            $('.examgroup_result').html("");

            $.ajax({
                type: "POST",
                url: baseurl + "admin/examresult/getStudentCurrentResult",
                data: {'student_session_id': 17},
                dataType: "JSON",
                beforeSend: function () {

                },
                success: function (data) {
                    $('.examgroup_result').html(data.result);
                },
                complete: function () {

                }
            });
        }
    }
</script>

<script type="text/javascript">

    $(document).on('change', '#exam_group_id', function () {
        var exam_group_id = $(this).val();
        if (exam_group_id != "") {
            $('#exam_id').html("");

            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "POST",
                url: baseurl + "admin/examgroup/getExamsByExamGroup",
                data: {'exam_group_id': exam_group_id},
                dataType: "JSON",
                beforeSend: function () {
                    $('#exam_id').addClass('dropdownloading');
                },
                success: function (data) {
                    console.log(data);
                    $.each(data.result, function (i, obj)
                    {

                        div_data += "<option value=" + obj.id + ">" + obj.exam + "</option>";
                    });
                    $('#exam_id').append(div_data);
                },
                complete: function () {
                    $('#exam_id').removeClass('dropdownloading');
                }
            });
        }
    });

// this is the id of the form
    $("form#form_examgroup").submit(function (e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.
        var form = $(this);
        var url = form.attr('action');
        var submit_button = $("button[type=submit]");
        $.ajax({
            type: "POST",
            url: url,
            dataType: 'JSON',
            data: form.serialize(), // serializes the form's elements.
            beforeSend: function () {
                submit_button.button('loading');
            },
            success: function (data)
            {
                $('.examgroup_result').html(data.result);
            },
            error: function (xhr) { // if error occured
                alert("Error occured.please try again");
                submit_button.button('reset');
            },
            complete: function () {
                submit_button.button('reset');
            }
        });

    });
                        $(document).ready(function (e) {

                                            $("#form1").on('submit', (function (e) {

                                                e.preventDefault();
                                                $.ajax({
                                                    url: "<?php echo site_url("student/create_doc") ?>",
                                                    type: "POST",
                                                    data: new FormData(this),
                                                    dataType: 'json',
                                                    contentType: false,
                                                    cache: false,
                                                    processData: false,
                                                    success: function (res)
                                                    {

                                                        if (res.status == "fail") {

                                                            var message = "";
                                                            $.each(res.error, function (index, value) {

                                                                message += value;
                                                            });
                                                            errorMsg(message);

                                                        } else {

                                                            successMsg(res.message);

                                                            window.location.reload(true);
                                                        }
                                                    }
                                                });

                                            }));

                                        });
                         var base_url = '<?php echo base_url() ?>';

    function Popup(data, winload = false)
    {
        var frame1 = $('<iframe />').attr("id", "printDiv");
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
        document.getElementById('printDiv').contentWindow.focus();
        document.getElementById('printDiv').contentWindow.print();
        $("#printDiv", top.document).remove();
            if (winload) {
                window.location.reload(true);
            }
        }, 500);


        return true;
    }
</script>

<?php
function findGradePoints($exam_grade, $exam_type, $percentage)
{

    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type) {

            if (!empty($exam_grade_value['exam_grade_values'])) {
                foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                    if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                        return $grade_value->point;
                    }
                }
            }
        }
    }
    return 0;
}

function findExamGrade($exam_grade, $exam_type, $percentage)
{

    foreach ($exam_grade as $exam_grade_key => $exam_grade_value) {
        if ($exam_grade_value['exam_key'] == $exam_type) {

            if (!empty($exam_grade_value['exam_grade_values'])) {
                foreach ($exam_grade_value['exam_grade_values'] as $grade_key => $grade_value) {
                    if ($grade_value->mark_from >= $percentage && $grade_value->mark_upto <= $percentage) {
                        return $grade_value->name;
                    }
                }
            }
        }
    }
    return "";
}

function getConsolidateRatio($exam_connection_list, $examid, $get_marks)
{

    if (!empty($exam_connection_list)) {
        foreach ($exam_connection_list as $exam_connection_key => $exam_connection_value) {

            if ($exam_connection_value->exam_group_class_batch_exams_id == $examid) {
                return ($get_marks * $exam_connection_value->exam_weightage) / 100;
            }
        }
    }
    return 0;
}

function getCalculatedExamGradePoints($array, $exam_id, $exam_grade, $exam_type)
{

    $object              = new stdClass();
    $return_total_points = 0;
    $return_total_exams  = 0;
    if (!empty($array)) {

        if (!empty($array['exam_result_' . $exam_id])) {
            foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {
                $return_total_exams++;
                $percentage_grade    = ($exam_value->get_marks * 100) / $exam_value->max_marks;
                $point               = findGradePoints($exam_grade, $exam_type, $percentage_grade);
                $return_total_points = $return_total_points + $point;
            }
        }
    }

    $object->total_points = $return_total_points;
    $object->total_exams  = $return_total_exams;

    return $object;
}

function getCalculatedExam($array, $exam_id)
{

    $object              = new stdClass();
    $return_max_marks    = 0;
    $return_get_marks    = 0;
    $return_credit_hours = 0;
    $return_exam_status  = false;
    if (!empty($array)) {
        $return_exam_status = 'pass';
        if (!empty($array['exam_result_' . $exam_id])) {
            foreach ($array['exam_result_' . $exam_id] as $exam_key => $exam_value) {

                if ($exam_value->get_marks < $exam_value->min_marks || $exam_value->attendence != "present") {
                    $return_exam_status = "fail";
                }

                $return_max_marks    = $return_max_marks + ($exam_value->max_marks);
                $return_get_marks    = $return_get_marks + ($exam_value->get_marks);
                $return_credit_hours = $return_credit_hours + ($exam_value->credit_hours);
            }
        }
    }
    $object->credit_hours = $return_credit_hours;
    $object->get_marks    = $return_get_marks;
    $object->max_marks    = $return_max_marks;
    $object->exam_status  = $return_exam_status;
    return $object;
}
?>