<?php
   /*echo "<pre>";
   print_r($data);
   echo "</pre>";
   */
?>


<?php 
    if(isset($data[0]['subject_code'])){ 
?>
<h6><i><b>SUBJECT CODE :</b> <?=$data[0]['subject_code'];?></i></h6>
<h6><i><b>DESCRIPTION :</b> <?=$data[0]['subject_description'];?></i></h6>
<h6><i><b>TOTAL SCORE :</b> 
<?php
    if(isset($data[0]["questionaire_total_score"])){
        echo $data[0]["questionaire_total_score"];
    }else{
        echo "0";
    }
?>
</i></h6>


<?php 
    }//dont erase this
?>
<div class="row">
<h5><b>STUDENT LIST:</b></h5>

<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">DEPARTMENT</td>
            <td class="text-center font-roboto color-a2">SCORE</td>
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody class="student-list-tablebody">
        <?php
            if($data){
                foreach($data as $u){
                    $id = $u['UID'];
                    $idsubject = $u["idsubject"];
                    $code = $u['code'];
                    $firstname = $u['firstname'];
                    $middlename = $u['middlename'];
                    $lastname = $u['lastname'];
                    $department = $u['department_name'];
                    $user_level = $u['user_level'];
                    $score = $u['user_total_score'];
                    $idquestionaire = $u["idquestionaire"];
                    if($user_level == '1'){
                        echo "
                            <tr>
                                <td class='text-center'>$id</td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$department</td>
                                <td class='text-center'>$score</td>
                                <td class='text-center'>";
                                if($idquestionaire == "0"){
                                    echo "
                                    <form action='reports/reportstudentquestionnaireinfo' id='frm-reportstudentquestionnaireinfo$id'>
                                        <input type='hidden' name='idquestionaire' value='$idquestionaire'>
                                        <input type='hidden' name='idusers' value='$id'>
                                        <button disabled data-toggle='tooltip' data-placement='top' title='Unable to view, haven't take examination yet.' class='btn-view-student-subject-questionnaires btn btn-info' type='submit' form='frm-reportstudentquestionnaireinfo$id'>
                                            <i class='material-icons'>close</i>
                                        </button>
                                    </form>";
                                }else{
                                    echo "
                                    <form action='reports/reportstudentquestionnaireinfo' id='frm-reportstudentquestionnaireinfo$id'>
                                        <input type='hidden' name='idquestionaire' value='$idquestionaire'>
                                        <input type='hidden' name='idusers' value='$id'>
                                        <button data-toggle='tooltip' data-placement='top' title='View Questionnaire' class='btn-view-student-subject-questionnaires btn btn-info' type='submit' form='frm-reportstudentquestionnaireinfo$id'>
                                            <i class='material-icons'>remove_red_eye</i>
                                        </button>
                                    </form>";
                                }
                                    
                        echo "  </td>
                            </tr>
                        ";
                    }
                }
            }
         ?>
     </tbody>
</table>
</div>