
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

	public function reportsdepartmentlist(){
		$this->load->model('mdl_reports');
		$reportsdepartmentlist = $this->mdl_reports->reportsdepartmentlist();
		$this->_view('reportsdepartmentlist',$reportsdepartmentlist);
	}
	public function JSONreportsdepartmentlist(){
		$this->load->model('mdl_reports');
		$reportsdepartmentlist = $this->mdl_reports->reportsdepartmentlist();
		echo json_encode($reportsdepartmentlist);
	}

	public function JSONreportsSubjectlist(){
		$this->load->model('mdl_reports');
		$JSONreportsSubjectlist = $this->mdl_reports->JSONreportsSubjectlist();
		echo json_encode($JSONreportsSubjectlist);
	}
	public function reportDepartmentSubjectResultList(){
		$this->load->model('mdl_reports');
		$reportDepartmentSubjectResultList = $this->mdl_reports->reportDepartmentSubjectResultList();
		echo json_encode($reportDepartmentSubjectResultList);
	}

	public function reportSubjectResultList(){
		$this->load->model('mdl_reports');
		$reportSubjectResultList = $this->mdl_reports->reportSubjectResultList();
		echo json_encode($reportSubjectResultList);
	}

	public function reportsdepartmentteacherlist($departmentName){
		$this->load->model('mdl_reports');
		$reportsdepartmentteacherlist = $this->mdl_reports->reportsdepartmentteacherlist($departmentName);
		$this->_view('report',$reportsdepartmentteacherlist);
	}

	public function retakeexamination(){
		$this->load->model('mdl_reports');
		$retakeexamination = $this->mdl_reports->retakeexamination($_POST);
		echo json_encode($retakeexamination);
	}
	
	public function exportSubjectStudentsQuestionaireResult(){
		$this->load->model('mdl_reports');
		$questionnaireResult = $this->mdl_reports->exportSubjectStudentsQuestionaireResult($_POST["idquestionaire"]);
		
		$html = '';
		if($questionnaireResult){
			$html .= '
		
			 <div>
				 <table>
					 <tr>
						 <td style="width:100%;font-weight:bold;font-size:18px;">
							'.$questionnaireResult["questionaire_title"].' - '.$questionnaireResult["questionaire_description"].'
						 </td>
						 
					 </tr>
					 <tr>
						<td style="width:80%;font-weight:bold;font-size:18px;">
							<br>
						</td>
						
					</tr>
					 <tr>
						 <td style="width:22.5%;">
						 	Subject
						 </td>
						 <td style="font-weight:bold;width:75%;">
							: '.$questionnaireResult["subject_code"].' - '.$questionnaireResult["subject_description"].'
						 </td>
						
					</tr>
					 <tr>
						 <td style="width:20%;">
						 	Date/Time
						 </td>
						 <td style="font-weight:bold;">
						 	: '.$questionnaireResult["questionaire_date"].' - '.$questionnaireResult["questionaire_time"].'
						 </td>
					</tr>
				 </table>
			 </div>
			 <br>
			
			 <hr>
			<table>
				<thead>
					<tr>
						<th>Stud no.</th>
						<th>Name</th>
						<th>Examinee Score</th>
						<th>Total Item</th>
						<th>Percentage</th>
					</tr>
				</thead>
				<tbody>';
				$passersCount = 0;
				foreach($questionnaireResult["students_info"] as $key=>$value){
					$percentage = ((($value["total_score"])/($questionnaireResult["questionaire_total_score"])*80)+20);
					if($percentage >= 75){
						$passersCount++;
					}
					$html .= '
							<tr style="margin:5px;">
								<td style="margin:5px;">'.($key+1).'</td>
								<td style="margin:5px;">'.$value["lastname"].', '.$value["firstname"].' '.$value["middlename"].' </td>
								<td style="margin:5px;">'.$value["total_score"].'</td>
								<td style="margin:5px;">'.$questionnaireResult["questionaire_total_score"].'</td>
								<td style="margin:5px;">'.number_format($percentage,2).'%</td>
							</tr>
						';
				}
		$html .= '</tbody>
			</table>
			<br>
			<br>
			<table>
				<tr>
					<td>
						<b>Results:</b>
					</td>
				</tr>
				<tr>
					<td style="width:30%">
						No. of Students
					</td>
					<td>
						'.count($questionnaireResult["students_info"]).'
					</td>
				</tr>
				<tr>
					<td style="width:30%">
						No. of Passers
					</td>
					<td>
						'.$passersCount.'('.number_format(((($passersCount)/count($questionnaireResult["students_info"]))*100),2).'%)
					</td>
				</tr>
				<tr>
					<td style="width:30%">
						No. of Failed
					</td>
					<td>
						'.(count($questionnaireResult["students_info"])-$passersCount).'('.number_format((((count($questionnaireResult["students_info"])-$passersCount)/count($questionnaireResult["students_info"]))*100),2).'%)
					</td>
				</tr>

			</table>
	
		<br><br><br>
		<div>
			<span>Signed:</span>
		</div>
		<div style=";width:100%;">
			<u style="font-weight:bold;">'.$questionnaireResult["teacher_name"].'</u>
		</div>
		
		';
	
		}
		$this->exportQuestionnaire($html);
	}

	public function exportQuestionnaire($html=false){

		$this->load->library("TCPDF/tcpdf");
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator('ExaminationHUB');
		

		// set default header data
		$pdf->SetHeaderData('', '', 'ExaminationHUB', '', array(0,64,255), array(0,64,128));
		$pdf->setFooterData(array(0,64,0), array(0,64,128));

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// ---------------------------------------------------------

		// set default font subsetting mode
		$pdf->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$pdf->SetFont('courier', '', 10, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$pdf->AddPage('P','LEGAL');

		// Set some content to print
		
		
		ob_end_clean();
		// Print text using writeHTMLCell()
		$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

		// ---------------------------------------------------------
		// Clean any content of the output buffer
		
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$pdf->Output('questionnaire_reports.pdf', 'I');
	}

}
