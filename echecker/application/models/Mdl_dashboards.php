
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_dashboards extends CI_Model {

    function __construct(){
        parent::__construct();
    }
   
    public function getMessage(){
        $query=$this->db->limit(1)->get('bulletintbl');
        $message = $query->result_array();
        if($message){
            return $message;
        }else{
            return array(
                0 => array(
                        "message"=>"Hello, You can put your annoucements here !."
                        )

            );
        }
        
    }

    public function postMessage($data=array()){
        
        $key = key($data);
        
        $query = $this->db->limit(1)->get('bulletintbl');
        if($isMessageExist = $query->row_array()){
            $isQueryUpdated = $this->db->set('message',$data[$key])->update('bulletintbl');
            return $isQueryUpdated;
        }else{
            $isQueryInserted = $this->db->insert('bulletintbl',array('message'=>$data[$key]));
            return$isQueryInserted;
        }
        
    
    }

    public function getNumberOfQuestionnaireValidation(){
        if(isset($_SESSION["users"][0]["position"])){
            if($_SESSION["users"][0]["position"] == "1"){
                $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                ->join('users','user_subjecttbl.UID = users.idusers','left')
                ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('users.user_level','2')
                ->where('user_subjecttbl.UID', $_SESSION["users"]["idusers"])
                ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
                ->where('questionairetbl.questionaire_status','unapproved')
                ->group_by('questionairetbl.idquestionaire')
                ->get('questionairetbl');
                if($getQuetionnaireItems = $query->result_array()){
                    return count($getQuetionnaireItems);
                }else{
                    return "0";
                }
            }else if($_SESSION["users"][0]["position"] == "2"){
                $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                ->join('users','user_subjecttbl.UID = users.idusers','left')
                ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                ->where('users.user_level','2')
                ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
                ->where('questionairetbl.questionaire_status','waiting for confirmation')
                ->group_by('questionairetbl.idquestionaire')
                ->get('questionairetbl');
                if($getQuetionnaireItems = $query->result_array()){
                    return count($getQuetionnaireItems);
                }else{
                    return "0";
                }
            }
            
        }
        
        
    }

    public function getQuestionnaireDataForValidation(){

        if($_SESSION["users"]["user_level"] == "2"){
            if(isset($_SESSION["users"][0]["position"])){
                if($_SESSION["users"][0]["position"] == "1"){
                    $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                    ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                    ->join('users','user_subjecttbl.UID = users.idusers','left')
                    ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                    ->where('user_subjecttbl.UID',$_SESSION["users"]["idusers"])
                    ->where('questionairetbl.questionaire_status','unapproved')
                    ->group_by('questionairetbl.idquestionaire')
                    ->get('questionairetbl');
                }else if($_SESSION["users"][0]["position"] == "2"){
                    $query=$this->db->join('subjecttbl','questionairetbl.idsubject = subjecttbl.idsubject','left')
                    ->join('user_subjecttbl','subjecttbl.idsubject = user_subjecttbl.idsubject','left')
                    ->join('users','user_subjecttbl.UID = users.idusers','left')
                    ->join('teacher_informationtbl','users.idusers = teacher_informationtbl.id','left')
                    ->where('users.user_level','2')
                    ->where('teacher_informationtbl.position','1')
                    ->where('teacher_informationtbl.department',$_SESSION["users"][0]["department"])
                    ->where('questionairetbl.questionaire_status','waiting for confirmation')
                    ->group_by('questionairetbl.idquestionaire')
                    ->get('questionairetbl');
                    

                }
                return $getQuetionnaireItems = $query->result_array();
            }
        }
        
    }

    public function adminSettingIdentifier(){
        $dataArrIdentifier = array();
        $hasSubject = false;
        $hasCourse = false;
        $hasDepartment = false;

        $query = $this->db->limit(1)->get('subjecttbl');
        if($getSubject = $query->row_array()){
            $hasSubject = true;
        }

        $query = $this->db->limit(1)->get('coursetbl');
        if($getCourse = $query->row_array()){
            $hasCourse = true;
        }

        $query = $this->db->limit(1)->get('departmenttbl');
        if($getDepartment = $query->row_array()){
            $hasDepartment = true;
        }

        if($hasCourse == true && $hasSubject == true && $hasDepartment == true){
            return true;
        }else{
            return false;
        }

    }
}


?>