
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
        if($isImageTargetSave){
            if(!file_exists($target)){
                
                    if(move_uploaded_file($_FILES["usersFile"]["tmp_name"],$target))
                    {
                        $_SESSION["users"]["image"] = $_SESSION["users"]["idusers"] . $_FILES["usersFile"]["name"];
                        $isImageSuccessfullyUploaded = true;

                    }
                
            }else{
                $_SESSION["users"]["image"] = $_SESSION["users"]["idusers"] . $_FILES["usersFile"]["name"];
                $isImageSuccessfullyUploaded = true;

            }
        }
        echo json_encode($isImageSuccessfullyUploaded);
        
    }
    
}
