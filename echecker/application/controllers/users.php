
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller {

    function __contruct(){
        parent::__contruct();
    }

	public function index()
	{
        $this->load->model('mdl_Users');
        $proffessors = $this->mdl_Users->getAllProfessorsList();
        $students = $this->mdl_Users->getAllStudentsList();
        $users = array($proffessors,$students);
		$this->_view('users',$users);
	}

    public function importUsers(){
        if(isset($_POST['userfield'])){
            $this->load->library("Excelfile");
            $object = PHPExcel_IOFactory::load($_FILES["usersFile"]["tmp_name"]);
            $isInsertSuccess = false;
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumnLetter = $worksheet->getHighestDataColumn();
                $highestColumn = PHPExcel_Cell::columnIndexFromString($highestColumnLetter);
                $header = array('code','user','firstname','middlename','lastname');
                for($row=2; $row<=$highestRow; $row++){
                    $colDatas = array();
                    for($col=0;$col<count($header);$col++){ 
                        $colDatas[$header[$col]] = $worksheet->getCellByColumnAndRow($col,$row)->getFormattedValue();
                    }
                    if($_POST['userfield'] == 1){
                        $colDatas['course'] = $worksheet->getCellByColumnAndRow(5,$row)->getFormattedValue();
                        $colDatas['year_level'] = $worksheet->getCellByColumnAndRow(6,$row)->getFormattedValue();
                        $colDatas['department'] = $worksheet->getCellByColumnAndRow(7,$row)->getFormattedValue();

                    }else if($_POST['userfield'] == 2){
                        $colDatas['position'] = $worksheet->getCellByColumnAndRow(5,$row)->getFormattedValue();
                        $colDatas['department'] = $worksheet->getCellByColumnAndRow(6,$row)->getFormattedValue();
                    }else{
                        return false;
                    }
                    $colDatas['pass'] = $colDatas['code'];
                    $colDatas['user_level'] = $_POST['userfield'];
                    $this->load->model("mdl_Users");
                    $result = $this->mdl_Users->insertUsers($colDatas);
                    if($result){
                        $isInsertSuccess = true;    
                    }                    
                    
                }
                break;
            }
            echo json_encode($isInsertSuccess);
        }else{
            echo json_encode(false);
        }
        
       
    }
    
    public function deleteUser(){
        $this->load->model('mdl_Users');
        $result = $this->mdl_Users->deleteUserById($_POST['id']);
        echo json_encode($result);
    }
    public function addTeacher(){
        
        $this->load->model('mdl_Users');
        $_POST['pass'] = $_POST['code'];
        $_POST['user_level'] = "2";
        $result = $this->mdl_Users->insertUsers($_POST);
        echo json_encode($result);
    }
    public function addStudent(){
        $this->load->model('mdl_Users');
        $_POST['pass'] = $_POST['code'];
        $_POST['user_level'] = "1";
        $result = $this->mdl_Users->insertUsers($_POST);
        echo json_encode($result);
    }

    public function updateUser(){
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->updateUser($_POST);
        echo json_encode($query);
    }

    public function getUserInfoById($data=false){
        $this->load->model('mdl_Users');
        $result = $this->mdl_Users->getUserInfoById($_POST['id']);
        echo json_encode($result);
    }
    
    public function getUserAvailableSubject(){
     
        $this->load->model('mdl_Users');
        $query = $this->mdl_Users->getUserAvailableSujbects($_POST['id']);

        echo json_encode($query);
    }
    public function getTeacherAvailableSubjects(){
     
        $this->load->model('mdl_Users');
        $getTeacherAvailableSubjects = $this->mdl_Users->getTeacherAvailableSubjects();

        echo json_encode($getTeacherAvailableSubjects);
    }
    public function getStudentAvailableSubjects(){
     
        $this->load->model('mdl_Users');
        $getStudentAvailableSubjects = $this->mdl_Users->getStudentAvailableSubjects();

        echo json_encode($getStudentAvailableSubjects);
    }
    public function getStudentSubjectByUID(){
     
        $this->load->model('mdl_Users');
        $getStudentSubjectByUID = $this->mdl_Users->getStudentSubjectByUID($_POST['id']);
        echo json_encode($getStudentSubjectByUID);
    }
    public function getTeacherSubjectByUID(){
     
        $this->load->model('mdl_Users');
        $getTeacherSubjectByUID = $this->mdl_Users->getTeacherSubjectByUID($_POST['id']);

        echo json_encode($getTeacherSubjectByUID);
    }

    public function modalAddTeacher(){
        $htmlbody = '<center><span class="material-icons">warning</span>ALL FIELD ARE REQUIRED</center>'; 
        $header = array("code","user","firstname","middlename","lastname");
        $labels = array("ID no","Username","Firstname","Middlename","Lastname");
        $htmlbody .= '<form action="users/addteacher" method="post" onsubmit="return false;" class="mdl-frm-add-users" id="mdl-frm-add-teacher">';
        foreach($header as $key => $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right">'.ucwords($labels[$key]).'</div></span>
                            <input type="text" placeholder="Enter '.$labels[$key].'" class="form-control" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        $htmlbody .= '<div class="input-group" style="margin-bottom:10px;">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Position</div></span>
                        <select name="position" data-placeholder="Choose Department" class="chzn-select" required="required">
                            <option value="1">
                                Faculty Teacher
                            </option>
                            <option value="2">
                                Dean
                            </option>
                        </select>
                     </div>';
  
        $this->load->model('mdl_departments');
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  $htmlbody .= '<option value="'.$d['department_name'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div>
                        <div id="kanban">
                                
                        </div>
                        <input type="hidden" class="form-control input-class-subjectList" name="idsubject" aria-describedby="basic-addon1" required="required">
                        <input type="hidden" class="form-control input-class-available-subjectList" name="idsubject_available" aria-describedby="basic-addon1" required="required">
                        </form>';
        $htmlbody .= '<div class="col-md-12 roboto text-center no-subject-div" style="display:none;">No Available Subjects</div>';
        $htmlfooter = '<button type="submit" form="mdl-frm-add-teacher" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }

    public function modalAddStudent(){
        $htmlbody = '<center><span class="material-icons">warning</span>ALL FIELD ARE REQUIRED</center>'; 
        $header = array("code","user","firstname","middlename","lastname","year_level");
        $labels = array("ID no","Username","Firstname","Middlename","Lastname","Year Level");
        $htmlbody .= '<form action="users/addstudent" method="post" onsubmit="return false;" class="mdl-frm-add-users" id="mdl-frm-add-student">';
        foreach($header as $key => $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">'.ucwords($labels[$key]).'</div></span>
                            <input type="text" placeholder="Enter '.$labels[$key].'" class="form-control" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        $this->load->model('mdl_departments');
        $this->load->model('mdl_courses');
        
        $course = $this->mdl_courses->getAllcourses();
      
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Course</div></span>
                        <select name="course" data-placeholder="Choose Course" class="chzn-select" required="required">';
              foreach($course as $c){
                  $htmlbody .= '<option value="'.$c['course_name'].'">'.$c['course_name'].'</option>';
              }          
              $htmlbody .='</select></div>';
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  $htmlbody .= '<option value="'.$d['department_name'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div>
              <div id="kanban">
                    
              </div>
            <input type="hidden" class="form-control input-class-available-subjectList" name="idsubject_available" aria-describedby="basic-addon1" required="required">
            <input type="hidden" class="form-control input-class-subjectList" name="idsubject" aria-describedby="basic-addon1" required="required">
         </form>';
        $htmlbody .= '<div class="col-md-12 text-center roboto no-subject-div " style="display:none;">No Available Subjects</div>';
        $htmlfooter = '<button type="submit" form="mdl-frm-add-student" class="btn btn-primary btn-post-add-subject"><i class="material-icons">playlist_add_check</i></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="material-icons">close</i></button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }

    public function modalUpdateUser(){
        
        $htmlbody = '<center><span class="material-icons">warning</span>ALL FIELD ARE REQUIRED</center>'; 
        if($_POST['user_level'] == 1){
            
            $header = array("code","user","firstname","middlename","lastname","year_level");
            $labels = array("ID no","Username","Firstname","Middlename","Lastname","Year Level");
        }else if($_POST['user_level'] == 2){
            $header = array("code","user","firstname","middlename","lastname");
        }
        $htmlbody .= '<form action="users/updateUser" method="POST" id="mdl-frm-update-user">
                        <input type="hidden" value="'.$_POST['user_level'].'" name="user_level">
                        <input type="hidden" value="'.$_POST['idusers'].'" name="idusers">';
        $labels = array("ID no","Username","Firstname","Middlename","Lastname","Year Level");
        foreach($header as $key => $h){
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">'.ucwords($labels[$key]).'</div></span>
                            <input type="text" class="form-control" value="'.$_POST[$h].'" name="'.$h.'" aria-describedby="basic-addon1" required="required">
                        </div>';   
        }
        if($_POST['user_level'] == 2){
            $htmlbody .= '<div class="input-group" style="margin-bottom:10px;">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Position</div></span>
                            <select name="position" data-placeholder="Choose Department" class="chzn-select" required="required">
                                <option '.(($_POST["position"] == "1") ? "selected='selected'":"").' value="1">
                                    Faculty Teacher
                                </option>
                                <option '.(($_POST["position"] == "2") ? "selected='selected'":"").' value="2">
                                    Dean
                                </option>
                            </select>
                        </div>';
        }
        if($_POST['user_level'] == 1){
            
            $this->load->model('mdl_courses');
            $course = $this->mdl_courses->getAllcourses();
      
            $htmlbody .= '<div class="input-group">
                            <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Course</div></span>
                            <select name="course" data-placeholder="Choose course" class="chzn-select" required="required">';
                foreach($course as $c){
                    if($c['idcourse'] == $_POST['idcourse']){
                        $htmlbody .= '<option selected="selected" value="'.$c['idcourse'].'">'.$c['course_name'].'</option>';
                    }else{
                        $htmlbody .= '<option value="'.$c['idcourse'].'">'.$c['course_name'].'</option>';
                    }
                    
                }
                $htmlbody .='</select></div>';
        }
        $this->load->model('mdl_departments');
        $department = $this->mdl_departments->getAllDepartments();
        $htmlbody .= '<div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><div style="width:100px;float:left;text-align:right;">Department</div></span>
                        <select name="department" data-placeholder="Choose Department" class="chzn-select" required="required">';
              foreach($department as $d){
                  if($d['iddepartment'] == $_POST['iddepartment']){

                    $htmlbody .= '<option selected="selected" value="'.$d['iddepartment'].'">'.$d['department_name'].'</option>';
                  }
                    $htmlbody .= '<option value="'.$d['iddepartment'].'">'.$d['department_name'].'</option>';
              }          
              $htmlbody .='</select></div>
              <div id="kanban">       
                </div>
                <input type="hidden" class="form-control input-class-subjectList" name="idsubject" aria-describedby="basic-addon1" required="required">
                <input type="hidden" class="form-control input-class-available-subjectList" name="idsubject_available" aria-describedby="basic-addon1" required="required">
            </form>';
        $htmlbody .= '<div class="col-md-12 text-center roboto no-subject-div" style="display:none;">No Available Subjects</div>';
        $htmlfooter = '<button type="submit" form="mdl-frm-update-user" class="btn btn-primary btn-post-user-update">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>';
        echo json_encode(array('body'=>$htmlbody,'footer'=>$htmlfooter));
    }


}
