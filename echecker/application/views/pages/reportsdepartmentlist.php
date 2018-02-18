<?php
    //print_r($data);

?>
<span class="brand" style="font-size:20px;">PROGRAM LIST:</span>
<table id="table-professorslist" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">CODE</td>
            <td class="text-center font-roboto color-a2">DEAN NAME</td>
            <td class="text-center font-roboto color-a2">PROGRAM</td>
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