<?php
    if(isset($data["questionaire_duration"])){
        $Durationtime = $data["questionaire_duration"];
        $hours = floor($Durationtime / 3600);
        $mins = floor($Durationtime / 60 % 60);
        $secs = floor($Durationtime % 60);
        $timeFormat = sprintf('%02d:%02d:%02d', $hours, $mins, $secs);
    }
    /*
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    */
?>
<!-- tab start -->
<form method="POST" id="frm-examine">
    <div class="row col-md-12">
        <div class="col-md-12">
            <div class="row">
                <input type="hidden" name="duration" id="countdownduration" value="<?=$data["questionaire_duration"]?>">
            </div>
            
            <div id="examine-content" style="height:100%;width=100% !important;">
                <div id="agreement-container">
                    <div class="card card-profile">
                       
                        <div class="content">
                            <h4 class="card-title"><?=$data["questionaire_title"]?></h4>
                            <h4 class="card-title"><?=$data["questionaire_description"]?></h4><br><br>
                            <h2 class="card-title"><?=$timeFormat?></h2><br><br>
                            <h6 class="category text-gray"><span>Instruction: </span><?=$data["questionaire_instruction"]?></h6>
                            <p class="card-content">
                                <h5 class="category">Once you click the button your examination time starts to countdown.</h5>
                                <h3 class="title"><b>WARNING !</b>Attempting to access any other tab or application during exam will make your examination invalid.</h3>
                            </p>
                            <div class="card-footer">
                            
                                <button type="button" class="btn btn-primary btn-round button-fullscreen">Start</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
                <!-- content  end-->

        </div>
        
    </div>
    <!-- tab end -->
    
</form>

