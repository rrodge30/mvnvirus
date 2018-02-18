<?php
    if($_SESSION['users']['user_level'] == "99"){
        $displayUserLevel = "admin";
    }else if($_SESSION['users']['user_level'] == "1"){
        $displayUserLevel = "Student";
    } else if($_SESSION['users']['user_level'] == "2"){
        if($_SESSION['users'][0]["position"] == "1"){
            $displayUserLevel = "Faculty";
        }else{
            $displayUserLevel = "Dean";
        }

    }else if($_SESSION['users']['user_level'] == "3"){
        $displayUserLevel = "Vpaa";
    }else{
        $displayUserLevel = "Guest";
    }
    
    //print_r($_SESSION["users"]);
?>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
        <img src="assets/uploads/<?=(($_SESSION["users"]["image"] == "") ? "default.png" : $_SESSION["users"]["image"])?>" alt="" style="height:200px;width:200px;">
        
        </div>
        <div class="col-md-9" style="margin-top:50x;padding-top:25px;">
            <?php
                if($_SESSION["users"]["user_level"] == "2" || $_SESSION["users"]["user_level"] == "1"){
            ?>
            <div>
                <span class="category font-roboto" style="width:200px;">name :</span><span><?=ucfirst($_SESSION["users"][0]["firstname"]).' '.ucfirst($_SESSION["users"][0]["middlename"]).' '.ucfirst($_SESSION["users"][0]["lastname"]);?></span>
            </div>
            <?php
                }
            ?>
            <div>
                <p class="category"><?=ucfirst($displayUserLevel)?></p>
            </div>
            <?php
                if($_SESSION["users"]["user_level"] == "2" || $_SESSION["users"]["user_level"] == "1"){
            ?>
            <div>
                <p class="category"><?=ucfirst($_SESSION["users"][0]["department"])?></p>
            </div>
            <?php
                }
            ?>
            <?php
                if($_SESSION["users"]["user_level"] == "1"){
                    $department = $_SESSION["users"][0]["department"];
                    $course = $_SESSION["users"][0]["course"];
                    $yearlevel = $_SESSION["users"][0]["year_level"];
                    echo "
                    
                        <div>
                            <p class='category'>$course</p>
                        </div>
                        <div>
                            <p class='category'>$yearlevel</p>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>

    <div class="row">
        <label class="control-label"><h3><b>UPLOAD PROFILE PHOTO</b></h3></label>
        <input id="upload-user-image-profile" name="usersFile" type="file" multiple class="file-loading">
    </div>
</div>
