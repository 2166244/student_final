<!-- 
	Enrollment should be closed if classes are not yet finished
	Enrollment is open to all faculty while Transfering of student is only accessible to advisers 
-->
<?php
require 'app/model/connection.php';
require 'app/model/other-funct.php';
class FacultyFunct {

	public function __construct() {
		$this->others = new OtherMethods;
		$this->conn = new Connection;
		$this->conn = $this->conn->connect();
		$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
	}

	/********************** START OF DASHBOARD **********************/

	public function getNoOfStudent() {
		$query = $this->conn->prepare("SELECT * FROM student");
		$query->execute();
		$getRowCount = $query->rowCount();
		echo $getRowCount;
	}

	public function getNoOfMaleStudent() {
		$query = $this->conn->prepare("SELECT * FROM student WHERE gender='Male'");
		$query->execute();
		$getRowCount = $query->rowCount();
		echo $getRowCount;
	}

	public function getNoOfFemaleStudent() {
		$query = $this->conn->prepare("SELECT * FROM student WHERE gender='Female'");
		$query->execute();
		$getRowCount = $query->rowCount();
		echo $getRowCount;
	}

	public function getNoOfNewStudent() {
		$query = $this->conn->prepare("SELECT * FROM student WHERE curr_stat='New'");
		$query->execute();
		$getRowCount = $query->rowCount();
		echo $getRowCount;
	}

	public function getAnnouncements() {
		$query = $this->conn->prepare("SELECT * FROM announcements WHERE view_lim = '2'");
		$query->execute();
		$result = $query->fetchAll();
		foreach($result as $row) {
			$html = '<div class="announcement">';
			$html .=
				'<h2 class="title">'.$row['title'].'</h2>
				<p class="description">'.$row['post'].'</p>';
			$html .= $row['attachment'] !== null ? '<p>Download - <a href="attachments/'.$row['attachment'].'" download>attachment</a></p>' : '';
			$html .= '</div>';
			echo $html;
		}
	}

	/********************** END OF DASHBOARD **********************/

	/********************** START OF ENROLLMENT **********************/

	public function oldStud() {
		$query = $this->conn->prepare("SELECT *, CONCAT(first_name,' ',middle_name,' ',last_name) as 'Name', CONCAT(guar_fname,' ', guar_midname,' ', guar_lname) as 'guar_name', guar_mobno FROM student st JOIN guardian gr ON st.guar_id = gr.guar_id WHERE curr_stat = 'Old' AND stud_status = 'Not Enrolled' AND stud_status <> 'Graduated' AND stud_status <> 'Transferred' ORDER BY year_level;");
		$query->execute();
		$result = $query->fetchAll();
		foreach($result as $row) {
			$options = $this->createOption(array('Officially Enrolled', 'Temporarily Enrolled', 'Transfer'), $row['stud_status']);
			echo '<tr>';
			echo '<td>'.$row['stud_lrno'].'</td>';
			echo '<td>'.$row['Name'].'</td>';
			echo '<td>'.$row['stud_status'].'</td>';
			echo '<td><div class="btn-grp">';
			echo $this->editStatusMessage($row['Name'], $options, $row['stud_lrno']);
			echo $this->editDetailsMessage($row);		
			echo '</td></div>';
			echo '<td>'.$row['year_level'].'</td>';
			echo '</tr>';
		}
	}

