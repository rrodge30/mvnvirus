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
    /*
    echo "<pre>";
    print_r($_SESSION["users"]);
    echo "</pre>";
*/

?>
 
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header" style="padding-right:50px;">
                               
                                    
                                    <div class="row" style="margin-left:50px;margin-top:50px;">
                                        <div class="col-md-3">
                                            <div id="morning-greetings">
                                                <img src="assets/images/morning.png" style="height:150px;width:150px">
                                                <h4 class="title">Goodmorning <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                                
                                            </div>
                                            <div id="afternoon-greetings" style="display:hidden;">
                                                <img src="assets/images/afternoon.png" style="height:150px;width:150px">
                                                <h4 class="title">Goodafternoon <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                                
                                            </div>
                                            <div id="evening-greetings" style="display:hidden;">
                                                <img src="assets/images/evening.png" style="height:150px;width:150px">
                                                <h4 class="title">Goodevening <?=ucwords($_SESSION['users']['user']);?> !</h4>
                                                
                                            </div>
                                        </div>
                                        </div>
                                    <!-- questionnaireValidation -->
                                    
                                    <div class="row" style="overflow-x:scroll;margin-left:50px;margin-top:25px;">
                                        <?php
                                            if($_SESSION["users"]["user_level"] == "2" && $_SESSION["users"][0]["position"] == "2")
                                            if($data["questionnaireValidation"]){
                                                foreach($data["questionnaireValidation"] as $key => $value){
                                                    $questionnaire_title = $value["questionaire_title"];
                                                    $questionnaire_description = $value["questionaire_description"];
                                                    $teacher_firstname = $value["firstname"];
                                                    $idquestionnaire = $value["idquestionaire"];
                                                    echo '
                                                        <div class="col-lg-3 col-md-6 col-sm-6">
                                                            <div class="card card-stats">
                                                                <div class="card-header" data-background-color="blue">
                                                                    <i class="fa fa-bell"></i>
                                                                    <span class="notification">'.($key+1).'</span>
                                                                </div>
                                                                <div class="card-content">
                                                                <h3 class="title"><a href="notifications/viewquestionnaire/'.$idquestionnaire.'">'.$questionnaire_title.'</a></h3>
                                                                    <p class="category">'.$questionnaire_description.'</p>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="stats">
                                                                        <i class="material-icons">update</i> New Questionnaire for Validation from <b>'.strtoupper($teacher_firstname).'</b>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                    
                                                }
                                            }
                                        ?>
                                        </div>
                                    <!-- NOTIFICATION END -->
                                    
                                        <div class="row" style="margin:50px;">
                                            <?php
                                                if($_SESSION['users']['user_level'] == '99' || $_SESSION['users']['user_level'] == '3'){
                                                    echo '<button data-toggle="tooltip" data-placement="top" title="Edit Announcements" id="btn-update-bulletin" class="pull-right btn btn-success">Change Message</button>';
                                                }
                                            ?>
                                        </div>
                                        <div class="row" style="margin:50px;">
                                            <div id="tb-testimonial" class="testimonial testimonial-primary pull-right">
                                                <div class="testimonial-section">
                                                    <?=$data['message'][0]["message"];?>
                                                </div>
                                                <div class="testimonial-desc">
                                                    <img src="assets/img/logo.jpg" alt="" />
                                                    <div class="testimonial-writer">
                                                        <div class="testimonial-writer-name">School Administrator</div>
                                                        <div class="testimonial-writer-designation">JMC Admin</div>
                                                        <a href="#" class="testimonial-writer-company">Jose Maria College</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                           
                                    </div>
                                    <div class="col-md-6">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

                

<div class="row">


</div>
            
            
           
