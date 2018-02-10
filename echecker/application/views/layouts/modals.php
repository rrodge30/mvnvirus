



<div id="modal-dynamic" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="mdl-title"></h5>
      </div>
      <div class="modal-body">
    
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

<div id="modal-dynamic-secondary" class="modal fade">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="width:100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="mdl-secondary-title"></h5>
      </div>
      <div class="modal-secondary-body">
      
        
      </div>
      <div class="modal-secondary-footer">
        
      </div>
    </div>
  </div>
</div>

<!-- modal start -->
<div id="modal-static-examine" class="modal fade">
        <div class="modal-dialog" role="document" style="width:100% !important;height:100% !important;overflow-y:scrollable !important;z-index:999 !important;position:absolute !important;margin:0px !important;padding:0px !important;left:0px !important;right:0px !important;">
            <div class="modal-content">
            <div class="modal-header">

                
                <h5 class="modal-title" id="mdl-title"></h5>
            </div>
            <div class="modal-body">
                <!-- start body -->
                <div id="examine-container">
                        <!-- content --> 
                        <div class="card card-stats">
                            <!-- /*<div class="card-header" data-background-color="blue">
                                <i class="material-icons">clock</i>
                            </div> -->
                            <div class="card-content">
                                <div class="row">
                                    <div class="clock" style="margin:2em;"></div>
                                </div>
                                <h3 class="title"><?=$data["questionaire_title"]?></h3>
                                <p class="category"><?=$data["questionaire_description"]?></p>
                                
                            </div>
                            <div class="card-footer col-md-12">
                                
                            </div>
                        </div>

                        <!-- tab start -->
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
                                        /*echo '<pre>';
                                        print_r($data);
                                        echo '</pre>';
                                        */
                                        foreach($data["questionaire_type"] as $key=>$value){
                                            
                                            echo '<div role="tabpanel" class="tab-pane fade in '.(($key == 0) ? "active" : "").'" id="tab-examine'.$key.'">';
                                                //bouchie tabpanel start
                                            echo '
                                                <div class="container col-md-12">
                                                
                                                <input type="hidden" name="idquestionaire" id="input-idquestionaire" value="'.$data["idquestionaire"].'">
                                                
                                                    <div class="row col-md-12">
                                                        <div class="col-md-10 bhoechie-tab-container template'.$key.'">
                                                            <div class="col-md-2 bhoechie-tab-menu btmenu-template'.$key.'">
                                                                <div class="list-group">';
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

                                                                    echo '<div class="btcontent-template-tab'.$key.' bhoechie-tab-content '.(($i == 0) ? "active" : "").'">
                                                                            <center>
                                                                                <h1 class="glyphicon glyphicon-question-sign" style="font-size:4em;color:#55518a"></h1>
                                                                                <h2 style="margin-top: 0;color:#55518a">Question no. '.($i+1).'</h2><br><br>
                                                                            </center>
                                                                            
                                                                            <div style="border-left:3px solid #337ab7;border-bottom:1px solid #337ab7;padding:10px" class="col-md-12">
                                                                                <h3 style="margin-top: 0;color:#55518a">'.$data["questionaire_type"][$key]["question"][$i]["question_title"].'</h3>
                                                                            </div><br><br>
                                                                            ';
                                                                            if($data["questionaire_type"][$key]["questionaire_type"] == 0){
                                                                                echo '<div>';
                                                                                foreach($data["questionaire_type"][$key]["question"][$i]["choices"] as $j => $value){
                                                                                    echo '<div class="radio">
                                                                                            <label>
                                                                                                <input type="radio" class="answer'.$key.'-'.$i.'" name="answer'.$key.'-'.$i.'" value="'.$value["choices_description"].'" required="required" data-type="'.$data["questionaire_type"][$key]["questionaire_type"].'">
                                                                                                '.$value["choices_description"].'
                                                                                            </label>
                                                                                        </div>';   
                                                                                }
                                                                                echo '</div>';
                                                                            }

                                                                            if($data["questionaire_type"][$key]["questionaire_type"] == 1){
                                                                                
                                                                                    echo '<div class="form-group col-md-12">
                                                                                            <label>Answer:</label>
                                                                                            <div class="form-group label-floating">
                                                                                                <label class="control-label">Enter your answer here. . . .</label>
                                                                                                <textarea class="form-control answer'.$key.'-'.$i.'" rows="5" required="required" data-type="'.$data["questionaire_type"][$key]["questionaire_type"].'"></textarea>
                                                                                            </div>
                                                                                        </div>';

                                                                            }
                                                                            echo '<input type="hidden" name="idquestion" id="input-idquestion-tabno'.$key.'-'.$i.'" value="'.$data["questionaire_type"][$key]["question"][$i]["idquestion"].'">';
                                                                            
                                                                            echo '<span class="span-next-item'.$key.' item-'.$i.'">
                                                                                    <button class="btn-success btn pull-right btn-next-item" form="frm-examine" data-tabno="'.$key.'" data-item="'.$i.'">
                                                                                        <span class="material-icons">playlist_add_check</span>
                                                                                    </button>
                                                                                </span>';   
                                                                    echo '</div>';
                                                                }   
                                                                
                                                            
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
                    </div>
                <!--  body end-->
            </div>
            <div class="modal-footer">
                
            </div>
            </div>
        </div>
        </div>
    <!-- modal end -->