	public function enrollNewStudent($post) {
		$post['new_address'] = $post['address'].', '.$post['barangay'].', '.$post['city'].' '.$post['zipcode'];

		if ($this->checkIfExist($post['stud_lrno']) === 0) {
			$school_year = date('Y');
			$stud_username = str_replace(' ', '', ($post['first_name'][0].$post['middle_name'][0].$post['last_name']));
			if (isset($post['guar_id'])) {
				$add = $this->getGuarParInfo($post['guar_id']);
				$mother_name = $add['mother_name'];
				$father_name = $add['father_name'];
				$guar_id = $post['guar_id'];
			} else {
				$guar_id = $this->forGuarAcc($post);
				$mother_name = (!empty($post['mothername_first']) ? ($post['mothername_first'].' '.$post['mothername_middle_name'][0].'. '.$post['mothername_last']) : null);
				$father_name = (!empty($post['fathername_first']) ? ($post['fathername_first'].' '.$post['fathername_middle_name'][0].'. '.$post['fathername_last']) : null);
			}
			$stud_id = $this->createAccount($stud_username, 'password', 'Student');
			$getSecID = $this->getSection($post['gender'], $post['year_level']);
			$query = ("INSERT INTO student (stud_lrno, last_name, first_name, middle_name, gender, year_level, school_year, stud_address, stud_bday, mother_name, father_name, nationality, ethnicity, year_in, year_out, blood_type, medical_stat, stud_status, curr_stat, accc_id, secc_id, guar_id").(") VALUES (:stud_lrno, :last_name, :first_name, :middle_name, :gender, :year_level, :school_year, :stud_address, :stud_bday, :mother_name, :father_name, :nationality, :ethnicity, :year_in, :year_out, :blood_type, :medical_stat, :stud_status, 'New', :accc_id, :secc_id, :guar_id)");
			$insert_stud = $this->conn->prepare($query);
			$insert_stud->execute(array(
				':stud_lrno' => $post['stud_lrno'],
				':last_name' => $post['last_name'],
				':first_name' => $post['first_name'],
				':middle_name' => $post['middle_name'],
				':gender' => $post['gender'],
				':year_level' => $post['year_level'],
				':school_year' => $school_year,
				':stud_address' => $post['new_address'],
				':stud_bday' =>	$post['stud_bday'],
				':mother_name' => $mother_name,
				':father_name' => $father_name,
				':nationality' => $post['nationality'],
				':ethnicity' => $post['ethnicity'],
				':year_in' => $school_year,
				':year_out' => null,
				':blood_type' => $post['blood_type'],
				':medical_stat' => (empty($post['medical_stat']) ? null : $post['medical_stat']),
				':stud_status' => $post['stud_status'],
				':accc_id' => $stud_id,
				':secc_id' => $getSecID,
				':guar_id' => $guar_id
			));
			$this->others->Message("The student has successfully been enrolled, redirecting you to the assessment page.", "rgb(0,244,0)", "faculty-assess", "redirect");
		} else {
			$this->others->Message("The student is successfully enrolled!", "rgb(244,0,0)", "faculty-enroll", "redirect");
		}
	}

	public function updateStudentDetails($post) {		
		if ($this->checkStatus($post['lrn'], $post['curr-status']) === false) {
			$curr_stat = $this->conn->query("SELECT * FROM student WHERE stud_lrno = '".$post['lrn']."'");
			$result = $curr_stat->fetch();
			if ($post['curr-status'] === 'Transfer') {
				$change_stat = $this->conn->query("UPDATE student SET stud_status = 'Transferred' WHERE stud_lrno ='".$post['lrn']."'");
				$this->others->Message("The student has been transferred!", "rgb(0,244,0)", "faculty-enroll", "redirect");
			} else {
				$change_stat = $this->conn->query("UPDATE student SET stud_status = '".$post['curr-status']."' WHERE stud_lrno ='".$post['lrn']."'");
				if ($result['stud_status'] === 'Not Enrolled') {
					$getCurrent_year_level = $this->conn->query("SELECT year_level, gender FROM student WHERE stud_lrno='".$post['lrn']."'");
					$result = $getCurrent_year_level->fetch();
					$newyr_lvl = (int) $result['year_level'] + 1;
					$newSec = $this->getSection($result['gender'], strval($newyr_lvl));
					$this->conn->query("UPDATE student SET year_level='".$newyr_lvl."', secc_id='".$newSec."' WHERE stud_lrno='".$post['lrn']."'");
					$this->others->Message("The student is successfully enrolled!", "rgb(0,244,0)", "faculty-enroll", "redirect");
				} else {
					$this->others->Message("The status of the student has been changed successfully!", "rgb(0,244,0)", "faculty-enroll", "redirect");
				}
			}
		} else {
			$this->others->Message("The status was not changed since it is already the current status.", "rgb(244,0,0)", "faculty-enroll", "redirect");	
		}
	}

