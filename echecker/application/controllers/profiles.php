
<?php


class Profiles extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{

		$this->_view('profile');
    }
    
    public function uploadUserImage(){
        
        
        $target = "assets/uploads/" . basename($_SESSION["users"]["idusers"] . $_FILES["usersFile"]["name"]);
        $this->load->model('mdl_profiles');
		$isImageTargetSave = $this->mdl_profiles->uploadUserImage($_SESSION["users"]["idusers"] . $_FILES["usersFile"]["name"]);
        
        $isImageSuccessfullyUploaded = false;
        if(!file_exists($target)){
            if($isImageTargetSave){
                if(move_uploaded_file($_FILES["usersFile"]["tmp_name"],$target))
                {
                    $isImageSuccessfullyUploaded = true;
                }
            }
        }else{
            $isImageSuccessfullyUploaded = true;
        }
        echo json_encode($isImageSuccessfullyUploaded);
        
    }
    
}
