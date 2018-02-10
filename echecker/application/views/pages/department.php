<?php

?>
<button data-toggle='tooltip' data-placement='top' title='Add Department' class='pull-right btn-add-department btn btn-success' type='button' name='create' onclick='return false;'>
    <i class='material-icons'>add</i>
</button>
<table id="table-departmentlist" class="table table-striped">        
    <thead>
        <tr>
            <td class="text-center font-roboto color-a2">ID</td>
            <td class="text-center font-roboto color-a2">DEPARTMENT NAME</td>
            <td class="text-center font-roboto color-a2">DESCRIPTION</td>
            <td class="text-center font-roboto color-a2">ACTION</td>

        </tr>
    </thead>
    <tbody>
        <?php
            foreach($data as $dept){
                $id = $dept['iddepartment'];
                $name = $dept['department_name'];
                $description = $dept['description'];
                ;
            
            echo "
                <tr>
                    <td class='text-center font-roboto color-a2'>$id</td>
                    <td class='text-center font-roboto color-a2'>$name</td>
                    <td class='text-center font-roboto color-a2'>$description</td>
                    <td class='text-center font-roboto color-a2'>
                        
                        <button data-id='$id' data-toggle='tooltip' data-placement='top' title='Update' class='btn-update-department btn btn-info' type='button' name='update' onclick='return false;'>
                            <i class='material-icons'>update</i>
                        </button>
                        <button href='departments/deletedepartment' data-id='$id' data-toggle='tooltip' data-placement='top' title='Delete' class='btn-delete-department btn btn-danger' type='submit' name='deletedepartment' onclick='return false;'>
                            <i class='material-icons'>delete</i>
                        </button>
                    
                    </td>
                </tr>
                ";
            }
        ?>
            
    </tbody>
</table>