	public function getGuardians() {
		$sql = $this->conn->query("SELECT * FROM student st JOIN guardian gr ON st.guar_id = gr.guar_id GROUP BY gr.guar_id") or die("There is an error in your query");
		$result = $sql->fetchAll();
		foreach($result as $row) {
			echo '<option value="'.$row['guar_id'].'">'.$row['guar_fname'].' '.$row['guar_midname'].$row['guar_lname'].'</option>';
		}
	}

	private function getGuarParInfo($guar_id) {
		$sql = $this->conn->query("SELECT * FROM student st JOIN guardian gr ON st.guar_id = gr.guar_id WHERE st.guar_id = '".$guar_id."' GROUP BY st.guar_id LIMIT 1");
		return $sql->fetch();
	}

	private function checkStatus($lrn, $new_stat) {
		$sql = $this->conn->query("SELECT * FROM student WHERE stud_lrno = '".$lrn."'");
		$result = $sql->fetch();
		return $result['stud_status'] === $new_stat ? true : false;
	}

	private function forGuarAcc($post) {
		$guarAccID = $this->createAccount($post['guar_last'], 'password', 'Parent');
		$insert_par = $this->conn->prepare("INSERT INTO guardian (guar_fname, guar_lname, guar_midname, guar_address, guar_mobno, guar_telno, acc_idx) VALUES (:guar_fname, :guar_lname, :guar_midname, :guar_address, :guar_mobno, :guar_telno, :acc_idx)");
		$array = array(
			':guar_fname' => $post['guar_first'],
			':guar_lname' => $post['guar_last'],
			':guar_midname' => $post['guar_middle_name'],
			':guar_address' => $post['new_address'],
			':guar_mobno' => $post['guar_mobno'],
			':guar_telno' => (empty($post['guar_telno']) ? $post['guar_telno'] : null),
			':acc_idx' => $guarAccID
		);
		$insert_par->execute($array) or die('Not Working!');
		$getID = $this->conn->query("SELECT guar_id FROM guardian WHERE acc_idx=".$guarAccID."");
		$result = $getID->fetch();
		return $result['guar_id'];
	}

	/********************** END OF ENROLLMENT **********************/

	/********************** START OF STUDENT LIST **********************/

	public function showAdvStudent($fac_id) {
		$sql = $this->conn->prepare("SELECT  *, CONCAT(first_name, ' ', middle_name, ' ', last_name) as stud_fullname FROM student JOIN section ON secc_id = sec_id JOIN faculty ON fac_id = fac_idv WHERE fac_id = (SELECT fac_id FROM faculty join accounts ON acc_id = acc_idz WHERE acc_id=:fac_id)");
		$sql->execute(array(':fac_id' => $fac_id));
		$result = $sql->fetchAll();
		foreach ($result as $row) {
			echo '<tr>';
			echo '<td>'.$row['stud_lrno'].'</td>';
			echo '<td>'.$row['stud_fullname'].'</td>';
			echo '<td><button>Transfer</button></td>';
			echo '</tr>';
		}
	}

	public function getAdvSection($acc_id) {
		$sql = $this->conn->prepare(" SELECT  CONCAT('Grade ', grade_lvl, ' - ', sec_name) AS section_handled FROM accounts JOIN faculty ON acc_id = acc_idz JOIN section ON fac_id = fac_idv WHERE acc_id = :acc_id;");
		$sql->execute(array(':acc_id' => $acc_id));
		$result = $sql->fetch();
		echo $result['section_handled'];
	}

	/*public function studList() {
		$query = $this->conn->prepare("SELECT stud_lrno, CONCAT(first_name,' ',middle_name,' ',last_name) as 'Name', CONCAT('GRADE ',year_level,' - ',sec_name) as 'stud_sec' FROM student JOIN section ON secc_id = sec_id");
		$query->execute();
		$result = $query->fetchAll();
		foreach($result as $row) {
			echo '<tr><td>'.$row['stud_lrno'].'</td><td>'.$row['Name'].'</td><td>'.$row['stud_sec'].'</td><td><button data-lrn="'.$row['stud_lrno'].'" class="assessment-button""><i class="far fa-eye"></i></button></td></tr>';	
		}
	}

	public function changeStudentStatus($lrn, $newStatus) {
		$query = $this->conn->prepare("UPDATE student SET stud_status=:newStatus, curr_stat='old' WHERE stud_lrno=:lrn");
		$query->execute(array(
			':newStatus' => $newStatus,
			':lrn' => $lrn
		));
		$this->others->Message('Success! The status has been changed.', 'rgb(0,244,0)', 'faculty-enroll', 'redirect');
	}*/

