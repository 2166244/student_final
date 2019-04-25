	<?php require 'app/model/faculty-funct.php'; $getFactFunct = new FacultyFunct(); ?>
	<?php
		if(isset($_POST['file_upload'])) {
			$_POST['acc_id'] = $_SESSION['accid']; 
			$getFactFunct->postAnnc($_POST, $_FILES['file']);
		}
	?>
	<div class="contentpage">
		<div class="row">	
			<div class="widget">	
				<div class="header">	
					<p>	<i class="fas fa-user-plus fnt"></i><span>Student List</span></p>
					<p>School Year: 2019-2020</p>
				</div>	
				<div class="classesContent widgetcontent">
					<div class="tabs">
						<ul>
							<li><a href="#section1">Class List</a></li>
							<li><a href="#section2">Advisory Class List</a></li>
						</ul>
						<div id="section1">
							<div class="clearfix"></div>
							<div class="cont3">
								<div class="table-scroll">	
									<div class="table-wrap">
										<table>
											<tr>
												<th>TIME</th>
												<th>MONDAY</th>
												<th>TUESDAY</th>
												<th>WEDNESDAY</th>
												<th>THURSDAY</th>
												<th>FRIDAY</th>
											</tr>
											<tr>
												<td>7:40 - 8:40</td>
												<td><?php $getFactFunct->getSubj(); ?></td>
												<td><?php $getFactFunct->getSubj(); ?></td>
												<td><?php $getFactFunct->getSubj(); ?></td>
												<td><?php $getFactFunct->getSubj(); ?></td>
												<td><?php $getFactFunct->getSubj(); ?></td>	
											</tr>
											<tr>
												<td>8:40 - 9:40</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>	
											</tr>
											<tr>
												<td>9:40 - 10:00</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
											</tr>
											<tr>
												<td>10:00 - 11:00</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>	
											</tr>
											<tr>
												<td>11:00 - 12:00</td>
												<td><?php $getFactFunct->getSubjSection(); ?></td>
												<td><?php $getFactFunct->getSubjSection(); ?></td>
												<td><?php $getFactFunct->getSubjSection(); ?></td>
												<td><?php $getFactFunct->getSubjSection(); ?></td>
												<td><?php $getFactFunct->getSubjSection(); ?></td>
											</tr>
											<tr>
												<td>12:00 - 1:00</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
											</tr>
											<tr>
												<td>1:00 - 2:00</td>
												<td><?php $getFactFunct->getSubjectSection(); ?></td>
												<td><?php $getFactFunct->getSubjectSection(); ?></td>
												<td><?php $getFactFunct->getSubjectSection(); ?></td>
												<td><?php $getFactFunct->getSubjectSection(); ?></td>
												<td><?php $getFactFunct->getSubjectSection(); ?></td>
											</tr>
											<tr>
												<td>2:00 - 3:00</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>3:00 - 4:00</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											</tr>
										</table>
									</div>
								</div>
								<div class="cont4">
									<div name="dialog" title="Edit status for test" class="upload-file-dialog">
										<div class="container">
											<div class="modal-cont">
												<form action="faculty-classes" method="POST" enctype="multipart/form-data">
													<input type="text" name="title" placeholder="Post Title" required>
													<input type="text" name="post" placeholder="Post Description">
													<input type="file" name="file">
													<input type="submit" name="file_upload">
												</form>
											</div>
										</div>
									</div>
									<button type="button" name="opener" data-type="open-dialog">Post Announcements</button>
								</div>
							</div>
						</div>
						<div id="section2">
							<div class="clearfix"></div>
							<div class="container">
								<div class="cont5">
									<div class="table-scroll">	
										<div class="table-wrap">
											<table>
											<tr>
												<th>TIME</th>
												<th>MONDAY</th>
												<th>TUESDAY</th>
												<th>WEDNESDAY</th>
												<th>THURSDAY</th>
												<th>FRIDAY</th>
											</tr>
											<tr>
												<td>7:40 - 8:40</td>
												<td><?php $getFactFunct->getSubjectTeacher(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher(); ?></td>		
											</tr>
											<tr>
												<td>8:40 - 9:40</td>
												<td><?php $getFactFunct->getSubjectTeacher1(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher1(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher1(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher1(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher1(); ?></td>	
											</tr>
											<tr>
												<td>9:40 - 10:00</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
												<td>RECESS</td>
											</tr>
											<tr>
												<td>10:00 - 11:00</td>
												<td><?php $getFactFunct->getSubjectTeacher2(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher2(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher2(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher2(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher2(); ?></td>
											</tr>
											<tr>
												<td>11:00 - 12:00</td>
												<td><?php $getFactFunct->getSubjectTeacher3(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher3(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher3(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher3(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher3(); ?></td>
											</tr>
											<tr>
												<td>12:00 - 1:00</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
												<td>LUNCH</td>
											</tr>
											<tr>
												<td>1:00 - 2:00</td>
												<td><?php $getFactFunct->getSubjectTeacher4(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher4(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher4(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher4(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher4(); ?></td>	
											</tr>
											<tr>
												<td>2:00 - 3:00</td>
												<td><?php $getFactFunct->getSubjectTeacher5(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher5(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher5(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher5(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher5(); ?></td>
											</tr>
											<tr>
												<td>3:00 - 4:00</td>
												<td><?php $getFactFunct->getSubjectTeacher6(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher6(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher6(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher6(); ?></td>
												<td><?php $getFactFunct->getSubjectTeacher6(); ?></td>	
											</tr>
											</table>
										</div>
									</div>
									<div class="cont4">
										<div name="dialog" title="Edit status for test">
											<div class="container">
												<div class="modal-cont">
													<div>TEST</div>
												</div>
											</div>
										</div>
										<button type="button" name="opener" data-type="open-dialog">Post Announcements</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>