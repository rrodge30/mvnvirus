<?php
    /*
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    */
?>
<div class="row report-chart-list" style="margin-top:50px;margin-bottom:50px;">
    
    <div style="magin-top:25px;max-height:700px;overflow-y:auto;" class="report-charts-section">
        
    </div>
</div>
<div class="row">
    <button data-toggle='tooltip' data-placement='top' title='Hide Chart' class='btn-report-show-departmentlist-table btn btn-info'>
         <span>HIDE CHART</span><i class='material-icons'>keyboard_arrow_up</i>
    </button>
</div>
<div class="row report-table-list">
    <span class="brand roboto" style="font-size:20px;margin:50px;">PROGRAM LIST:</span>
    <div style="margin-top:50px;">
        <table id="table-professorslist" class="table table-striped">        
            <thead>
                <tr>
                    <td class="text-center font-roboto color-a2"></td>
                    <td class="text-center font-roboto color-a2">CODE</td>
                    <td class="text-center font-roboto color-a2">DEAN NAME</td>
                    <td class="text-center font-roboto color-a2">PROGRAM</td>
                    <td class="text-center font-roboto color-a2">PASSING RATE</td>
                    <td class="text-center font-roboto color-a2">ACTION</td>
                </tr>
            </thead>
            <tbody class="professor-list-tablebody">
                <?php
                    if($data){
                        foreach($data as $u){
                            
                            $id = $u['idusers'];
                            $code = $u['code'];
                            $firstname = $u['firstname'];
                            $middlename = $u['middlename'];
                            $lastname = $u['lastname'];
                            $department = $u['department'];
                            $user_level = $u['user_level'];
                            $image = (($u['image'] == "") ? "default.png" : $u['image']);
                            if($user_level == '2'){
                                echo "
                                    <tr>  
                                        <td class='text-center'><img src='assets/uploads/" . $image .  "' style='height:100px;width:100px;margin:5px;'></td>
                                        <td class='text-center'>$code</td>
                                        <td class='text-center'>$lastname, $firstname $middlename</td>
                                        <td class='text-center'>$department</td>
                                        <td class='text-center'>
                                            <div class='col-md-12'><table style='overflow:auto' class='col-md-12'>
                                        ";
                                            if(isset($u["faculty"])){
                                                foreach($u["faculty"] as $key => $value){
                                                    echo '<tr>
                                                            <td>
                                                                '.$value["faculty_name"].'
                                                            </td>
                                                            <td>
                                                                :'.$value["passing_rate"].'%
                                                            </td>
                                                        </tr>
                                                    ';
                                                }
                                            }else{
                                                echo "<tr><td>NO RECORD</td></tr>";
                                            }
                                echo    "  </table></div></td>
                                        <td class='text-center'>
                                            <a data-toggle='tooltip' data-placement='top' title='View Programs Teachers List' href='reports/reportsdepartmentteacherlist/$department' class='btn btn-info'>
                                                <i class='material-icons'>remove_red_eye</i>
                                            </a>
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
</div>