	/********************** END OF STUDENT LIST **********************/

	/********************** START OF CLASSES HANDLED **********************/

	public function postAnnc($details, $file) {
		date_default_timezone_set('Asia/Manila');
		$datetime = '0000-00-00 00:00:00'; //sample only
		$timestamp = date("Y-m-d H:i:s");
		$query = $this->conn->prepare("INSERT INTO announcements (title, date_start, date_end, post, view_lim, attachment, timestamp_ann, post_facid) VALUES (:title, :date_start, :date_end, :post, :view_lim, :attachment, :timestamp_ann, :post_facid)");
		$query->execute(array(
			':title' => $details['title'],
			':date_start' => $datetime,
			':date_end' => $datetime,
			':post' => (isset($details['post']) ? $details['post'] : null), //if post is null then insert null to db
			':view_lim' => '2',
			':attachment' => (empty($file['name']) ? null : $file['name']), //if attachment is null then insert null to db
			':timestamp_ann' => $timestamp,
			':post_facid' => $details['acc_id']
		));
		if (!empty($file['name'])) move_uploaded_file($file['tmp_name'], 'attachments/'.$file['name']); //this moves the file to the server if the attachment is not empty
	}

	public function setSchedule($post) {
		$time_start = array('07:40:00', '08:40:00', '10:00:00', '11:00:00', '13:00:00', '14:00:00', '15:00:00');
		$time_end = array('08:40:00', '09:40:00', '11:00:00', '12:00:00', '14:00:00', '15:00:00', '16:00:00');
		for($c = 0; $c < count($time_start); $c++ ) {
			echo $this->checkExisitingSched($time_start[$c], $post['sec_id']);
		}
	}

	private function checkExisitingSched($time_start, $sec_id) {
		$sql = $this->conn->query("SELECT  * FROM schedsubj WHERE time_start = '".$time_start."' AND sw_id = '".$sec_id."'");
		$rc = $sql->rowCount();
		return $rc == 0 ? false : true;
	}

	private function insertSchedSubj($schedsubjb_id, $time_start, $time_end, $fw_id, $sw_id) {
		
		$sql = $this->conn->query("INSERT INTO schedsubj (schedsubja_id, schedsubjb_id, day, time_start, time_end, fw_id, sw_id) VALUES ()");
	}

	/********************** DIVISION FOR CLASSES (BELOW EDIT CLASSES) **********************/

	public function showSections() {
		$sql = $this->conn->query("SELECT * FROM section");
		$result = $sql->fetchAll();
		$option = '';
		foreach ($result as $row) {
			$option .= '<option value="'.$row['sec_id'].'">Grade '.$row['grade_lvl'].' - '.$row['sec_name'].'</option>';
		}
		echo $option;
	}

	public function showFaculties() {
		$sql = $this->conn->query("SELECT * FROM faculty WHERE fac_adviser='No'");
		$result = $sql->fetchAll();
		$option = '';
		foreach ($result as $row) {
			$option .= '<option value="'.$row['fac_id'].'">'.$row['fac_fname'].' '.$row['fac_midname'].' '.$row['fac_lname'].'</option>';
		}
		echo $option;
	}

	public function getSubjects($level) {
		$sql = $this->conn->prepare("SELECT * FROM subject WHERE subj_level = :level");
		$sql->execute(array(
			':level' => $level
		));
		$option = '<option value="">Select a subject</option>';
		$result = $sql->fetchAll();
		foreach($result as $row) {
			$option .= '<option value="'.$row['subj_id'].'">'.$row['subj_name'].'</option>';
		}
		echo $option;
	}

	public function displayTeachers($subject) {
		$sql = $this->conn->query("SELECT * FROM faculty WHERE fac_dept LIKE '%".$subject."%'");
		$option = '<option value="">Select a teacher</option>';
		$result = $sql->fetchAll();
		foreach($result as $row) {
			$option .= '<option value="'.$row['fac_id'].'">'.$row['fac_fname'].' '.$row['fac_midname'][0].'. '.$row['fac_lname'].'</option>';
		}
		echo $option;
	}

