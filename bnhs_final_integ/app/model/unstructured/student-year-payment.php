<?php
require '../connection.php';
class StudentYearSession {
	public function filterYear() {
		$_SESSION['year'] = $_POST['year'];
		header('location: student-accounts');
	}
}
if (session_start() == PHP_SESSION_NONE) {
	session_start();
}
$run = new StudentYearSession;
$run->filterYear();
?>