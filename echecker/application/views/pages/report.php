<?php

?>



<div class="row">
<h5><b>TEACHER LIST:</b></h5>

<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            
            <td class="text-center font-roboto color-a2"></td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">SUBJECTS HANDLED</td>
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
                    $subjectCount = $u['subjectcount'];
                    $image = (($u['image'] == "") ? "default.png" : $u['image']);
                        echo "
                            <tr>
                                <td class='text-center'><img src='assets/uploads/" . $image .  "' style='height:100px;width:100px;margin:5px;'></td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$subjectCount</td>
                                
                                
                                <td class='text-center'>
                                    <form action='reports/reportteachersubjectList' id='frm-reportTeacherSubjectList' method='GET'>
                                        <input type='hidden' name='idusers' value='$id'>
                                        <button data-toggle='tooltip' data-placement='top' title='View Subject List' class='btn-reportteachersubjectList btn btn-info' type='submit' form='frm-reportTeacherSubjectList'>
                                            <i class='material-icons'>remove_red_eye</i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        ";
                }
            }
         ?>
     </tbody>
</table>
</div>