
<?php


class Dashboard extends MY_Controller {

    function __contruct(){
        parent::__contruct();
        
    }

    public function index(){
        $this->load->model('Mdl_dashboards');

        $scheduleData = $this->Mdl_dashboards->getMessage();

        $questionnaireNotifications = $this->Mdl_dashboards->getQuestionnaireDataForValidation();
        $this->_view('dashboard',array('questionnaireValidation'=>$questionnaireNotifications,'message' =>$scheduleData));
        
	}
    

}
