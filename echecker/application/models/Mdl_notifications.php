
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_notifications extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    

    public function unapprovedQuestionaireList(){
    
     
        if($_SESSION["users"][0]["position"] == "2"){
            $examData = array();
            
            $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                ->join('users','user_subjecttbl.UID = users.idusers','left')
                ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('users.user_level','2')
                ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
                ->where('questionairetbl.questionaire_status','waiting for confirmation')
                ->group_by('questionairetbl.idquestionaire')
                ->get('questionairetbl');
            if($questionaireData = $query->result_array()){
    
                foreach($questionaireData as $q => $qValue){
                    $query = $this->db->where('questionaire_id', $qValue["idquestionaire"])
                                ->get('user_questionairetbl');
                    $userQuestionaireData = $query->result_array();
                    foreach($questionaireData[$q] as $key => $value){
                        $examData[$q][$key] = $value;
                    }
                    if($userQuestionaireData){
                        $examData[$q]["user_questionaire"] = $userQuestionaireData;
                    }
                    $query = $this->db->where('idquestionaire',$qValue["idquestionaire"])
                        ->get('questionaire_typetbl');
                    if($questionaireTypeData = $query->result_array()){ 
    
                        foreach($questionaireTypeData as $key => $value){
                            $examData[$q]["questionaire_type"][$key] = $value;
    
                            $query = $this->db->where('idquestionaire_type',$examData[$q]["questionaire_type"][$key]["idquestionairetype"])
                            ->get('questiontbl');
                            if($questionData = $query->result_array()){
                                for($i=0;$i<count($questionData);$i++){
                                    
                                    
                                    $examData[$q]["questionaire_type"][$key]["question"][$i] = $questionData[$i];
    
                                    $query = $this->db->join('user_answertbl','question_user_answertbl.iduseranswer = user_answertbl.iduseranswer')
                                                            ->where('question_user_answertbl.idquestion',$questionData[$i]["idquestion"])
                                                            ->where('user_answertbl.iduser',$qValue["idusers"])
                                                        ->get("question_user_answertbl");
                                    
                                    if($userAnswer = $query->result_array()){
                                        
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["user_answer"] = $userAnswer;
                                        
                                    }
    
                                    if($examData[$q]["questionaire_type"][$key]["questionaire_type"] == "0"){
                                        $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                        ->get('question_choicestbl');
                                        
                                        if($choicesData = $query->result_array()){
                                            for($j=0;$j<count($choicesData);$j++){
                                                $examData[$q]["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];
                                                
                                            }
                                        }
    
                                    }
                                    
                                    $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                    ->get('question_answertbl');
                                    if($answerData = $query->result_array()){
                                        
                                        for($j=0;$j<count($answerData);$j++){
                                            $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                        }
                                        
                                    }else{
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["answer"] = "";
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["idquestion_answer"] = "";
                                    }
                                    
                                }
                            }
                        }
                        
                    }
                }
                
            }  
            
            
        }else if($_SESSION["users"][0]["position"] == "1"){
            $examData = array();
            
            $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                ->join('users','user_subjecttbl.UID = users.idusers','left')
                ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('user_subjecttbl.UID',$_SESSION["users"]["idusers"])
                ->where('questionairetbl.questionaire_status','unapproved')
                ->group_by('questionairetbl.idquestionaire')
                ->get('questionairetbl');
            if($questionaireData = $query->result_array()){
    
                foreach($questionaireData as $q => $qValue){
                    $query = $this->db->where('questionaire_id', $qValue["idquestionaire"])
                                ->get('user_questionairetbl');
                    $userQuestionaireData = $query->result_array();
                    foreach($questionaireData[$q] as $key => $value){
                        $examData[$q][$key] = $value;
                    }
                    if($userQuestionaireData){
                        $examData[$q]["user_questionaire"] = $userQuestionaireData;
                    }
                    $query = $this->db->where('idquestionaire',$qValue["idquestionaire"])
                        ->get('questionaire_typetbl');
                    if($questionaireTypeData = $query->result_array()){ 
    
                        foreach($questionaireTypeData as $key => $value){
                            $examData[$q]["questionaire_type"][$key] = $value;
    
                            $query = $this->db->where('idquestionaire_type',$examData[$q]["questionaire_type"][$key]["idquestionairetype"])
                            ->get('questiontbl');
                            if($questionData = $query->result_array()){
                                for($i=0;$i<count($questionData);$i++){
                                    
                                    
                                    $examData[$q]["questionaire_type"][$key]["question"][$i] = $questionData[$i];
    
                                    $query = $this->db->join('user_answertbl','question_user_answertbl.iduseranswer = user_answertbl.iduseranswer')
                                                            ->where('question_user_answertbl.idquestion',$questionData[$i]["idquestion"])
                                                            ->where('user_answertbl.iduser',$qValue["idusers"])
                                                        ->get("question_user_answertbl");
                                    
                                    if($userAnswer = $query->result_array()){
                                        
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["user_answer"] = $userAnswer;
                                        
                                    }
    
                                    if($examData[$q]["questionaire_type"][$key]["questionaire_type"] == "0"){
                                        $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                        ->get('question_choicestbl');
                                        
                                        if($choicesData = $query->result_array()){
                                            for($j=0;$j<count($choicesData);$j++){
                                                $examData[$q]["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];
                                                
                                            }
                                        }
    
                                    }
                                    
                                    $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                    ->get('question_answertbl');
                                    if($answerData = $query->result_array()){
                                        
                                        for($j=0;$j<count($answerData);$j++){
                                            $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                        }
                                        
                                    }else{
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["answer"] = "";
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["idquestion_answer"] = "";
                                    }
                                    
                                }
                            }
                        }
                        
                    }
                }
                
            }  
        }
        return $examData;
    }

    public function viewquestionnaireById($data=false){
       
        /*$questionairesData = array();
        
        $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                    ->where('questionaire_status','unapproved')
                    ->where('idquestionaire',$data)
                    ->get('questionairetbl');
        */
        $examData = array();
        $status = "";
        if($_SESSION["users"][0]["position"] == "1"){
            $status = "unapproved";
        }else if($_SESSION["users"][0]["position"] == "2"){
            $status = "waiting for confirmation";
        }

        $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
            ->join('users','user_subjecttbl.UID = users.idusers','left')
            ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
            ->where('users.user_level','2')
            ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
            ->where('questionairetbl.questionaire_status',$status)
            ->where('questionairetbl.idquestionaire',$data)
            ->limit(1)
            ->group_by('questionairetbl.idquestionaire')
            ->get('questionairetbl');
        if($questionaireData = $query->result_array()){

            foreach($questionaireData as $q => $qValue){
                $query = $this->db->where('questionaire_id', $qValue["idquestionaire"])
                            ->get('user_questionairetbl');
                $userQuestionaireData = $query->result_array();
                foreach($questionaireData[$q] as $key => $value){
                    $examData[$q][$key] = $value;
                }
                
                if($userQuestionaireData){
                    $examData[$q]["user_questionaire"] = $userQuestionaireData;
                }
                $query = $this->db->order_by('questionaire_comment_date', 'DESC')
                                ->where('questionaire_id',$qValue["idquestionaire"])
                                ->get('questionaire_commentstbl');
                if($questionaireComments = $query->result_array()){
                    foreach($questionaireComments as $key=> $value){
                        $examData[$q]["questionaire_message"][$key]["message"] = $value["questionaire_comment"];
                        $examData[$q]["questionaire_message"][$key]["date"] = $value["questionaire_comment_date"];

                    }
                }
                $query = $this->db->where('idquestionaire',$qValue["idquestionaire"])
                    ->get('questionaire_typetbl');
                if($questionaireTypeData = $query->result_array()){ 

                    foreach($questionaireTypeData as $key => $value){
                        $examData[$q]["questionaire_type"][$key] = $value;

                        $query = $this->db->where('idquestionaire_type',$examData[$q]["questionaire_type"][$key]["idquestionairetype"])
                        ->get('questiontbl');
                        if($questionData = $query->result_array()){
                            for($i=0;$i<count($questionData);$i++){
                                
                                
                                $examData[$q]["questionaire_type"][$key]["question"][$i] = $questionData[$i];

                                $query = $this->db->join('user_answertbl','question_user_answertbl.iduseranswer = user_answertbl.iduseranswer')
                                                        ->where('question_user_answertbl.idquestion',$questionData[$i]["idquestion"])
                                                        ->where('user_answertbl.iduser',$qValue["idusers"])
                                                    ->get("question_user_answertbl");
                                
                                if($userAnswer = $query->result_array()){
                                    
                                    $examData[$q]["questionaire_type"][$key]["question"][$i]["user_answer"] = $userAnswer;
                                    
                                }

                                if($examData[$q]["questionaire_type"][$key]["questionaire_type"] == "0"){
                                    $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                    ->get('question_choicestbl');
                                    
                                    if($choicesData = $query->result_array()){
                                        for($j=0;$j<count($choicesData);$j++){
                                            $examData[$q]["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];
                                            
                                        }
                                    }

                                }
                                
                                $query = $this->db->where('idquestion',$examData[$q]["questionaire_type"][$key]["question"][$i]["idquestion"])
                                ->get('question_answertbl');
                                if($answerData = $query->result_array()){
                                    
                                    for($j=0;$j<count($answerData);$j++){
                                        $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                    }
                                    
                                }else{
                                    $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["answer"] = "";
                                    $examData[$q]["questionaire_type"][$key]["question"][$i]["answer"][0]["idquestion_answer"] = "";
                                }
                                
                            }
                        }
                    }
                    
                }
            }
            
        }  
        if(isset($examData[0])){

            return $examData[0];
        }else{
            if($examData){
                return $examData;

            }else{
                return false;
            }
        }

        /*
       
        }*/
        
    }

    public function approvequestionnaire($id=false){
        
        $isQuestionnaireUpdated = $this->db->set('questionaire_status','approved')
                        ->where('idquestionaire',$id)
                        ->update('questionairetbl');
        if($isQuestionnaireUpdated){
            return array("Approved",true);
        }
        return array("Fail to Approve",false);
    }

    public function disapprovequestionnaire($data=false){
        
        $isQuestionnaireUpdated = $this->db->set('questionaire_status','unapproved')
                        ->where('idquestionaire',$data["id"])
                        ->update('questionairetbl');
        if($isQuestionnaireUpdated){
            $isQuestionnaireMessageInserted = $this->db->insert('questionaire_commentstbl',array('questionaire_id'=>$data["id"],'questionaire_comment' => $data["message"]));         
            if($isQuestionnaireMessageInserted){

                return array("Disapproved",true);
            }else{
                return array("Fail to Insert Message",false);
            }
        }
        return array("Fail to Disapprove",false);
    }

    
}

?>