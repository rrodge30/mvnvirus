<?php
//print_r($data);
   
?>

<div class="user-subject-list">

    <?php 
        if($data){
            if(isset($data["subject_code"]) && isset($data["subject_description"])){
                echo '<div class="row">
                        <span>Subject Code:</span><span>'.$data["subject_code"].'</span>
                    </div>
                    <div class="row">
                            <span>Subject Description:</span><span>'.$data["subject_description"].'</span>
                    </div>';
            }
        }
      
    ?>
    <span class="brand" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                <td class="text-center font-roboto color-a2">ID</td>
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DATE</td>
                <td class="text-center font-roboto color-a2">TOTAL SCORE</td>
                <?php
                    if($_SESSION["users"]["user_level"] == "1"){
                        echo '<td class="text-center font-roboto color-a2">SCORE</td>';
                    }
                ?>
                
                
                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                if($data){
                    foreach($data as $key=>$questionaire){
                    
                            $id = $questionaire['idquestionaire'];
                            $title = $questionaire['questionaire_title'];
                            $description = $questionaire['questionaire_description'];
                            $date = $questionaire['questionaire_date'];
                            $total_score = $questionaire['questionaire_total_score'];
                            $score = $questionaire['user_total_score'];
                            $idsubject = $questionaire['idsubject'];

                        echo "
                            <tr>
                                <td class='text-center font-roboto color-a2'>$id</td>
                                <td class='text-center font-roboto color-a2'>$title</td>
                                <td class='text-center font-roboto color-a2'>$description</td>
                                <td class='text-center font-roboto color-a2'>$date</td>
                                <td class='text-center font-roboto color-a2'>$total_score</td>";
                                if($_SESSION["users"]["user_level"] == "1"){
                                    echo "<td class='text-center font-roboto color-a2'>$score</td>";
                                }
                         
                                
                        echo "<td class='text-center font-roboto color-a2'>";
                        if($_SESSION["users"]["user_level"] == "1"){
                            echo "<a data-toggle='tooltip' data-placement='top' title='View Questionnaire Result' class='btn-view-questionaire btn btn-info' href='reports/reportquestionnaireinfo/$id'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </a>";

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
