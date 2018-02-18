
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_profiles extends CI_Model {

    function __construct(){
        parent::__construct();
    }
    
    public function uploadUserImage($data=false){
        $query = $this->db->set('image',$data)
                        ->where('idusers',$_SESSION["users"]["idusers"])
                        ->update('users');
        return $query;
    }
}


?>