<?php require 'app/model/student-funct.php'; $run = new studentFunct ?>
<div class="contentpage">
	<div class="row">
		<div id="widget">
			<div class="header">
				<p>	
					<i class="fas fa-user fnt"></i>
					<span>Class Schedule</span>
					<span class="fr">Grade 10 - Freedom </span>
				</p>			
			</div>
			<div class="widgetcontent">
				<table id="sched">
					<tr>
						<td>Time/Day</td>
						<td>Monday</td>
						<td>Tuesday</td> 
						<td>Wednesday</td>
						<td>Thursday</td>
						<td>Friday</td>
					</tr>
					<?php $run->getSchedule($_SESSION['accid']); ?>
				</table>
			</div>
		</div>
	</div>
</div>
</div>