
<?php


class Reports extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
		$this->load->model('mdl_reports');
		$getAllTeacherListDepartmentSessionBase = $this->mdl_reports->getAllTeacherListDepartmentSessionBase();
		$this->_view('report',$getAllTeacherListDepartmentSessionBase);
	}
 
	public function reportteachersubjectList(){
		$this->load->model('mdl_reports');
		$reportteachersubjectList = $this->mdl_reports->reportteachersubjectList($_GET);
		
		$this->_view('reportteachersubjectList',$reportteachersubjectList);
	}
	public function studentquestionnairelist(){
		$this->load->model('mdl_reports');
		$studentquestionnairelist = $this->mdl_reports->studentquestionnairelist($_GET);
		
		$this->_view('studentquestionnairelist',$studentquestionnairelist);
	}
	public function studentquestionnaireinfo(){
		$this->load->model('mdl_reports');
		$studentquestionnaireinfo = $this->mdl_reports->studentquestionnaireinfo($_GET);
		
		$this->_view('studentquestionnaireinfo',$studentquestionnaireinfo);
	}
	public function reportstudentlist($id){
		$this->load->model('mdl_examinations');
		$reportstudentlist = $this->mdl_examinations->subjectclassinformation($id);
		
		$this->_view('reportstudentlist',$reportstudentlist);
	}
	public function questionnairelistreports($id=false){
		$this->load->model('mdl_reports');
		$questionaireList = $this->mdl_reports->questionnairelistreports($id);
		
		$this->_view('questionnairelistreports',$questionaireList);
	}
	public function reportquestionnaireinfo($id=false){
	
		$this->load->model('mdl_reports');
		$reportquestionnaireinfo = $this->mdl_reports->getQuestionnaireInfoById($id);
		
		$this->_view('reportquestionnaireinfo',$reportquestionnaireinfo);
	}

	public function reportstudentquestionnaireinfo(){
		$this->load->model('mdl_examinations');
		$reportquestionnaireinfo = $this->mdl_examinations->getQuestionnaireInfoByIdQuestionnaireIdUser($_GET);
		
		$this->_view('reportquestionnaireinfo',$reportquestionnaireinfo);
	}

	public function reportstudentlistquestionnaire($id=false){
		$this->load->model('mdl_reports');
		$reportstudentlistquestionnaire = $this->mdl_reports->reportstudentlistquestionnaire($_GET);
		
		$this->_view('reportstudentlistquestionnaire',$reportstudentlistquestionnaire);
	}

	public function updatequestionscore(){
		$this->load->model('mdl_reports');
		$updatequestionscore = $this->mdl_reports->updatequestionscore($_POST);
		echo json_encode($updatequestionscore);
	}
    
}
