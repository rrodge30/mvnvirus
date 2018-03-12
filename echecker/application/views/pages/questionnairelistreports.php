<?php
/*
echo "<pre>";
print_r($data);
echo "</pre>";
  */
?>

<div class="user-subject-list">

    <?php 
        echo '<div style="margin:50px;margin-left:10px;">';
        if(isset($data[0]["subject_code"]) && isset($data[0]["subject_description"])){
            echo '<div class="row">
                    <span class="col-md-3">Subject Code</span><span class="col-md-9">:'.$data[0]["subject_code"].'</span>
                </div>
                <div class="row">
                        <span class="col-md-3">Subject Description</span><span class="col-md-9">:'.$data[0]["subject_description"].'</span>
                </div>';
        }else if(isset($data["subject_code"]) && isset($data["subject_description"])){
            echo '<div class="row" style="">
                    <span class="col-md-3">Subject Code:</span><span class="col-md-9">:'.$data["subject_code"].'</span>
                </div>
                <div class="row">
                        <span class="col-md-3">Subject Description</span><span class="col-md-9">:'.$data["subject_description"].'</span>
                </div>';
        }
        if($data){
            if(isset($data["student_count"])){
                echo '<div class="row">
                        <span class="col-md-3">Number of Students</span><span class="col-md-9">:'.$data["student_count"].'</span>
                    </div>';
            
            }
        }
        echo "</div>";
    ?>
    <span class="brand roboto" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DATE</td>
                <td class="text-center font-roboto color-a2">TOTAL ITEM</td>

                <?php
                    
                    if($_SESSION["users"]["user_level"] == "1"){
                        echo '<td class="text-center font-roboto color-a2">SCORE</td>';
                        echo '<td class="text-center font-roboto color-a2">PERCENTAGE</td>';
                        echo '<td class="text-center font-roboto color-a2">REMARK</td>';
                        
                    }

                    if($_SESSION["users"]["user_level"] != "1"){

                        echo '<td class="text-center font-roboto color-a2">NO. OF STUDENTS TAKE EXAM</td>';
                        echo '<td class="text-center font-roboto color-a2">PASSING RATE</td>';
                    }

                ?>

                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data){
                    foreach($data as $key=>$questionaire){

                        if(!isset($questionaire['idquestionaire'])){    // to avoid assoc user count in the loop (data count -1)
                            continue;
                        }     
                            $id = $questionaire['idquestionaire'];
                            $title = $questionaire['questionaire_title'];
                            $description = $questionaire['questionaire_description'];
                            $date = $questionaire['questionaire_date'];
                            $total_score = $questionaire['questionaire_total_score'];
                            $score = $questionaire['user_total_score'];
                            $idsubject = $questionaire['idsubject'];
                            $percentage = "0";
                            if($score != "" && $score != null){
                                $percentage = number_format(((($score)/($total_score))*80)+(20),2);
                                if($percentage >= 75){
                                    $remark = "Passed";
                                }else{
                                    $remark = "failed";
                                }

                            }else{
                                $remark = "invalid";
                            }
                            $passPercentage = 0;
                            $userPassCount = 0;
                            $numberOfStudentsTake = 0;
                            if(isset($questionaire["user_questionnaire"])){

                                if(count($questionaire["user_questionnaire"]) > 0){
                                    for($i=0;$i<count($questionaire["user_questionnaire"]);$i++){
                                        if($questionaire["user_questionnaire"][$i]["user_total_score"] == null || $questionaire["user_questionnaire"][$i]["user_total_score"] == ""){
                                            $userScorePercentage = 0;
                                        }else{
                                            $userScorePercentage = ((($questionaire["user_questionnaire"][$i]["user_total_score"])/($questionaire["user_questionnaire"][$i]["questionaire_total_score"])*80)+20);
                                            if($userScorePercentage >= 75){
                                                $userPassCount++;
                                            }
                                        }
                                        
                                    }
                                    if($userPassCount > 0){
                                        $passPercentage = number_format(((($userPassCount))/(count($questionaire["user_questionnaire"]))*100),2);
                                    }else{
                                        $passPercentage = 0;
                                    }
                                    $numberOfStudentsTake = count($questionaire["user_questionnaire"]);
                                }else{
                                    $passPercentage = "no student have take the examination yet";
                                }
                                
                            }
                        echo "
                            <tr>
                                
                                <td class='text-center font-roboto color-a2'>$title</td>
                                <td class='text-center font-roboto color-a2'>$description</td>
                                <td class='text-center font-roboto color-a2'>$date</td>
                                <td class='text-center font-roboto color-a2'>$total_score</td>";
                                
                                if($_SESSION["users"]["user_level"] == "1"){
                                    echo "<td class='text-center font-roboto color-a2'>$score</td>";
                                    echo "<td class='text-center font-roboto color-a2'>$percentage%</td>";
                                    echo "<td class='text-center font-roboto color-a2'>$remark</td>";
                                }
                                if($_SESSION["users"]["user_level"] != "1"){
                                
                                    echo "<td class='text-center font-roboto color-a2'>$numberOfStudentsTake</td>";
                                    echo "<td class='text-center font-roboto color-a2'>$passPercentage%</td>";

                                }
                         
                                
                        echo "<td class='text-center font-roboto color-a2'>";
                        if($_SESSION["users"]["user_level"] == "1"){
                            if($score == "" || $score == null){
                                echo "<a disabled='disabled' onclick='return false;' data-toggle='tooltip' data-placement='top' title='Invalid Examination' class='btn-view-questionaire btn btn-info' href='reports/reportquestionnaireinfo/$id'>
                                    <i class='material-icons'>close</i>
                                </a>";
                            }else{
                                echo "<a data-toggle='tooltip' data-placement='top' title='View Questionnaire Result' class='btn-view-questionaire btn btn-info' href='reports/reportquestionnaireinfo/$id'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </a>";
                            }
                            

                        }else{
                            echo "
                                <form action='reports/reportstudentlistquestionnaire' method='GET' id='frm-reportstudentlistquestionnaire$id'>
                                    <input type='hidden' name='idsubject' value='$idsubject'>
                                    <input type='hidden' name='idquestionaire' value='$id'>
                                    <button data-toggle='tooltip' data-placement='top' type='submit' form='frm-reportstudentlistquestionnaire$id' title='View Student List' class='btn-view-questionaire btn btn-info'>
                                        <i class='material-icons'>remove_red_eye</i>
                                    </button>
                                </form>
                            ";

                            echo '<form action="reports/exportSubjectStudentsQuestionaireResult" method="POST" id="frm-exportSubjectStudentsQuestionaireResult'.$id.'">
                                    <input type="hidden" name="idquestionaire" value="'.$id.'">
                                    <button data-toggle="tooltip" data-placement="top" title="Export Questionnaire Result" class=" btn btn-success" type="submit" form="frm-exportSubjectStudentsQuestionaireResult'.$id.'">
                                        <i class="material-icons">file_download</i>
                                    </button>
                                </form>';
                        }
                        
                                                     
                        
    
                        echo " 
                                    
                                </td>
                               
                            </tr>
                            ";
                        
                    }
                }
            ?>
                
        </tbody>
    </table>
</div> 
