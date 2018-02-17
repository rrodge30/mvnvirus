
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
        $query = $this->db->where('id','1')->get('bulletintbl');
        if($isMessageExist = $query->row_array()){
            $isQueryUpdated = $this->db->set('message',$data[$key])->where('id',1)->update('bulletintbl');
            return $isQueryUpdated;
        }else{
            $isQueryInserted = $this->db->insert('bulletintbl',array('message'=>$data[$key]));
            return$isQueryInserted;
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