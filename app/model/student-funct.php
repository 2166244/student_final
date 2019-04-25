<?php
require 'app/model/connection.php';

class studentFunct {

	public function __construct() {
		$this->conn = new Connection;
		$this->conn = $this->conn->connect();
	}

    public function getSchoolYear(){
        $query = $this->conn->prepare("SELECT school_year 'sy' FROM student group by 1");
        $query->execute();
        $rowCount = $query->fetch();
        $rowCount1 = $rowCount['sy'] + 1;
        echo " " . $rowCount['sy'] . "-" . $rowCount1 . " ";
    }
    /************** DASHBOARD **********************/

    public function getStatus() {
      $query = $this->conn->prepare("SELECT * from student join accounts on student.accc_id = accounts.acc_id join section on student.secc_id = section.sec_id where accounts.acc_id = ?");
      $query->bindParam(1, $_SESSION['accid']);
      $query->execute();
      $getRowCount = $query->rowCount();
      while($row = $query->fetch()) {
        $status = $row['stud_status'];
        $attendancelink = URL.'student-attendance';
        echo "<div class='contin'>
        <p>".$row['stud_status']." in this school year: <span class='text-bold'> ".$row['school_year']."</span></p>
        <p>Grade ".$row['year_level']." - ".$row["sec_name"]."</p>
        <p>See <a href='$attendancelink'>absences/tardiness!</a></p>
        </div> ";
    }
}

public function getAnnouncement() {
    $query = $this->conn->prepare("SELECT title, post, concat(fac_fname, ' ', fac_midname, '. ', fac_lname) as fname, attachment FROM announcements an JOIN faculty f ON an.post_facid = f.fac_id JOIN schedsubj ss ON f.fac_id = ss.fw_id JOIN subject ON subject.subj_id = ss.schedsubja_id WHERE (view_lim like '%0%' or view_lim like '%3%') GROUP BY ann_id");
    $query->execute(); 
    $result = $query->fetchAll();
    foreach ($result as $row) {
        $html =
            '<div id="announcements">';
        $html .=
                '<h2 class="title">'.$row['title'].'</h2>
                <p class="description">'.$row['post'].'</p>';
            $html .= $row['attachment'] !== null ? '<p>Download - <a href="attachments/'.$row['attachment'].'" download>attachment</a></p>' : '';
            $html .= '</div>';
        echo $html;
    }
}

public function getPerformance(){
    $query = $this->conn->prepare("SELECT 
        gr_level, average, rank
        FROM
        rank
        JOIN
        student ON student.stud_id = rank.stud_idf
        JOIN
        accounts ON student.accc_id = accounts.acc_id
        WHERE
        accounts.acc_id = ?
        ORDER BY gr_level ");
    $query->bindParam(1,$_SESSION['accid']);
    $query->execute();
    $getRowNum = $query->rowCount();
    if($getRowNum > 0){
        echo "<table>
        <tr>
        <th>Grade Level</th>
        <th>Average</th>
        <th>Rank</th>
        </tr>";
        while($row = $query->fetch()){
            echo "
            <tr>
            <td><span>Grade ".$row['gr_level']."</span></td>
            <td><span> ".$row['average']." </span></td>
            <td><span>".$row['rank']."</span></td>
            </tr>";
        }
        echo "</table>";
    }
}



/************** ATTENDANCE **********************/

public function studAttendance() {
  $query = $this->conn->prepare("SELECT att_date, remarks, subject.subj_name, view_lim FROM attendance att JOIN student stud ON stud.stud_id = att.stud_ida JOIN subject ON subject.subj_id = att.subjatt_id JOIN accounts acc ON stud.accc_id = acc.acc_id where acc.acc_id = ? ");
  $query->bindParam(1, $_SESSION['accid']);
  $query->execute();
  $getRowCount = $query->rowCount();
  if($getRowCount > 0){
    $html = '<table class="display" id="stud-attendance-table">
    <tr>
    <th>Subject</th>
    <th>Date</th>
    <th>Tardy/Absent</th>
    </tr>';
    echo $html;
    while($row = $query->fetch()) {       
        $html = '<tr>
        <td><span>' .$row['subj_name']. '</span></td>
        <td><span>' .$row['att_date']. '</span></td>
        <td><span>' .$row['remarks']. '</span></td>
        </tr>';
        echo $html;
    }
    echo '</table>';
}else{
    echo "<p>No absences! Keep it up!</p>";
}
}

/************** Statements of Account **********************/
public function getBalance() {
  $query = $this->conn->prepare("SELECT * from balance join student on balance.stud_idb = student.stud_id join accounts on student.accc_id = accounts.acc_id where accounts.acc_id = ?");
  $query->bindParam(1, $_SESSION['accid']);
  $query->execute();
  $getRowCount = $query->rowCount();
  $today = date("F d, Y");
  if ($getRowCount > 0) {
      while($row = $query->fetch()) {
         echo "".number_format($row['bal_amt'], 2)." as of ".$today." ";
     }
 }
}

public function getPaymentHisto($year) {
  $query = $this->conn->prepare("SELECT date_format(p.pay_date, '%M %d, %Y') as 'pay_date', p.pay_amt as 'amt_paid' from balance b join payment p on p.balb_id = b.bal_id join student s on b.stud_idb = s.stud_id join accounts a on s.accc_id = a.acc_id where a.acc_id = :acc_id and date_format(p.pay_date, '%Y') = :year");
  $query->execute(array(":acc_id" => $_SESSION['accid'], ":year" => $year));
  $getRowCount = $query->rowCount();
  if ($getRowCount > 0) {
    $row = $query->fetchAll();
    $array = array();
    for($c = 0; $c < $getRowCount; $c++){
        $datePaid = $row[$c]['pay_date'];
        $amtPaid = $row[$c]['amt_paid'];
        array_push($array, $amtPaid);
        echo '<tr>
        <td>'.$datePaid.'</td>
        <td class="align-right">&nbsp;'.number_format($amtPaid, 2).'</td>
        </tr>';          
    }
    $total = array_sum($array);
    echo '<tr><td class="bold total">Total</td><td class="bold total align-right">&#8369;&nbsp;'.number_format($total, 2).'</td></tr>';

}

}

public function getBreakdown() {
  $query= $this->conn->prepare("SELECT budget_name, total_amount from budget_info");
  $query->execute();
  $getRowCount = $query->rowCount();
  $row = $query->fetchAll();
  $array = array();
  for($c = 0; $c < count($row); $c++){
    $budgetAmount = $row[$c]['total_amount'];
    $budgetName = $row[$c]['budget_name'];
    array_push($array, $budgetAmount);
    echo '<tr>
    <td>'.$budgetName.'</td>
    <td class="align-right">&nbsp;'.number_format($budgetAmount, 2).'</td>
    </tr>';
}
$total = array_sum($array);
echo '<tr><td class="bold total">Total</td><td class="bold total align-right">&#8369;&nbsp;'.number_format($total, 2).'</td></tr>';
}

public function getPayYear() {
    $query= $this->conn->prepare("select date_format(pay_date, '%Y') as 'year' from payment group by 1");
    $query->execute();
    while($row = $query->fetch(PDO::FETCH_ASSOC)){
        $data[] = $row;
    }
    return $data;
}

public function getChildGrade($id)
{
    /*******************Get subject name*******************/
    $query = $this->conn->prepare("SELECT 
        subj_name
        FROM
        grades
        JOIN
        student ON grades.studd_id = student.stud_id
        JOIN
        facsec fs ON grades.secd_id = fs.sec_idy
        JOIN
        schedsubj ss ON (grades.facd_id = ss.fw_id
        && grades.secd_id = ss.sw_id)
        JOIN
        subject ON (ss.schedsubjb_id = subject.subj_id && grades.subj_ide = subject.subj_id)
        JOIN
        accounts ac ON student.accc_id = ac.acc_id
        WHERE
        ac.acc_id = ? 
        group by 1 ORDER BY 1");
    $query->bindParam(1,$id);
    $query->execute();
    $subjects = $query->fetchAll();
        $acc_id  = $id; //sample
        /*$rowCount1 = $query1->rowCount();*/
        
        /*******************Get student grade*******************/
        for ($c = 0; $c < count($subjects); $c++) {
            $subject_name = $subjects[$c]['subj_name'];
            $first        = $this->getGrade($acc_id, $subject_name, '1st');
            $second       = $this->getGrade($acc_id, $subject_name, '2nd');
            $third        = $this->getGrade($acc_id, $subject_name, '3rd');
            $fourth       = $this->getGrade($acc_id, $subject_name, '4th');
            $average      = ($first + $second + $third + $fourth) / 4;
            echo '<tr>';
            echo '<td>' . $subject_name . '</td>';
            echo $first === 0 ? '<td></td>' : '<td>' . $first . '</td>';
            echo $second === 0 ? '<td></td>' : '<td>' . $second . '</td>';
            echo $third === 0 ? '<td></td>' : '<td>' . $third . '</td>';
            echo $fourth === 0 ? '<td></td>' : '<td>' . $fourth . '</td>';

            if ($first === 0 || $second === 0 || $third === 0 || $fourth === 0) {
                echo '<td></td>';
            } else {
                echo '<td>' . $average . '</td>';
            }

            if ($average === 0.0) {
                echo '<td></td>
                <td></td>';
            }else if($average < 74.0) {
                echo '<td></td>';
                echo '
                <td class="details">
                <div name="content">
                <button class="customButton" name="opener" onclick="">
                <div class="tooltip">
                <i class="fas fa-edit"></i>
                <span class="tooltiptext">View Details</span>
                </div>
                </button>
                <div name="dialog" title="Detail(s) of Failing Mark/ Non-conformance">
                <form action="parent-grades" method="POST">
                <center><span><font color="red" size="5">Incomplete Requirements</font><span></center>
                </form>
                </div>
                </div>
                </td>
                ';
            }else if($average >= 75.0){
                echo '<td><font color="green">Passed</font></td>';
                echo '<td></td>';
            }else if($first <= 74.0 || $second <= 74.0 || $third <= 74.0 || $fourth <= 74.0){
                echo '<td>' . $average . '</td>';
            }
            echo '</tr>';
        }
    }
    
    private function getGrade($acc_id, $subject, $grading)
    {
        $query = $this->conn->prepare("SELECT  CONCAT(first_name, ' ', last_name) 'Student', grade, subj_name 'subject', grading FROM grades JOIN student ON grades.studd_id = student.stud_id JOIN facsec fs ON grades.secd_id = fs.sec_idy JOIN schedsubj ss ON (grades.facd_id = ss.fw_id && grades.secd_id = ss.sw_id) JOIN subject ON (ss.schedsubjb_id = subject.subj_id && grades.subj_ide = subject.subj_id) JOIN accounts ac ON student.accc_id = ac.acc_id WHERE ac.acc_id = :acc_id AND subj_name = :subject AND grading = :grading GROUP BY 2 ORDER BY 3");
        $query->execute(array(
            ':acc_id' => $acc_id,
            ':subject' => $subject,
            ':grading' => $grading
        ));
        $result = $query->fetch();
        return $query->rowCount() > 0 ? $result['grade'] : 0;
    }

public function getCV($id)
{
    $query = $this->conn->prepare("select cv_name from corevalues");
    $query->execute();
    $cv_name = $query->fetchAll();
    $acc_id  = $id;
        for ($c = 0; $c < count($cv_name); $c++) {
            $cvname = $cv_name[$c]['cv_name'];
            $first        = $this->getCVGrade($acc_id, $cvname, '1st');
            $second       = $this->getCVGrade($acc_id, $cvname, '2nd');
            $third        = $this->getCVGrade($acc_id, $cvname, '3rd');
            $fourth       = $this->getCVGrade($acc_id, $cvname, '4th');

            echo '<tr>';
            echo '<td style="font-weight: 700;">' . $cvname . '</td>';
            echo $first === 0 ? '<td></td>' : '<td>' . $first . '</td>';
            echo $second === 0 ? '<td></td>' : '<td>' . $second . '</td>';
            echo $third === 0 ? '<td></td>' : '<td>' . $third . '</td>';
            echo $fourth === 0 ? '<td></td>' : '<td>' . $fourth . '</td>';
                  echo '</tr>';
        }
    }
    
    private function getCVGrade($acc_id, $cvname, $bhv_grading)
    {
        $query = $this->conn->prepare("SELECT 
    bhv_remarks, corevalues.cv_name, bhv_grading, behavior.idcorevalues
FROM
    behavior
        JOIN
    student ON behavior.stud_idy = student.stud_id
        JOIN
    corevalues ON behavior.idcorevalues = corevalues.idcorevalues
    join accounts ac on ac.acc_id = student.accc_id
 WHERE ac.acc_id = :acc_id AND corevalues.cv_name = :cvname AND bhv_grading = :bhv_grading GROUP BY 1 ORDER BY 3");
        $query->execute(array(
            ':acc_id' => $acc_id,
            ':cvname' => $cvname,
            ':bhv_grading' => $bhv_grading
        ));
        $result = $query->fetch();
        return $query->rowCount() > 0 ? $result['bhv_remarks'] : 0;
    }

    public function getSchedule($accid) {
        $querySchedule = $this->conn->prepare("SELECT 
            '09:40:00' AS 'time_start',
            '10:00:00' AS 'time_end',
            'RECESS' AS subj_name,
            '' AS 'stud_sec',
            '' AS 'facultyname'

            UNION SELECT 
            '12:00:00' AS 'time_start',
            '13:00:00' AS 'time_end',
            'LUNCH' AS subj_name,
            '' AS 'stud_sec',
            '' AS 'facultyname'

            UNION SELECT 
            time_start,
            time_end,
            subj_name,
            CONCAT('G', year_level, ' - ', sec_name) AS 'stud_sec',
            CONCAT(fac_fname,
            ' ',
            fac_midname,
            ' ',
            fac_lname) AS 'facultyname'
            FROM
            schedsubj ss
            JOIN
            subject ON ss.schedsubjb_id = subject.subj_id
            JOIN
            facsec fs ON (fs.fac_idy = ss.fw_id
            && fs.sec_idy = ss.sw_id)
            JOIN
            faculty ON fac_idy = fac_id
            JOIN
            section ON fs.sec_idy = section.sec_id
            JOIN
            student ON secc_id = sec_id
            JOIN
            accounts ON acc_idz = acc_id
            WHERE
            sec_id = (SELECT 
            sec_id
            FROM
            section
            JOIN
            student ON section.sec_id = student.secc_id
            JOIN
            schedsubj ss ON ss.sw_id = student.secc_id
            JOIN
            subject ON subject.subj_id = ss.schedsubjb_id
            JOIN
            accounts ON accounts.acc_id = student.accc_id
            WHERE
            acc_id = '3'
            GROUP BY 1)
            GROUP BY time_start
            order by 1") or die ("FAILED");
        $querySchedule->bindParam(1, $_SESSION['accid']);
        $querySchedule->execute();
        $result = $querySchedule->fetchAll();
        $time_start = array('07:40:00', '08:40:00', '09:40:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00');
        $time_end = array('08:40:00', '09:40:00', '10:00:00', '11:00:00', '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00');


        for ($c = 0; $c < count($time_start); $c++) {
            echo '<tr>';
            $subj_name = '';
            $faculty = isset($result[$c]['facultyname']) ? ($result[$c]['facultyname']) : '';
            $new_time_start = date('h:i A', strtotime($time_start[$c]));
            $new_time_end = date('h:i A', strtotime($time_end[$c]));
            foreach($result as $row) {
                if ($time_start[$c] == $row['time_start']) {
                    $subj_name = $row['subj_name'];
                }
            }
            echo '<td>'.$new_time_start.' - '.$new_time_end.'</td>';
            echo '<td colspan="5">'.($subj_name  !== '' ? '<div>'.$subj_name.'<br>'.$faculty.'</div>' : 'Vacant').'</td>';
            echo '</tr>';
        }
        
    }
    /****************************STUDENT INFORMATION*******************************/
    public function studGeneralInfo(){
        $query = $this->conn->prepare("SELECT 
            gender,
            CONCAT(MONTHNAME(stud_bday),
            ' ',
            DAY(stud_bday)) AS 'Birthday',
            stud_address,
            Ethnicity,
            nationality,
            blood_type,
            medical_stat
            FROM
            accounts
            JOIN
            student ON acc_id = accc_id
            JOIN
            guardian g ON student.guar_id = g.guar_id
            WHERE
            accounts.acc_id =?");
        
        $query->bindParam(1, $_SESSION['accid']);
        $query->execute();
        $getRowCount = $query->rowCount();
        if ($getRowCount > 0) {
            while($row = $query->fetch()) {
                echo '
                <div class="continue">
                <form>
                <label for="sexfield"><span>Gender:</span><input type="text" name="" value="'.$row[0].'"disabled></label>
                <label for="birthday"><span>Birthday:</span><input type="text" name="" value="'.$row['Birthday'].'" disabled></label>
                <label for="religion"><span>Ethnicity:</span><input type="text" name="" value="'.$row['Ethnicity'].'" disabled></label>
                <label for="nationality"><span>Nationality:</span><input type="text" name="" value="'.$row['nationality'].'" disabled></label>
                <label for="nationality"><span>Blood Type:</span><input type="text" name="" value="'.$row['blood_type'].'" disabled></label>
                <label for="nationality"><span>Medication</span><input type="text" name="" value="'.$row['medical_stat'].'" disabled></label>
                </form>
                </div>
                ';
            }
        } else {
            echo '
            <div class="continue">
            <form>             
            <label for="birthday"><span>Birthday:</span><input type="text" name="" value="" disabled></label>
            <label for="religion"><span>Religion:</span><input type="text" name="" value="" disabled></label>
            <label for="nationality"><span>Nationality:</span><input type="text" name="" value="" disabled></label>
            <label for="nationality"><span>Blood Type:</span><input type="text" name="" value="" disabled></label>
            <label for="nationality"><span>Medication</span><input type="text" name="" value="" disabled></label>
            </form>
            </div>
            ';
        }
    }

    public function studContactInfo() { 
        $query = $this->conn->prepare("SELECT 
            stud_address,
            CONCAT(g.guar_fname,
            ' ',
            g.guar_midname,
            ' ',
            g.guar_lname) AS guardian,
            g.guar_mobno,
            mother_name,
            father_name
            FROM
            accounts
            JOIN
            student ON acc_id = accc_id
            JOIN
            guardian g ON student.guar_id = g.guar_id
            WHERE
            accounts.acc_id =?");
        
        $query->bindParam(1, $_SESSION['accid']);
        $query->execute();
        $getRowCount = $query->rowCount();
        if ($getRowCount > 0) {
            while($row = $query->fetch()) {
                echo '
                <div class="continue">
                <form>
                <label for="address"><span>Address:</span><input type="text" name="" value="'.$row['stud_address'].'" disabled></label>
                <label for="fname"><span>Father Name:</span><input type="text" name="" value="'.$row['father_name'].'" disabled></label>
                <label for="mname"><span>Mother Name:</span><input type="text" name="" value="'.$row['mother_name'].'" disabled></label>
                <label for="guardian"><span>Guardian:</span><input type="text" name="" value="'.$row['guardian'].'" disabled></label>
                <label for="cpno"><span>Cellphone Number:</span><input type="text" name="" value="'.$row['guar_mobno'].'" disabled></label>
                </form>
                </div>    
                ';
            }
            } else { echo '
            <div class="continue">
            <form>
            <label for="address"><span>Address:</span><input type="text" name="" value="" disabled></label>
            <label for="fname"><span>Father Name:</span><input type="text" name="" value="" disabled></labelf>
            <label for="mname"><span>Mother Name:</span><input type="text" name="" value="" disabled></label>
            <label for="guardian"><span>Guardian:</span><input type="text" name="" value="" disabled></label>
            <label for="telno"><span>Telephone Number:</span><input type="text" name="" value="" disabled></label>
            <label for="cpno"><span>Cellphone Number:</span><input type="text" name="" value="" disabled></label>
            </form>
            </div>
            ';
        }

    }

    public function getName() { 
        $query = $this->conn->prepare("SELECT concat(first_name,' ', left(middle_name, 1), '.', ' ', last_name) as Name from accounts join student on acc_id = accc_id where accounts.acc_id=?");
        
        $query->bindParam(1, $_SESSION['accid']);
        $query->execute();
        $getRowCount = $query->rowCount();
        if ($getRowCount > 0) {
            while($row = $query->fetch()) {
                echo ' '.$row['Name'].' ';
            }

        }
    }

    public function getAccountInfo() { 
        $query = $this->conn->prepare("SELECT username, concat(first_name, ' ', left(middle_name,1), '.', ' ', last_name) as Name, year_in from accounts join student on acc_id = accc_id where accounts.acc_id=?");
        $query->bindParam(1, $_SESSION['accid']);
        $query->execute();
        $getRowCount = $query->rowCount();
        if ($getRowCount > 0) {
            while($row = $query->fetch()) {
                echo ' <div class="continue">
                <form>             
                <label for="username"><span>Username:</span><input type="text" name="" value="'.$row['username'].'"disabled></label> 
                <label for="accountName"><span>Account Name:</span><input type="text" name="" value="'.$row['Name'].'" disabled></label>
                <label for="dateRegistered"><span>Year entered:</span><input type="text" name="" value="'.$row['year_in'].'" disabled></label>
                </form>
                </div> ';
            }

        }
    }

    public function changePassword($currentPass, $newPass, $retypePass){ 
        $query = $this->conn->prepare("select password from accounts where acc_id = ?");
        $userid = $_SESSION['accid'];
        $query->bindParam(1, $userid);
        $query->execute(); 
        $row = $query->fetch();
        if(password_verify($currentPass, $row['password']) and ($newPass == $retypePass) and ($currentPass!=$newPass)){
            $queryUpdate = $this->conn->prepare("UPDATE accounts SET password =? WHERE acc_id=?");
            $newPassword = password_hash($newPass, PASSWORD_DEFAULT);
            $queryUpdate->bindParam(1, $newPassword);
            $queryUpdate->bindParam(2, $userid);
            $queryUpdate->execute();

            if($queryUpdate){
                echo "<script type='text/javascript'>alert('Password has been changed successfully!');</script>";
            }else{
                echo "<script type='text/javascript'>alert('Change password failed');</script>";
            }
        }else{
            echo "<script type='text/javascript'>alert('Change password failed');</script>";
        }
    }

}




?>