<?php
/*
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  */  
?>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-chart" data-background-color="purple">
                <h5 class="title" style="padding:15px;">
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TITLE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_title"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DESCRIPTION
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_description"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DATE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_date"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TIME
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_time"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                DURATION
                            </p>
                        </div>
                        <?php
                            $seconds = $data["questionaire_duration"];
                            $hours = sprintf("%02d", (floor($seconds / 3600)));
                            $minutes = sprintf("%02d", (floor(($seconds / 60) % 60)));
                            $seconds = sprintf("%02d", ($seconds % 60));
                        ?>
                        <div class="col-md-10">
                            <p class="category">
                                <?="$hours:$minutes:$seconds"?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                                TOTAL SCORE
                            </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category">
                                <?=$data["questionaire_total_score"]?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                        <p class="category">
                               SCORE
                        </p>
                        </div>
                        <div class="col-md-10">
                            <p class="category" id="reports-user-total-score">
                                <?=$data["user_total_score"]?>
                            </p>
                        </div>
                    </div>
                </h5>
            
            </div>
            <div class="card-content">
                <!-- tab content start    -->

                <div class="col-md-12">
                    <ul class="nav nav-tabs tab-nav-right" role="tablist" style="margin-bottom:50px;">
                        <!-- tab header -->
                        
                       
                        <?php
                            if($data["questionaire_type"]){
                                foreach($data["questionaire_type"] as $key=>$value){
                                    echo '<li role="presentation" class="tab-examine tabno'.$key.' '.(($key == 0) ? "active" : "").'" style="width:20%;">
                                            <a href="#tab-examine'.$key.'" data-toggle="tab">
                                                <span>'.$value["questionaire_type_title"].' - '.(($value["questionaire_type"] == 0) ? "MULTIPLE CHOICE" : "ESSAY").'</span>
                                            </a>
                                        </li>';
                                }
                            }
                            
                        ?>                        
                        
                        <!-- tab header end -->
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content col-md-12">
                        
                        <!-- tab content -->
                        <?php
                            if($data["questionaire_type"]){
                                foreach($data["questionaire_type"] as $key=>$value){
                                    
                                    echo '<div role="tabpanel" class="tab-pane fade in '.(($key == 0) ? "active" : "").'" id="tab-examine'.$key.'">';
                                        //bouchie tabpanel start
                                    echo '
                                        <div class="container col-md-12">
                                        <div class="row">
                                            <span class="title">TOTAL POINTS:</span><span class="category">'.($data["questionaire_type"][$key]["questionaire_type_total_item"]).'</span>
                                        </div>
                                        <div class="row">
                                        <span class="title">POINTS PER ITEM:</span><span class="category">'.($data["questionaire_type"][$key]["questionaire_type_item_points"]).'</span>
                                        </div>
                                        
                                        <input type="hidden" name="idquestionaire" id="input-idquestionaire" value="'.$data["idquestionaire"].'">

                                            <div class="row col-md-12">
                                                <div class="col-md-10 bhoechie-tab-container template'.$key.'">
                                                    <div class="col-md-2 bhoechie-tab-menu btmenu-template'.$key.'">
                                                        <div class="list-group" style="max-height:750px;overflow-y:scroll;overflow-x:hidden;">';
                                                            //bouche tab header
                                                            foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                                echo '<a href="#" class="list-group-item '.(($i == 0) ? "active" : "").' text-center" data-tab="'.$key.'">
                                                                        <h4 class="glyphicon glyphicon-tags"></h4><br/><b>'.($i+1).'</b>
                                                                    </a>';
                                                            }
                                                            //bouchie tab header end
                                                    echo ' </div>
                                                    </div>
                                                    <div class="col-md-10 bhoechie-tab">';
                                                        foreach($data["questionaire_type"][$key]["question"] as $i => $iValue){
                                                            echo '
                                                                
                                                                ';
                                                            if(isset($iValue["user_answer"][$i])){

                                                                echo '<input type="hidden" id="report-idquestionuseranswer'.$key.'-'.$i.'" value="'.$iValue["user_answer"][0]["idquestionuseranswer"].'">';
                                                            }

                                                            echo '<div class="btcontent-template-tab'.$key.' bhoechie-tab-content '.(($i == 0) ? "active" : "").'">
                                                                    <center>
                                                                        <h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>
                                                                        <h2 style="margin-top: 0;color:#55518a">Question no. '.($i+1).'</h2><br><br>
                                                                    </center>
                                                                    
                                                                    <div style="border-left:3px solid #337ab7;border-bottom:1px solid #337ab7;padding:10px" class="col-md-12">
                                                                        <h3 style="margin-top: 0;color:#55518a">'.$data["questionaire_type"][$key]["question"][$i]["question_title"].'</h3>
                                                                    </div><br><br>
                                                                    <input type="hidden" id="report-idquestion'.$key.'-'.$i.' value="'.$iValue["idquestion"].'">
                                                                    ';
                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 0){
                                                                        if(count($iValue["user_answer"]) > 0 && !empty($iValue["user_answer"])){
                                                                            if($iValue["user_answer"][0]["answer"] != null){
                                                                                $answer = $iValue["user_answer"][0]["answer"];
                                                                            }else{
                                                                                $answer = "No Answer";
                                                                            }
                                                                        }else{
                                                                            $answer = "No Answer";
                                                                        }
                                                                        echo '<div>
                                                                            <div class="row">';
                                                                         echo'   <div class="col-md-6">
                                                                                    <h5 class="title">
                                                                                        CHOICES:
                                                                                    </h5>';
                                                                                    foreach($data["questionaire_type"][$key]["question"][$i]["choices"] as $j => $jValue){
                                                                                        echo '<div class="category">
                                                                                                '.$jValue["choices_description"].'
                                                                                            </div>';   
                                                                                    }
                                                                                    echo '    
                                                                                    <h5 class="title">
                                                                                        CORRECT ANSWER:
                                                                                    </h5>
                                                                               
                                                                                    
                                                                                    <p class="category">
                                                                                        '.$iValue["answer"][0]["answer"].'
                                                                                    </p>
                                                                               
                                                                             
                                                                                    <h5 class="title">
                                                                                        YOUR ANSWER:
                                                                                    </h5>
                                                                              
                                                                          
                                                                                    <p class="category">
                                                                                        '.$answer.'
                                                                                    </p>
                                                                                ';
                                                                        echo'    </div>';
                                                                        
                                                                        
                                                                        echo '
                                                                        <div class="col-md-6">
                                                                            <div>
                                                                                <h5 class="title">
                                                                                    MARK:
                                                                                </h5>
                                                                            </div>
                                                                            <div>
                                                                                <p class="category">
                                                                                    <span class="pull-left">
                                                                                        <i class="material-icons">'.(($iValue["answer"][0]["answer"] == $answer) ? "circle_check":"close").'</i>
                                                                                    </span>'.(($iValue["answer"][0]["answer"] == $answer) ? "Correct !":"Wrong !").'
                                                                                </p>
                                                                            </div>
                                                                            <div><h5 class="title">
                                                                            POINT/S:
                                                                            </h5>

                                                                            </div>
                                                                            <div class="category">
                                                                            
                                                                                '.(($iValue["answer"][0]["answer"] == $answer) ? $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["question_score"]:"0").'
                                                                            </div>
                                                                        </div>


                                                                        </div>
                                                                        </div>';
                                                                    }
                                                                    
                                                                    if($data["questionaire_type"][$key]["questionaire_type"] == 1){
                                                                            echo '  <div class="col-md-12">
                                                                                    <div class="row">
                                                                                    <div col-md-6>
                                                                                    <div class="title">
                                                                                        HINT SENTENCE / WORD:
                                                                                    </div>';
                                                                                    if(($data["questionaire_type"][$key]["question"][$i]["user_answer"] !== null) && !empty($data["questionaire_type"][$key]["question"][$i]["user_answer"])){
                                                                                        $userAnswer = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["answer"];
                                                                                        foreach($data["questionaire_type"][$key]["question"][$i]["answer"] as $j => $jValue){
                                                                                            $answer = $jValue["answer"];
                                                                                            echo '<div class="category">
                                                                                                    '.$jValue["answer"].' = '. preg_match_all("/\b($answer)\b/",$userAnswer) . ' found' . '
                                                                                                </div>';
                                                                                        }
                                                                                    }else{
                                                                                        foreach($data["questionaire_type"][$key]["question"][$i]["answer"] as $j => $jValue){
                                                                                            $answer = $jValue["answer"];
                                                                                            echo '<div class="category">
                                                                                                    '.$jValue["answer"].' = no answer
                                                                                                </div>';
                                                                                        }
                                                                                    }
                                                                                               
                                                                                
                                                                                echo '
                                                                                    </div>
                                                                                    
                                                                                    </div>
                                                                                    
                                                                                    ';
                                                                                echo '<div class="row">
                                                                                        <div class="title">
                                                                                            <span>YOUR SCORE: </span><p id="user-essay-item-score">'.((($data["questionaire_type"][$key]["question"][$i]["user_answer"] !== null) && (!empty($data["questionaire_type"][$key]["question"][$i]["user_answer"]))) ? ceil($iValue["user_answer"][0]["question_score"]) : "no answer").'</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    ';    
                                                                                
                                                                                 echo'<div class="row">

                                                                                        <div class="title">
                                                                                            YOUR ANSWER:
                                                                                        </div>
                                                                                        
                                                                                        <div class="col-md-12">';
                                                                                if(($data["questionaire_type"][$key]["question"][$i]["user_answer"] !== null) && !empty($data["questionaire_type"][$key]["question"][$i]["user_answer"])){
                                                                                    $userAnswer = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["answer"];            
                                                                                    $arrGivenAnswer = $data["questionaire_type"][$key]["question"][$i]['answer'];
                                                                                    
                                                                                    for($j=0;$j<count($arrGivenAnswer);$j++){
                                                                                        $givenAnswer = $arrGivenAnswer[$j]["answer"];
                                                                                        $userAnswer = preg_replace("/\b($givenAnswer)\b/",'<span style="background-color:yellow;">$1</span>',$userAnswer);
                                                                                    }
                                                                                    echo $userAnswer; 
                                                                                }else{
                                                                                    echo "no answer";
                                                                                }
                                                                                          
                                                                                echo '        </div>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                ';
                                                                                $dataIdUserQuestionnaire = $data["iduserquestionaire"];
                                                                                
                                                                                $dataQuestionItemPoints = $data["questionaire_type"][$key]["questionaire_type_item_points"];
                                                                                $dataIdquestion = $data["questionaire_type"][$key]["question"][$i]["idquestion"];
                                                                                $dataIdusers = $data["idusers"];
                                                                                if(($data["questionaire_type"][$key]["question"][$i]["user_answer"] !== null) && !empty($data["questionaire_type"][$key]["question"][$i]["user_answer"])){
                                                                                    $dataIdQuestionnaireUserAnswer = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["idquestionuseranswer"];
                                                                                    $dataQuestionScore = $data["questionaire_type"][$key]["question"][$i]["user_answer"][0]["question_score"];
                                                                                   
                                                                                }
                                                                             

                                                                    }
                                                                    echo '<input type="hidden" name="idquestion" id="input-idquestion-tabno'.$key.'-'.$i.'" value="'.$data["questionaire_type"][$key]["question"][$i]["idquestion"].'">';
                                                                    
                                                                    
                                                            echo '<br></div>';
                                                        }   
                                                        echo '
                                                            <br><br><br>
                                                                            
                                                                    ';
                                                    
                                                echo '    </div>
                                                </div>
                                            </div>
                                        </div>';
                                    
                                        //bouchie tabpanel start end
                                    echo '</div>';
                                    
                                }
                            }
                            
                        ?>
                        
                        <!-- tab content end  -->
                    </div>
                </div>





                <!-- tab content end    -->
            </div>
            <div class="card-footer">
               
            </div>
        </div>
    </div>
                       
</div>










<?php

?>