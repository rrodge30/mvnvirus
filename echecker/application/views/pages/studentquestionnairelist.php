<?php
//print_r($data);
   
?>

<div class="user-subject-list">

    <?php 
        if($data){
            if(isset($data[0]["subject_code"]) && isset($data[0]["subject_description"])){
                echo '<div class="row">
                        <span>Subject Code:</span><span>'.$data[0]["subject_code"].'</span>
                    </div>
                    <div class="row">
                            <span>Subject Description:</span><span>'.$data[0]["subject_description"].'</span>
                    </div>';
            }
        }
      
    ?>
    <span class="brand" style="font-size:20px;">QUESTIONNAIRE LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                
                <td class="text-center font-roboto color-a2">TITLE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">DATE</td>
                <td class="text-center font-roboto color-a2">TOTAL SCORE</td>
                <td class="text-center font-roboto color-a2">SCORE</td>
              
                
                
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
                            $idusers = $questionaire['idusers'];

                        echo "
                            <tr>
                                
                                <td class='text-center font-roboto color-a2'>$title</td>
                                <td class='text-center font-roboto color-a2'>$description</td>
                                <td class='text-center font-roboto color-a2'>$date</td>
                                <td class='text-center font-roboto color-a2'>$total_score</td>
                                <td class='text-center font-roboto color-a2'>$score</td>";
                                
                         
                                
                        echo "<td class='text-center font-roboto color-a2'>";
                    
                        echo "
                            <form action='reports/studentquestionnaireinfo' method='GET' id='frm-studentquestionnaireinfo'>
                                <input type='hidden' name='idusers' value='$idusers'>
                                <input type='hidden' name='idquestionaire' value='$id'>
                                <button data-toggle='tooltip' data-placement='top' title='View Questionnaire result' type='submit' form='frm-studentquestionnaireinfo' class='btn btn-info'>
                                    <i class='material-icons'>remove_red_eye</i>
                                </button>
                            </form>
                            ";

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
