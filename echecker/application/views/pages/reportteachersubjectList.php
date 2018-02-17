
<?php
 
   
?>

<div class="user-subject-list">
    <span class="brand" style="font-size:20px;">SUBJECT LIST:</span>
    <table id="table-subjectList" class="table table-striped">        
        <thead>
            <tr>
                
                <td class="text-center font-roboto color-a2">SUBJECT CODE</td>
                <td class="text-center font-roboto color-a2">DESCRIPTION</td>
                <td class="text-center font-roboto color-a2">UNITS</td>
                <td class="text-center font-roboto color-a2">TIME</td>
                <td class="text-center font-roboto color-a2">ACTION</td>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($data as $subj){
                    $id = $subj['idsubject'];
                    $code = $subj['subject_code'];
                    $description = $subj['subject_description'];
                    $units = $subj['units'];
                    $time_start = $subj['time_start'];
                    $time_end = $subj['time_end'];
                
                echo "
                    <tr>
                    
                        <td class='text-center font-roboto color-a2'>$code</td>
                        <td class='text-center font-roboto color-a2'>$description</td>
                        <td class='text-center font-roboto color-a2'>$units</td>
                        <td class='text-center font-roboto color-a2' id='sample'>$time_start-$time_end</td>
                        <td class='text-center font-roboto color-a2'>
                        ";
             
                    
                    echo "<a data-toggle='tooltip' data-placement='top' title='Student List' class='btn btn-info' href='reports/questionnairelistreports/$id' style='width:77px;'>
                            <i class='material-icons'>person_box</i>
                        </a>"; 
                   
                      
                echo "  </td>
                    </tr>
                    ";       
                        
                }
            ?>
                
        </tbody>
    </table>
</div> <!-- end user sujbect list div -->
