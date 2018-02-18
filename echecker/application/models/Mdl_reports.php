
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_reports extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    public function questionnairelistreports($data=false){
        $userID = $_SESSION["users"]["idusers"];
        $dateNow = Date('m-d-y');
        $questionnaireListData = array();
        if($_SESSION["users"]["user_level"] == "1"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$userID)
                ->where('questionairetbl.idsubject',$data)
                ->group_by('user_questionairetbl.questionaire_id')
                ->get('user_questionairetbl');
                $questionnaireListData = $query->result_array();
        }
        if($_SESSION["users"]["user_level"] == "2" || $_SESSION["users"]["user_level"] == "3"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
            ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
            ->where('questionairetbl.idsubject',$data)
            ->group_by('user_questionairetbl.questionaire_id')
            ->get('user_questionairetbl');

            $questionnaireListData = $query->result_array();
            if($questionnaireListData){
                for($i=0;$i<count($questionnaireListData);$i++){
                    $query = $this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire')
                                                ->where('questionairetbl.idsubject',$data)
                                                ->where('user_questionairetbl.questionaire_id',$questionnaireListData[$i]["idquestionaire"])
                                                ->group_by('user_questionairetbl.iduserquestionaire')
                                                ->get('user_questionairetbl');
                    $questionnaireData = $query->result_array();
                    if($questionnaireData){
                        $questionnaireListData[$i]["user_questionnaire"] = $questionnaireData;
                    }else{
                        $questionnaireListData[$i]["user_questionnaire"] = array();
                    }

                    
                }
            }

            $query = $this->db->join('users','user_subjecttbl.UID = users.idusers','left')
                        ->where('users.user_level',"1")
                        ->where('user_subjecttbl.idsubject',$data)
                        ->group_by('iduser_subject')
                        ->get('user_subjecttbl');
            $studentCount = $query->result_array();
            if($studentCount){
                $questionnaireListData["student_count"] = count($studentCount);
            }else{
                $questionnaireListData["student_count"] = "0";
            }
            
        }
        
        
        return $questionnaireListData;
    }

    public function reportquestionnaireinfo($data=false){
        $userID = $_SESSION["users"]["idusers"];
        $dateNow = Date('m-d-y');
        if($_SESSION["users"]["user_level"] == "1"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$userID)
                ->where('questionairetbl.idsubject',$data)
                ->get('user_questionairetbl');
                return $query->result_array();
        }
       
    }

    public function reportstudentquestionnaireinfo($data=false){
        
        if($_SESSION["users"]["user_level"] == "2"){ 
            $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                ->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->where('user_questionairetbl.idusers',$data["idusers"])
                ->where('questionairetbl.idsubject',$data["idsubject"])
                ->get('user_questionairetbl');
                return $query->result_array();
        }
       return false;
    }

    public function retakeexamination($data=false){
       
        if($_SESSION["users"]["user_level"] == "2"){ 
            //
            $isUserQuestionRecordDeleted = $this->db->where('user_questionairetbl.idusers',$data["idusers"])
                                        ->where('user_questionairetbl.questionaire_id',$data["idquestionaire"])
                                        ->delete('user_questionairetbl');
            if($isUserQuestionRecordDeleted){
                
                $query = $this->db->join('question_user_answertbl','user_answertbl.iduseranswer = question_user_answertbl.iduseranswer')
                ->join('questiontbl','question_user_answertbl.idquestion = questiontbl.idquestion')
                ->join('questionaire_typetbl','questiontbl.idquestionaire_type = questionaire_typetbl.idquestionairetype')
                ->group_by('user_answertbl.iduseranswer')
                ->where('questionaire_typetbl.idquestionaire',$data["idquestionaire"])
                ->where('user_answertbl.iduser',$data["idusers"])
                ->get('user_answertbl');
                if($userAnswerData = $query->result_array()){
                    foreach($userAnswerData as $key => $value){
                        if(isset($value["iduseranswer"])){
                            $isUserAnswerDeleted = $this->db->where('iduseranswer',$value["iduseranswer"])->delete('user_answertbl');
                            if($isUserAnswerDeleted){
                                if(isset($value["idquestionuseranswer"])){
                                    $isQuestionUserAnswerDeleted = $this->db->where('idquestionuseranswer',$value["idquestionuseranswer"])->delete('question_user_answertbl'); 
                                    if(!$isQuestionUserAnswerDeleted){
                                        return array('Error in Deleting Question User Answer',false);
                                    }
                                }
                                
                            }else{
                                return array('Error in Deleting User Answer',false);
                            }
                        }
                        
                    }
                }
            }
            return array("successfully Remove", true);
            //
        }
       return false;
    }

    public function getAllTeacherListDepartmentSessionBase(){
        
        $query = $this->db->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
                ->where('teacher_informationtbl.position','1')
                ->where('users.user_level',"2")
                ->group_by('users.idusers')
                ->get('users');
        if($departmentTeacherData = $query->result_array()){
            foreach($departmentTeacherData as $key=>$value){
                $query = $this->db->where('UID',$value["idusers"])
                            ->group_by('iduser_department')
                            ->get('user_departmenttbl');
                if($teacherSubjectCount = $query->result_array()){
                    $departmentTeacherData[$key]["subjectcount"] = count($teacherSubjectCount); 
                }else{
                    $departmentTeacherData[$key]["subjectcount"] = "0";
                }
            }
            return $departmentTeacherData;
        }
        
        return false;
    }

    //department name base
    public function reportsdepartmentteacherlist($departmentName=false){
        
        $query = $this->db->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('teacher_informationtbl.department',$departmentName)
                ->where('teacher_informationtbl.position','1')
                ->where('users.user_level',"2")
                ->group_by('users.idusers')
                ->get('users');
        if($departmentTeacherData = $query->result_array()){
            foreach($departmentTeacherData as $key=>$value){
                $query = $this->db->where('UID',$value["idusers"])
                            ->group_by('iduser_department')
                            ->get('user_departmenttbl');
                if($teacherSubjectCount = $query->result_array()){
                    $departmentTeacherData[$key]["subjectcount"] = count($teacherSubjectCount); 
                }else{
                    $departmentTeacherData[$key]["subjectcount"] = "0";
                }
            }
            return $departmentTeacherData;
        }
        
        return false;
    }

    public function reportteachersubjectList($data){
        
        $query=$this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject')
                ->join('subject_scheduletbl','subjecttbl.schedule = subject_scheduletbl.idschedule','left')
            ->where('UID',$data["idusers"])
        ->get('user_subjecttbl');
        return $query->result_array();
    }
    
    public function reportsdepartmentlist(){
        
        $query=$this->db->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id')
                    ->where('teacher_informationtbl.position','2')
                    ->where('users.user_level','2')
                    ->group_by('users.idusers')
                    ->get('users');
        return $query->result_array();
    }

    public function studentquestionnaireinfo($data){
        $examData = array();
        
        $query=$this->db->join('user_questionairetbl','questionairetbl.idquestionaire = user_questionairetbl.questionaire_id','left')
            ->where('idquestionaire',$data["idquestionaire"])
            ->get('questionairetbl');
        if($questionaireData = $query->result_array()){
            
            foreach($questionaireData[0] as $key => $value){
                $examData[$key] = $value;
            }
            $query = $this->db->where('idquestionaire',$data["idquestionaire"])
                ->get('questionaire_typetbl');
            if($questionaireTypeData = $query->result_array()){ 

                foreach($questionaireTypeData as $key => $value){
                    $examData["questionaire_type"][$key] = $value;

                    $query = $this->db->where('idquestionaire_type',$examData["questionaire_type"][$key]["idquestionairetype"])
                    ->get('questiontbl');
                    if($questionData = $query->result_array()){
                        for($i=0;$i<count($questionData);$i++){
                            
                            
                            $examData["questionaire_type"][$key]["question"][$i] = $questionData[$i];

                            $query = $this->db->join('user_answertbl','question_user_answertbl.iduseranswer = user_answertbl.iduseranswer')
                                                    ->where('question_user_answertbl.idquestion',$questionData[$i]["idquestion"])
                                                    ->where('user_answertbl.iduser',$data["idusers"])
                                                ->get("question_user_answertbl");
                            
                            if($userAnswer = $query->result_array()){
                                
                                $examData["questionaire_type"][$key]["question"][$i]["user_answer"] = $userAnswer;
                                
                            }

                            if($examData["questionaire_type"][$key]["questionaire_type"] == "0"){
                                $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                                ->get('question_choicestbl');
                                
                                if($choicesData = $query->result_array()){
                                    for($j=0;$j<count($choicesData);$j++){
                                        $examData["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];
                                        
                                    }
                                }

                            }
                            
                            $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                            ->get('question_answertbl');
                            if($answerData = $query->result_array()){
                                
                                for($j=0;$j<count($answerData);$j++){
                                    $examData["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                }
                                
                            }else{
                                $examData["questionaire_type"][$key]["question"][$i]["answer"][0]["answer"] = "";
                                $examData["questionaire_type"][$key]["question"][$i]["answer"][0]["idquestion_answer"] = "";
                            }
                            
                        }
                    }
                }
                
            }
            
        }  
        
        return $examData;
       
        
    }

    public function studentquestionnairelist($data){
        
        $query=$this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire')
            ->join('subjecttbl', 'questionairetbl.idsubject = subjecttbl.idsubject')
            ->where('questionairetbl.idsubject',$data["idsubject"])
            ->where('user_questionairetbl.idusers',$data["idusers"])
            ->group_by('user_questionairetbl.iduserquestionaire')
        ->get('user_questionairetbl');
        return $query->result_array();
        
    }

    public function reportstudentlistquestionnaire($data=false){
        $userData = array();
        $query = $this->db->join('subjecttbl','user_subjecttbl.idsubject = subjecttbl.idsubject')
                        ->join('users','user_subjecttbl.UID = users.idusers','left')
                        ->join('student_informationtbl','users.idusers = student_informationtbl.id','left')
                        ->join('user_departmenttbl','users.idusers = user_departmenttbl.UID','left')
                        ->join('departmenttbl','user_departmenttbl.iddepartment = departmenttbl.iddepartment','left')
                        ->join('user_coursetbl','users.idusers = user_coursetbl.iduser_course','left')
                        ->join('coursetbl','user_coursetbl.idcourse = coursetbl.idcourse','left')
                        ->group_by('user_subjecttbl.UID')
                ->where('user_subjecttbl.idsubject',$data["idsubject"])
                ->where('users.user_level',"1")
                ->get('user_subjecttbl');

        $userData = $query->result_array();
       
        if($userData){
            foreach($userData as $key => $value){
                $query = $this->db->join('questionairetbl','user_questionairetbl.questionaire_id = questionairetbl.idquestionaire','left')
                        ->where('user_questionairetbl.idusers',$value["idusers"])
                        ->where('user_questionairetbl.questionaire_id',$data["idquestionaire"])
                        ->group_by('iduserquestionaire')
                        ->get('user_questionairetbl');
                
                if($userQuestionnaireData = $query->row_array()){
                    foreach($userQuestionnaireData as $i => $iValue){
                        $userData[$key][$i] = $iValue;
                    }
                    $userData[0]["questionaire_total_score"] = $userQuestionnaireData["questionaire_total_score"];
                }else{
                    $userQuestionnaireColumns = array("iduserquestionaire","idusers","questionaire_id","user_total_score","idquestionaire");
                    foreach($userQuestionnaireColumns as $i => $iValue){
                        $userData[$key][$iValue] = "0";
                    }
                }
                
            }
            $query = $this->db->join('user_subjecttbl',' user_subjecttbl.UID = users.idusers','left')
                            ->where('user_subjecttbl.idsubject',$data["idsubject"])
                            ->where('users.user_level',"2")
                            ->group_by('users.idusers')
                            ->get('users');
            if($getTeacherData = $query->result_array()){
                $arrayTeacherData = array();
                foreach($getTeacherData as $key => $value){
                    $arrayTeacherData[$key] = $value["idusers"];
                }
                $userData[0]["teachersID"] = $arrayTeacherData;
            }
            
        }else{
            return array("",false);
        }
        
        return $userData;
        
    }
    public function updatequestionscore($data=false){
      
        if($data["idquestionuseranswer"] !== null && $data["idquestionuseranswer"] != ""){
            $isUpdated = $this->db->set('question_score',(string)$data["newscore"])
            ->where('iduseranswer',$data["idquestionuseranswer"])
            ->update('user_answertbl');
            if($isUpdated){
                
                $query = $this->db->where('iduserquestionaire',$data["iduserquestionaire"])
                    ->get('user_questionairetbl');
                $questionaireData = $query->row_array();
                $newScore = (((int)$data["newscore"]) - ((int)$data["score"]));
                $newTotalScore = ((int)$questionaireData["user_total_score"] + $newScore);
                $isQuestionUpdated = $this->db->set('user_total_score',$newTotalScore)
                                    ->where('iduserquestionaire',$data["iduserquestionaire"])
                                    ->update('user_questionairetbl');
                if($isQuestionUpdated){
                    return array("successfully updated",true,$newTotalScore);
                }else{
                    return array("Error Updating",false);
                }
            }else{
                return array("Error Updating",false);
            }
        }else{
            
        }
        
        return array("Error Updating",false);
    }

    //USER SESSION BASE
    public function getQuestionnaireInfoById($data=false){
        
        $examData = array();
        
        $query=$this->db->where('idquestionaire',$data)
            ->get('questionairetbl');
        if($questionaireData = $query->result_array()){
            $query = $this->db->where('questionaire_id', $data)
                            ->where('idusers',$_SESSION["users"]["idusers"])
                            ->get('user_questionairetbl');
            $userQuestionaireData = $query->result_array();
            foreach($questionaireData[0] as $key => $value){
                $examData[$key] = $value;
            }
            if($userQuestionaireData){
                $examData["user_questionaire"] = $userQuestionaireData;
            }
            $query = $this->db->where('idquestionaire',$data)
                ->get('questionaire_typetbl');
            if($questionaireTypeData = $query->result_array()){ 

                foreach($questionaireTypeData as $key => $value){
                    $examData["questionaire_type"][$key] = $value;

                    $query = $this->db->where('idquestionaire_type',$examData["questionaire_type"][$key]["idquestionairetype"])
                    ->get('questiontbl');
                    if($questionData = $query->result_array()){
                        for($i=0;$i<count($questionData);$i++){
                           
                            
                            $examData["questionaire_type"][$key]["question"][$i] = $questionData[$i];

                            $query = $this->db->join('user_answertbl','question_user_answertbl.iduseranswer = user_answertbl.iduseranswer')
                                                  ->where('question_user_answertbl.idquestion',$questionData[$i]["idquestion"])
                                                  ->where('user_answertbl.iduser',$_SESSION["users"]["idusers"])
                                                ->get("question_user_answertbl");
                            
                            if($userAnswer = $query->result_array()){
                                
                                $examData["questionaire_type"][$key]["question"][$i]["user_answer"] = $userAnswer;
                                
                            }

                            if($examData["questionaire_type"][$key]["questionaire_type"] == "0"){
                                $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                                ->get('question_choicestbl');
                                
                                if($choicesData = $query->result_array()){
                                    for($j=0;$j<count($choicesData);$j++){
                                        $examData["questionaire_type"][$key]["question"][$i]["choices"][$j] = $choicesData[$j];
                                        
                                    }
                                }

                            }
                            
                            $query = $this->db->where('idquestion',$examData["questionaire_type"][$key]["question"][$i]["idquestion"])
                            ->get('question_answertbl');
                            if($answerData = $query->result_array()){
                                
                                for($j=0;$j<count($answerData);$j++){
                                    $examData["questionaire_type"][$key]["question"][$i]["answer"][$j] = $answerData[$j];
                                }
                                
                            }else{
                                $examData["questionaire_type"][$key]["question"][$i]["answer"][0]["answer"] = "";
                                $examData["questionaire_type"][$key]["question"][$i]["answer"][0]["idquestion_answer"] = "";
                            }
                            
                        }
                    }
                }
                
            }
           
        }  
        
        return $examData;
    }

}


?>