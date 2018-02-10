
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_notifications extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    

    public function unapprovedQuestionaireList(){
       
        //$questionairesData = array();
        
     
        $examData = array();
        
        $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
            ->join('users','user_subjecttbl.UID = users.idusers','left')
            ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
            ->where('users.user_level','2')
            ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
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
        
        return $examData;
        
        /*
        
Array
(
    [0] => Array
        (
            [idquestionaire] => 47
            [idclass] => 0
            [idsubject] => 18
            [questionaire_title] => capstoning
            [questionaire_description] => capstoning is lifer
            [questionaire_status] => unapproved
            [approved_user] => 
            [approved_date] => 2018-02-08 00:29:51
            [questionaire_score] => 
            [questionaire_total_score] => 8
            [questionaire_duration] => 3600
            [questionaire_remarks] => 
            [questionaire_date] => 02-08-18
            [questionaire_time] => 00:26
            [questionaire_instruction] => <p>sdfgsdgsdf egs dfgsdfg sdfgsdfgsdg sdgf</p>
            [questionaire_type_id] => 0
            [subject_code] => IT - 222
            [subject_description] => Capstone Project
            [schedule] => 19
            [units] => 3
            [status] => active
            [iduser_subject] => 26
            [UID] => 85
            [idusers] => 85
            [code] => 272018
            [user] => fritz
            [pass] => asdf
            [user_level] => 2
            [position] => 1
            [created_at] => 2018-02-07 16:16:16
            [updated_at] => 0000-00-00 00:00:00
            [idteacher] => 32
            [id] => 85
            [firstname] => fritz 
            [middlename] => edig
            [lastname] => barnuevo
            [subjects_handled] => 0
            [email] => 
            [contact_no] => 
            [department] => AITES
        )

)

        */

       /*if($questionairesData = $query->result_array()){
           
           for($q=0;$q<count($questionairesData);$q++){
                $query=$this->db->where('idquestionaire',$questionairesData[$q]["idquestionaire"])
                ->get('questionaire_typetbl');
                if($questionairesData[$q]["questionaire_type"] = $query->result_array()){
                   for($i=0;$i<count($questionairesData[$q]["questionaire_type"]);$i++){
                        $query=$this->db->where('idquestionaire_type',$questionairesData[$q]["questionaire_type"][$i]["idquestionairetype"])
                        ->get('questiontbl');
                        if($questionairesData[$q]["questionaire_type"][$i]["question"] = $query->result_array()){
                            
                                for($j=0;$j<count($questionairesData[$q]["questionaire_type"][$i]["question"]);$j++){
                                    if($questionairesData[$q]["questionaire_type"][$i]["questionaire_type"] == 0){
                                        $query=$this->db->where('idquestion',$questionairesData[$q]["questionaire_type"][$i]["question"][$j]["idquestion"])
                                        ->get('question_choicestbl');
                                        if($questionairesData[$q]["questionaire_type"][$i]["question"][$j]["choices"] = $query->result_array()){
    
                                        }
                                    }
                                    
                                    $query=$this->db->where('idquestion',$questionairesData[$q]["questionaire_type"][$i]["question"][$j]["idquestion"])
                                    ->get('question_answertbl');

                                    if($questionairesData[$q]["questionaire_type"][$i]["question"][$j]["answer"] = $query->result_array()){
                                        
                                    }
                                }
                            

                            
                            
                        }
                   }
                }
           }
       }
            
        return $questionairesData;
        */
    }

    public function viewquestionnaireById($data=false){
       
        /*$questionairesData = array();
        
        $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                    ->where('questionaire_status','unapproved')
                    ->where('idquestionaire',$data)
                    ->get('questionairetbl');
        */
        $examData = array();
        
        $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
            ->join('users','user_subjecttbl.UID = users.idusers','left')
            ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
            ->where('users.user_level','2')
            ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
            ->where('questionairetbl.questionaire_status','unapproved')
            ->where('questionairetbl.idquestionaire',$data)
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
     
        return $examData[0];






        /*
       if($questionairesData = $query->result_array()){
           
           for($q=0;$q<count($questionairesData);$q++){
                $query=$this->db->where('idquestionaire',$questionairesData[$q]["idquestionaire"])
                ->get('questionaire_typetbl');
                if($questionairesData[$q]["questionaire_type"] = $query->result_array()){
                   for($i=0;$i<count($questionairesData[$q]["questionaire_type"]);$i++){
                        $query=$this->db->where('idquestionaire_type',$questionairesData[$q]["questionaire_type"][$i]["idquestionairetype"])
                        ->get('questiontbl');
                        if($questionairesData[$q]["questionaire_type"][$i]["question"] = $query->result_array()){
                            
                            for($j=0;$j<count($questionairesData[$q]["questionaire_type"][$i]["question"]);$j++){
                                if($questionairesData[$q]["questionaire_type"][$i]["questionaire_type"] == 0){
                                    $query=$this->db->where('idquestion',$questionairesData[$q]["questionaire_type"][$i]["question"][$j]["idquestion"])
                                    ->get('question_choicestbl');
                                    if($questionairesData[$q]["questionaire_type"][$i]["question"][$j]["choices"] = $query->result_array()){

                                    }
                                }
                                
                                $query=$this->db->where('idquestion',$questionairesData[$q]["questionaire_type"][$i]["question"][$j]["idquestion"])
                                ->get('question_answertbl');

                                if($questionairesData[$q]["questionaire_type"][$i]["question"][$j]["answer"] = $query->result_array()){
                                    
                                }
                            }
                        }
                   }
                }
           }
       }
        if($questionairesData){
            return $questionairesData[0];
        }else{
            return $questionairesData;
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

}

?>