	/********************** END OF CLASSES HANDLED **********************/

	/********************** START OF PRIVATE METHODS **********************/
	private function createAccount($username, $password, $acctype) {
		$newPass = password_hash($password, PASSWORD_DEFAULT);
		$queryInsert = $this->conn->prepare("INSERT INTO accounts (username, password, acc_status, acc_type) VALUES (?, ?, 'Active', ?)");
		$queryInsert->bindParam(1, $username);
		$queryInsert->bindParam(2, $newPass);
		$queryInsert->bindParam(3, $acctype);
		$queryInsert->execute();
		$querySearch = $this->conn->prepare("SELECT acc_id FROM accounts WHERE username=?");
		$querySearch->bindParam(1, $username);
		$querySearch->execute();
		$row = $querySearch->fetch();
		$newUsername = $username.$row['acc_id'];
		$getaccid = $row['acc_id'];
		$queryUpdate = $this->conn->prepare("UPDATE accounts SET username=? WHERE username=?");
		$queryUpdate->bindParam(1, $newUsername);
		$queryUpdate->bindParam(2, $username);
		$queryUpdate->execute();
		return $getaccid;
	}

	private function checkIfExist($lrn) {
		$query = $this->conn->prepare("SELECT stud_lrno FROM student WHERE stud_lrno = ?");
		$query->bindParam(1, $lrn);
		$query->execute();
		return $query->rowCount();		
	}

	private function getSection($gender, $year_level) {
		$query = $this->conn->prepare("SELECT  CASE WHEN sec1.count < sec2.count THEN sec1.sec_id WHEN sec1.count > sec2.count THEN sec2.sec_id WHEN sec1.count = sec2.count THEN sec1.sec_id WHEN COUNT(sec1.sec_id) = 0 THEN (SELECT  sec_id FROM section WHERE grade_lvl = :year_level ORDER BY 1 LIMIT 1) ELSE sec1.sec_id END AS sec_id FROM (SELECT  COUNT(gender) AS 'count', sec_id FROM student JOIN section ON secc_id = sec_id WHERE year_level = :year_level AND gender = :gender GROUP BY secc_id ORDER BY 2 LIMIT 1) sec1 JOIN (SELECT  COUNT(gender) AS 'count', sec_id FROM student JOIN section ON secc_id = sec_id WHERE year_level = :year_level AND gender = :gender GROUP BY secc_id ORDER BY 2 DESC LIMIT 1) sec2");
		$query->execute(array(
			':year_level' => $year_level,
			':gender' => $gender
		));
		$result = $query->fetch();
		return $result['sec_id'];
	}

