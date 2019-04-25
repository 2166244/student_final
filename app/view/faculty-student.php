	<?php require 'app/model/faculty-funct.php'; $getFactFunct = new FacultyFunct(); ?>
	<div class="contentpage">
		<div class="row">	
			<div class="widget">	
				<div class="header">	
					<p>	<i class="fas fa-user-plus fnt"></i><span>Student List</span></p>
					<p>School Year: 2019-2020</p>
				</div>	
				<div class="studentContent widgetcontent">
					<div class="tabs">
						<ul>
							<li><a href="#section1">Advisory Class</a></li>
							<li><a href="#section2">Request for transfer</a></li>
						</ul>
						<!-- <div id="section1">
							<div class ="cont">
								<span>Year Level:</span>
								<select class="filtStudTable">
									<option value="All">All</option>
									<option value="Grade 7">Grade 7</option>
									<option value="Grade 8">Grade 8</option>
									<option value="Grade 9">Grade 9</option>
									<option value="Grade 10">Grade 10</option>
								</select>
							</div>
							<div class="result"></div>
							<div class="clearfix"></div>
							<div class="cont3">
								<div class="table-scroll">	
									<div class="table-wrap">
										<table id="stud-list">
											<thead>
												<tr>
													<th>LRN(Learner Reference No.)</i></th>
													<th>Name</i></th>
													<th>Section</i></th>
													<th class="no-sort">Assessment</i></th>
												</tr>
											</thead>
											<tbody>
												<?php /*$getFactFunct->studList();*/ ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div> -->
						<div id="section1">
							<div class ="cont">
								<span>SECTION:</span>
								<p><?php $getFactFunct->getAdvSection($_SESSION['accid']); ?></p>
							</div>
							<div class="clearfix"></div>
							<div class="container">
								<div class="cont5">
									<div class="table-scroll">	
										<div class="table-wrap">
											<table id="adv-table-1">
												<thead>
													<tr>
														<th>LRN(Learner Refence No.)</i></th>
														<th>Name</i></th>
														<th>COLUMN NAME</i></th>
													</tr>
												</thead>
												<tbody>
													<?php $getFactFunct->showAdvStudent($_SESSION['accid']); ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
