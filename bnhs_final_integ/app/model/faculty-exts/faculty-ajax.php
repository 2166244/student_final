<?php 
require '../connection.php';
class FacultyAjax {

	public function __construct() {
		$this->conn = new Connection;
		$this->conn = $this->conn->connect();
	}

	public function setLevel() {
		$year_level = explode('=', $_POST['data'][1]);
		$sql = $this->conn->query("SELECT subj_level FROM subject JOIN section ON subj_level = grade_lvl WHERE sec_id = ".$year_level[1]." GROUP BY grade_lvl");
		$result = $sql->fetch();
		$_SESSION['subj_lvl'] = $result['subj_level'];
	}

	public function setDept() {
		$subj_id = explode('=', $_POST['data'][1]);
		$sql = $this->conn->query("SELECT fac_id, CONCAT(fac_fname, ' ', fac_midname, ' ', fac_lname) 'name' FROM subject JOIN faculty ON subj_dept = fac_dept WHERE subj_id = ".$subj_id[1]);
		$result = $sql->fetchAll();
		$option = '';
		foreach($result as $row) {
			$option .= '<option value="'.$row['fac_id'].'">'.$row['name'].'</option>';
		}
		echo $option;
	}

	public function fillOutForm() {
		$id = explode('=', $_POST['data'][1]);
		$sql = $this->conn->query("SELECT * FROM student st JOIN guardian gr ON st.guar_id = gr.guar_id WHERE st.guar_id = '".$id[1]."' GROUP BY st.guar_id LIMIT 1");
		$_SESSION['full_stud_guar_info'] = $sql->fetchAll();
	}
}

/* OUTSIDE THE CLASS */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$run = new FacultyAjax;
if(isset($_POST['data'][0]) && $_POST['data'][0] === 'setLevel') $run->setLevel();
if(isset($_POST['data'][0]) && $_POST['data'][0] === 'setSubj') $run->setDept();
if(isset($_POST['data'][0]) && $_POST['data'][0] === 'filloutform') $run->fillOutForm();
?>