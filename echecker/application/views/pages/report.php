<?php
    /*
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    */
?>

<?php
    if(isset($_SESSION["users"][0]["position"])){
        if($_SESSION["users"][0]["position"] == "2"){
            echo '
                <div class="row report-chart-list" style="margin-top:50px;">
                
                <div style="" class="report-charts-section" >
                    
                </div>
                </div>
                <div class="row">
                    <button data-toggle="tooltip" data-placement="top" title="Hide Chart" class="btn-report-show-departmentlist-table btn btn-info">
                        <span>HIDE CHART</span><i class="material-icons">keyboard_arrow_up</i>
                    </button>
                </div>
            ';
        }
    }
    
?>


<div class="row report-table-list">
<h5><b>TEACHER LIST:</b></h5>

<table id="table-studentslist" class="table table-striped" style='width:100%;'>        
    <thead>
        <tr>
            
            <td class="text-center font-roboto color-a2"></td>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">NAME</td>
            <td class="text-center font-roboto color-a2">SUBJECTS HANDLED</td>
            <td class="text-center font-roboto color-a2">PASSING RATE</td>
            
            <td class="text-center font-roboto color-a2">ACTION</td>
        </tr>
    </thead>
    <tbody class="student-list-tablebody">
        <?php
            $totalSubject = 0;
            if($data){
                foreach($data as $u){
                    $id = $u['idusers'];
                    $code = $u['code'];
                    $firstname = $u['firstname'];
                    $middlename = $u['middlename'];
                    $lastname = $u['lastname'];
                    $subjectCount = $u['subjectcount'];
                    
                    $totalSubject += $subjectCount;
                    $image = (($u['image'] == "") ? "default.png" : $u['image']);

                        echo "
                            <tr>
                                <td class='text-center'><img src='assets/uploads/" . $image .  "' style='height:100px;width:100px;margin:5px;'></td>
                                <td class='text-center'>$code</td>
                                <td class='text-center'>$lastname, $firstname $middlename</td>
                                <td class='text-center'>$subjectCount</td>
                                <td class='text-center'><div style='overflow:auto;margin:0 auto;'><table style='background-color:none;margin:0 auto;'>";
                                
                                if(isset($u["passing_rate"])){
                                    if($u["passing_rate"] != null){
                                        foreach($u["passing_rate"] as $key => $value){
                                            if(isset($u["subject_code"])){
                                                echo "<tr><td>".$u["subject_code"][$key]." :</td><td> ".number_format($u["passing_rate"][$key],2)."%</td></tr>";
                                            }else{
                                                echo "<tr style='background-color:none;'><td style='background-color:none;'>No Record</tr></td>";
                                            }
                                        }
                                    }else{
                                        echo "<tr style='background-color:none;'><td style='background-color:none;'>No Record</tr></td>";
                                    }
                                }else{
                                    echo "<tr style='background-color:none;'><td style='background-color:none;'>No Record</tr></td>";
                                }
                                
                        echo "</table></div></td>
                               
                                <td class='text-center'>
                                    <form action='reports/reportteachersubjectList' method='GET'>
                                        <input type='hidden' name='idusers' value='$id'>
                                        <button data-toggle='tooltip' data-placement='top' title='View Subject List' class='btn-reportteachersubjectList btn btn-info' type='submit'>
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