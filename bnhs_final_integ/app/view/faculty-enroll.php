	<?php require 'app/model/faculty-funct.php'; $getFactFunct = new FacultyFunct(); ?>
	<?php
		if (isset($_POST['submit-bttn'])) {
			$getFactFunct->enrollNewStudent($_POST);	
		} else if (isset($_POST['change-stud-status'])) {
			$getFactFunct->updateStudentDetails($_POST);
		}
	?>
	<div class="contentpage">
		<div class="row">
			<div class="widget">	
				<div class="header">	
					<p>	<i class="fas fa-user-plus fnt"></i><span>Enroll Student</span></p>
					<p>School Year: <?php $nextYear = date('Y') + 1; echo date('Y').' - '.$nextYear; ?></p>
				</div>	
				<div class="enrollcontent widgetcontent">
					<div class="tabs">
						<ul>
							<li><a href="#section1">Enroll old student</a></li>
							<li><a href="#section2">Enroll new student</a></li>
						</ul>
						<div id="section1">
							<div class="clearfix"></div>
							<div class="cont3">
								<div class="table-scroll">
									<label>Grade Level: </label>
									<select id="filter-stud-list">
										<option value="">All</option>
										<option value="7">Grade 7</option>
										<option value="8">Grade 8</option>
										<option value="9">Grade 9</option>
										<option value="10">Grade 10</option>
									</select>
									<div class="table-wrap">
										<table id="old-student">
											<thead>
											<tr>
												<th>LRN(Learner Reference No.)</th>
												<th>Name</th>
												<th>Status</th>
												<th>Options</th>
												<th>Grade Level</th>
											</tr>
											</thead>	
											<tbody>
												<?php $getFactFunct->oldStud(); ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div id="section2">
							<div class="clearfix"></div>
							<div class="container">
								<form action="faculty-enroll" class="enrollment-form" id="student-enrollment-form" method="POST">
									<div class="form-row">
										<p>All with <span class="required">*</span> are required, kindly fill it in.</p>
										<div class="hd">
											<h3>STUDENT INFORMATION</h3>
										</div>
										<label>
											<span>LEARNER REFERENCE No. (LRN):<span class="required">&nbsp;*</span></span>
											<input type="text" name="stud_lrno" data-validation="length" data-validation="number" data-validation-length="13" data-validation-error-msg="Your input is an invalid LRN Number" required>
										</label>
										<label>
											<span>LAST NAME:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="last_name" required>
										</label>
										<label>
											<span>FIRST NAME:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="first_name" required>
										</label>
										<label>
											<span>MIDDLE NAME:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="middle_name" required>
										</label>
										<div class="date-sex">
											<label>
												<span>DATE OF BIRTH:<span class="required">&nbsp;*</span> </span>
												<input type="text" class="datepicker" name="stud_bday" required>
											</label>
											<label>
												<span>SEX:<span class="required">&nbsp;*</span> </span>
												<span><input type="radio" name="gender" value="Male" required/>MALE&nbsp;&nbsp;<input type="radio" name="gender" value="Female"/>FEMALE</span>
											</label>
										</div>
										<label>
											<span>GRADE LEVEL:<span class="required">&nbsp;*</span> </span>
											<select name="year_level">
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
												<option value="10">10</option>
											</select>
										</label>
										<label>
											<span>BLOOD TYPE:<span class="required">&nbsp;*</span> </span>
											<select name="blood_type">
												<option value="O">O</option>
												<option value="A">A</option>
												<option value="B">B</option>
												<option value="AB">AB</option>
											</select>
										</label>
										<label>
											<span>NATIONALITY:<span class="required">&nbsp;*</span></span>
											<input type="text" name="nationality" required>
										</label>
										<label>
											<span>ETHNICITY:<span class="required">&nbsp;*</span></span>
											<input type="text" name="ethnicity" required>
										</label>
										<label>
											<span>MEDICAL STATUS:</span>
											<input type="text" name="medical_stat">
										</label>
									</div>
									<div class="form-row">
										<div class="hd">
											<h3>ADDRESS INFORMATION</h3>
										</div>
										<label>
											<span>HOUSE NUMBER AND STREET:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="address" required>
										</label>
										<label>
											<span>BARANGAY<span class="required">&nbsp;*</span> </span>
											<input type="text" name="barangay" required>
										</label>
										<label>
											<span>CITY:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="city" required>
										</label>
										<label>
											<span>ZIP CODE:<span class="required">&nbsp;*</span> </span>
											<input type="text" name="zipcode" required>
										</label>
									</div>
									<div id="auto-fill">
										<div class="form-row par-guar">
											<?php $get_info = isset($_SESSION['full_stud_guar_info']) ? $_SESSION['full_stud_guar_info'] : ''; $info = is_array($get_info) ? $get_info[0] : ''; ?>
											<div class="hd">
												<h3>PARENT'S AND GUARDIAN'S INFORMATION</h3>
											</div>
											<div class="parents-info">
												<p class="note"><span class="required">Note:</span> For parents/guardians with two (2) or more children and has one (1) child enrolled kindly click <span class="required">"Existing"</span> button.</p>
												<label>
													<span>FATHER'S NAME:</span>
													<div class="par-inp">
														<?php if(!is_array($info)) { ?>
															<input type="text" name="fathername_first" placeholder="First Name">	
															<input type="text" name="fathername_middle_name" placeholder="Middle Initial">
															<input type="text" name="fathername_last" placeholder="Last Name">	
														<?php } else { ?>
															<input type="text" name="father_name" placeholder="<?php echo $info['father_name'] != null ? $info['father_name'] : 'There are no information'; ?>" class="w-100" disabled="true">
														<?php } ?>
													</div>
												</label>
												<label>
													<span>MOTHER'S NAME:</span>
													<div class="par-inp">
														<?php if(!is_array($info)) { ?>
															<input type="text" name="mothername_first" placeholder="First Name">	
															<input type="text" name="mothername_middle_name" placeholder="Middle Initial">
															<input type="text" name="mothername_last" placeholder="Last Name">	
														<?php } else { ?>
															<input type="text" name="mother_name" placeholder="<?php echo $info['mother_name'] != null ? $info['mother_name'] : 'There are no information'; ?>" class="w-100" disabled="true">
														<?php } ?>
													</div>
												</label>
												<label>
													<span>GUARDIAN'S NAME:<span class="required">&nbsp;*</span> </span>
													<div class="par-inp">
														<?php if(!is_array($info)) { ?>
															<input type="text" name="guar_first" placeholder="First Name">	
															<input type="text" name="guar_middle_name" placeholder="Middle Initial">	
															<input type="text" name="guar_last" placeholder="Last Name">	
														<?php } else { ?>
															<input type="text" name="guar_first" placeholder="<?php echo $info['guar_fname'] ?>" disabled>	
															<input type="text" name="guar_middle_name" placeholder="<?php echo $info['guar_midname'] ?>" disabled>	
															<input type="text" name="guar_last" placeholder="<?php echo $info['guar_lname'] ?>" disabled>	
														<?php } ?>
													</div>
												</label>
											</div>
											<label>
												<span>GUARDIAN'S TELEPHONE NUMBER: </span>
												<?php if(!is_array($info)) { ?>
													<input type="text" name="guar_telno" placeholder="">
												<?php } else { ?>
													<input type="text" name="guar_telno" placeholder="<?php echo (is_null($info['guar_telno']) || ($info['guar_telno'] == '') ? 'There are no information' : $info['guar_telno'] ); ?>" disabled>
												<?php } ?>
											</label>
											<label>
												<span>GUARDIAN'S CELLPHONE NUMBER:<span class="required">&nbsp;*</span> </span>
												<?php if(!is_array($info)) { ?>
													<input type="text" name="guar_mobno" data-validation="length" data-validation="number" data-validation-length="11" data-validation-error-msg="It is not a valid cellphone number" required>
												<?php } else { ?>
													<input type="text" name="guar_mobno" placeholder="<?php echo $info['guar_mobno']; ?>" disabled>
												<?php } ?>
											</label>
											<?php if(is_array($info)) { echo '<input type="hidden" name="guar_id" value="'.$info['guar_id'].'">'; } ?>
										</div>
										<?php if(isset($_SESSION['full_stud_guar_info'])) unset($_SESSION['full_stud_guar_info']); ?>
									</div>
									<div class="existing-guardian">
										<div class="fill-out-form">
											<div name="dialog" title="Select the guardian of the child">
												<div class="container">
													<div class="modal-cont">
														<label>Guardian's Name: </label>
														<select id="existing-guardian-autofill">
															<?php $getFactFunct->getGuardians(); ?>
														</select>
														<button id="existing-guardian-autofill-submit">Submit</button>
													</div>
												</div>
											</div>
											<button type="button" name="opener" class="edit-status" data-type="open-dialog">Existing</button>
										</div>
									</div>
									<div class="form-row requirements">
										<div class="hd">
											<h3>
												OTHER INFORMATION
											</h3>
										</div>
										<label>
											<span>STATUS:<span class="required">&nbsp;*</span> </span>
											<select name="stud_status">
												<option value="Officially Enrolled">Officially Enrolled</option>
												<option value="Temporarily Enrolled">Temporarily Enrolled</option>
											</select>
										</label>
									</div>
									<div class="save">
										<button name="submit-bttn" >Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