	/*For long echo messages add them here and set them as private to avoid being used and showing long echos between methods*/
	private function editStatusMessage($name, $options, $lrno) {
		return '<div class="edit-status-cont">
				<div name="dialog" title="Edit status for '.$name.'">
						<div class="container">
							<div class="modal-cont">
								<form action="faculty-enroll" method="POST">
									<input type="hidden" value="'.$lrno.'" name="lrn">
									<label>Status: </label>
									<select name="curr-status">
										'.$options.'
									</select>
									<button type="submit" name="change-stud-status">Change</button>
								</form>
							</div>
						</div>
					</div>
				<button type="button" name="opener" class="edit-status" data-type="open-dialog">STATUS</button>
				</div>';
	}
	private function editDetailsMessage($row) {
		$radio = $row['gender'] === 'Male' ? '<input type="radio" name="gender" value="Male" checked="checked" required/>MALE&nbsp;&nbsp;<input type="radio" name="gender" value="Female"/>FEMALE' : '<input type="radio" name="gender" value="Male" required/>MALE&nbsp;&nbsp;<input type="radio" name="gender" checked="checked" value="Female"/>FEMALE';
		$options1 =  $this->createOption(array('7', '8', '9', '10'), $row['year_level']);
		$options2 =  $this->createOption(array('O', 'A', 'B', 'AB'), $row['blood_type']);
		return '<div class="edit-details-cont">
				<div name="dialog" title="Edit student information">
					<div class="container">
						<div class="modal-cont">
							<form action="faculty-enroll" method="POST" class="edit-stud-detail" id="Student-Details-All">
								<div class="tabs">
									<ul>
										<li><a href="#Student-Details">STUDENT INFORMATION</a></li>
										<li><a href="#Gar-Details">PARENT\'S AND GUARDIAN\'S INFORMATION</a></li>
									</ul>
									<div id="Student-Details">
										<label>
											<span>LEARNER REFERENCE No. (LRN):<span class="required">&nbsp;*</span></span>
											<input type="text" value="'.$row['stud_lrno'].'" name="stud_lrno" data-validation="length" data-validation="number" data-validation-length="13" data-validation-error-msg="Your input is an invalid LRN Number" required>
										</label>
										<label>
											<span>LAST NAME:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['last_name'].'" type="text" name="last_name" required>
										</label>
										<label>
											<span>FIRST NAME:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['first_name'].'" type="text" name="first_name" required>
										</label>
										<label>
											<span>MIDDLE NAME:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['middle_name'].'" type="text" name="middle_name" required>
										</label>
										<div class="date-sex">
											<label>
												<span>DATE OF BIRTH:<span class="required">&nbsp;*</span> </span>
												<input value="'.$row['stud_bday'].'" type="text" class="datepicker" name="stud_bday" required>
											</label>
											<label>
												<span>SEX:<span class="required">&nbsp;*</span> </span>
												<span>'.$radio.'</span>
											</label>
										</div>
										<label>
											<span>GRADE LEVEL:<span class="required">&nbsp;*</span> </span>
											<select name="year_level">
												'.$options1.'
											</select>
										</label>
										<label>
											<span>BLOOD TYPE:<span class="required">&nbsp;*</span> </span>
											<select name="blood_type">
												'.$options2.'
											</select>
										</label>
										<label>
											<span>NATIONALITY:<span class="required">&nbsp;*</span> </span>
											<input type="text" value="'.$row['nationality'].'" name="nationality" required>
										</label>
										<label>
											<span>ETHNICITY:<span class="required">&nbsp;*</span> </span>
											<input type="text" value="'.$row['ethnicity'].'" name="ethnicity" required>
										</label>
										<label>
											<span>MEDICAL STATUS:</span>
											<input type="text" value="'.$row['medical_stat'].'" name="medical_stat">
										</label>
										<label>
											<span>Address:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['stud_address'].'" type="text" name="address" required>
										</label>
									</div>
									<div id="Gar-Details">
										<label>
											<span>GUARDIAN\'S NAME:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['guar_name'].'" type="text" name="guar_name" required>
										</label>
										<label>
											<span>GUARDIAN\'S TELEPHONE NUMBER: </span>
											<input value="'.$row['guar_telno'].'"type="text" name="guar_telno">
										</label>
										<label>
											<span>GUARDIAN\'S CELLPHONE NUMBER:<span class="required">&nbsp;*</span> </span>
											<input value="'.$row['guar_mobno'].'" type="text" name="guar_mobno" data-validation="length" data-validation="number" data-validation-length="11" data-validation-error-msg="It is not a valid cellphone number" required>
										</label>
									</div>
								</div>
								<div class="bot-cont">
									<p>All with <span class="required">*</span> is required.</p>
									<button name="modify-stud-details" type="submit">SAVE</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<button type="button" name="opener" class="edit-details" data-type="open-dialog">DETAILS</button>
				<script></script>
			</div>';
	}

	private function createOption() {
		$args = func_get_args();
		$numArgs = func_num_args();
		$generateOptions = function($arr, $main) {
			if (!is_array($arr)) {
				return 'Error!';
			} else {
				$html = '';
				foreach ($arr as $row) {
					$html .= ($row === $main ? '<option value="'.$row.'" selected>'.$row.'</option>' : '<option value="'.$row.'">'.$row.'</option>');
				}
				return $html;
			}
		};
		return $numArgs == 0 ? '<option value="">Invalid Parameters</option>' : ($numArgs == 1 ? '<option>'.$args[0].'</option>' : $generateOptions($args[0], $args[1]));
	}

	/********************** END OF PRIVATE METHODS **********************/
	/***** FOR GROUP MEMBER PURPOSES TO BE DELETE ON FINAL *****/
}
?>