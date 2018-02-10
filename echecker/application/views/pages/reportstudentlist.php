<?php
    //print_r($data);
?>
<?php 
    if(isset($data[0]['subject_code'])){ 
?>
<h6><i><b>SUBJECT CODE:</b> <?=$data[0]['subject_code'];?></i></h6>
<h6><i><b>DESCRIPTION :</b> <?=$data[0]['subject_description'];?></i></h6>
<?php 
    }
?>
<div class="row">
<h5><b>STUDENT LIST:</b></h5>
<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">COURSE</td>
            <td class="text-center font-roboto color-a2">YEAR LEVEL</td>
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody class="student-list-tablebody">
        <?php
            if($data){
                foreach($data as $u){
                    $id = $u['idusers'];
                    $code = $u['code'];
                    $firstname = $u['firstname'];
                    $middlename = $u['middlename'];
                    $lastname = $u['lastname'];
                    $course = $u['course_name'];
                    $user_level = $u['user_level'];
                    $year_level = $u['year_level'];
                    $idsubject = $u['idsubject'];
                     
                    if($user_level == '1'){
                        echo "
                            <tr>
                                <td class='text-center'>$id</td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$course</td>
                                <td class='text-center'>$year_level</td>
                                <td class='text-center'>
                                    <form action='reports/studentquestionnairelist' method='GET' id='frm-studentquestionnairelist'>
                                        <input type='hidden' name='idsubject' value='$idsubject'>
                                        <input type='hidden' name='idusers' value='$id'>
                                        <button data-toggle='tooltip' data-placement='top' title='View Questionnaires' form='frm-studentquestionnairelist' class='btn btn-info' type='submit' name='view_student_questionnaire'>
                                            <i class='material-icons'>remove_red_eye</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                }
            }
         ?>
     </tbody>
</table>
</div>