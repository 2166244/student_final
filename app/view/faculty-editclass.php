<?php require 'app/model/faculty-funct.php'; $getFactFunct = new FacultyFunct() ?>
<?php
	if(isset($_POST['submit-classes'])) {
		$getFactFunct->setSchedule($_POST);
	}
?>
<div class="contentpage">
	<div class="row">	
		<div class="widget">	
			<div class="header">	
				<p>	<i class="fas fa-user-plus fnt"></i><span> Edit Class</span></p>
				<p>School Year: 2019-2020</p>
			</div>	
			<div class="editContent widgetcontent">
				<form action="faculty-editclass" id="editClass-form" method="POST">
					<div class ="cont">
						<div class= "box1">
							<span>Grade Level & Section: </span>
							<select name="sec_id" id="getCurrentLevel">
								<?php $getFactFunct->showSections(); ?>
							</select>
						</div>
						<div class="box2">
							<span>Adviser: </span>
							<select name="fac_id">
								<?php $getFactFunct->showFaculties(); ?>
							</select>
						</div>
					</div>
					<div class="clearfix"></div>
					<div class="cont3">
						<div class="table-scroll">	
							<div class="table-wrap" id="classes-sched-cont">
								<table id="classes-sched">
									<?php
										$subj_lvl = isset($_SESSION['subj_lvl']) ? $_SESSION['subj_lvl'] : '7';
									?>
									<tr>
										<th>TIME</th>
										<th>MONDAY</th>
										<th>TUESDAY</th>
										<th>WEDNESDAY</th>
										<th>THURSDAY</th>
										<th>FRIDAY</th>
									</tr>
									<tr id="1st-subj">
										<td>7:40 - 8:40</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr id="2nd-subj">
										<td>8:40 - 9:40</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr id="reccess">
										<td>9:40 - 10:00</td>
										<td colspan="5">RECESS</td>
									</tr>
									<tr id="3rd-subj">
										<td>10:00 - 11:00</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr id="4th-subj">
										<td>11:00 - 12:00</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr>
										<td>12:00 - 1:00</td>
										<td colspan="5">LUNCH</td>
									</tr>
									<tr id="5th-subj">
										<td>1:00 - 2:00</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr id="6th-subj">
										<td>2:00 - 3:00</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" >Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
									<tr id="7th-subj">
										<td>3:00 - 4:00</td>
										<td colspan="5" class="row-subj">
											<div class="select-grp">
												<select name="sched[]" class="editclass-subjects" data-checker="subjects">
													<?php $getFactFunct->getSubjects($subj_lvl); ?>
												</select>
												<select name="subj[]" class="editclass-teacher" data-checker="subjects">
													<option value="" disabled selected>Select a subject first to display data</option>
												</select>
											</div>
										</td>
									</tr>
								</table>
								<?php
									if(isset($_SESSION['subj_lvl'])) unset($_SESSION['subj_lvl']);
								?>
							</div>
						</div>
						<div class="cont4">
							<input type="hidden" name="submit-classes" value="ok">
							<button>Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>