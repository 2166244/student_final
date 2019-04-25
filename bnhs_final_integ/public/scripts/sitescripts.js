/** 
 * SITE FUNCTIONALITIES
 *
 * IT CONTAINS THE USAGE OF API'S AND 
 */

replacePageTitle();
/****************************************** START OF FRONT-END FUNCTIONALITIES USING JQUERY (CALLED WITHOUT WAITING FOR THE PAGE TO FULLY LOAD) ******************************************/
/****************************************** START OF API(s) ******************************************/
/*Jquery UI Tabs*/
$( ".enrollcontent .tabs" ).tabs({ active: 1 });
$( ".tabs, .studentContent .tabs, .studentContent .tabs, .classesContent .tabs" ).tabs();

/*Datatable API*/
$( "#stud-list, #adv-table-1, #adv-table-2, #stud-attendance-table, #student-payment-history").DataTable({
	dom: "lfrtip",
	"lengthMenu": [[5, 10, 25], [5, 10, 25]]
});

var studlist = $('#old-student').DataTable({
	"columnDefs" : [{
		"targets": [4],
		"visible": false,
	}]
});

$('.faculty-enroll-page #filter-stud-list').on('change', function() {
	var val = $(this).val();
	studlist.column(4).search( val ? val : '', true, false ).draw();
});

/*FullCalendar API*/
var calendar = $('#calendar').fullCalendar({
	header:{
		left:'prev,next today',
		center:'title',
		right:'month,agendaWeek,agendaDay'
	},
	events: 'app/model/unstructured/load.php',
	selectHelper:true,
	height: 500
});

/*jQuery Form Validator API*/
$.validate();

/****************************************** END OF API(s) ******************************************/

/*Dropdown menu, specifically for the profile dropdown*/
$( ".dropdown-menu .dropdown-btn" ).click(function(e) {
	e.stopPropagation();
	$(".dropdown-menu-content").fadeToggle();
});

$( "html" ).click(function(e) {
	e.stopPropagation();
	var container = $(".dropdown-menu-content");

	//check if the clicked area is dropDown or not
	if (container.has(e.target).length === 0) {
		$('.dropdown-menu-content').fadeOut();
	}
});

/*Custom Sidebar using pure jQuery*/
$('.menu-sidebar .menu nav ul li a[href^=" "]').click(function(event) {
	event.preventDefault();
	var oldSubMenu = "#" + $('.menu-sidebar .menu nav ul li ul.active-submenu').attr('id');
	var submenuID = "#" + $(this).attr("target");
	if (!($('.menu-sidebar .menu nav ul li').hasClass('active')) || $(submenuID).parent('li').hasClass('active')) {
		$(submenuID).parent('li').toggleClass('active');
		$(submenuID).slideToggle();
	} else {
		$('.menu-sidebar .menu nav ul li.active ul').slideUp();
		$('.menu-sidebar .menu nav ul li.active').removeClass('active');
		$(submenuID).parent('li').addClass('active');
		$(submenuID).slideDown();
	}
});

if ($('.menu-sidebar .menu nav ul li ul li').hasClass('active-menu')) {
	$('.menu-sidebar .menu nav ul li').has('li.active-menu').addClass('active');
	$('.menu-sidebar .menu nav ul li.active ul').show();
}

var ifColAct = localStorage.getItem('collapse-menu');

$('#collapse-menu').click(function() {
	$('div.menu-top').toggleClass('top-compress');
	$('div.menu-sidebar').toggleClass('sidebar-compress');
	$('div.content-container').toggleClass('content-compress');
	ifColAct === null ? localStorage.setItem('collapse-menu', 'active') : localStorage.removeItem('collapse-menu');
});

if (ifColAct === 'active') {
	$('div.menu-top').addClass('top-compress');
	$('div.menu-sidebar').addClass('sidebar-compress');
	$('div.content-container').addClass('content-compress');
}

$('.menu nav > ul > li').each(function() {
	var newDiv = '<span class="menu-title">' + $(this).children('a').text() + '</span>';
	$(this).children('a').append(newDiv);
});

$('.sidebar-submenu li').each(function() {
	var newDiv = '<span class="menu-title">' + $(this).children('a').text() + '</span>';
	$(this).children('a').append(newDiv);
});

$( ".datepicker" ).datepicker({
	changeMonth: true,
	changeYear: true,
	yearRange: "-25:+0",
	dateFormat: 'yy-mm-dd'
});

$('[name=opener]').each(function () {
  var panel = $(this).siblings('[name=dialog]');
  $(this).click(function () {
      panel.dialog('open');
      $('.ui-widget-overlay').addClass('custom-overlay');
  });
});
$('[name=dialog]').dialog({
  autoOpen: false,
  modal: true,
  draggable: false,
  height: 'auto',
  width: 'auto'
});

$('#existing-guardian-autofill-submit').on('click', function() {
	var data = new Array('filloutform', 'guar_id=' + $(this).siblings('#existing-guardian-autofill').val());

	$.ajax({
		type: 'POST',
		url: 'app/model/faculty-exts/faculty-ajax.php',
		data: {data:data},
		success: function(result) {
			$('[name=dialog]').dialog('close');
			$('#auto-fill').load('faculty-enroll #auto-fill .form-row');
		}
	});
});

/*Add page title using the active-menu*/
function replacePageTitle() {
	$('title').empty();
	$('title').append($( '.menu nav ul li.active-menu' ).text());
}

function loadUnseen() {

}
/****************************************** END OF FRONT-END FUNCTIONALITIES USING JQUERY (CALLED WITHOUT WAITING FOR THE PAGE TO FULLY LOAD) ******************************************/

/****************************************** START OF FRONT-END FUNCTIONALITIES USING JQUERY ******************************************/
$( document ).ready(function() {
	$( ".se-pre-con" ).fadeOut("slow");

	$('.faculty-assess-page').on('click', '#print-this', function() {
		$('.faculty-assess-page .print-container').printThis({
			importCSS: true,
			importStyle: true,
		});
	});

	$('.faculty-editclass-page #faculty_home .cont').on('change', 'select#getCurrentLevel', function() {
		var data = new Array('setLevel', 'subj_lvl=' + $(this).val());

		$.ajax({
			type: 'POST',
			url: 'app/model/faculty-exts/faculty-ajax.php',
			data: {data:data},
			success: function(result) {
				$('#classes-sched').load('faculty-editclass #classes-sched');
			}
		});
	});

	$('#classes-sched').on('change', 'select.editclass-subjects', function() {
		var data = new Array('setSubj', 'subj_id=' + $(this).val());
		if ($(this).val() == '') {
			$(this).siblings('.editclass-teacher').empty();
			$(this).siblings('.editclass-teacher').append('<option value="" disabled selected>Select a subject first to display data</option>');
		} else {
			$.ajax({
				context: this,
				type: 'POST',
				url: 'app/model/faculty-exts/faculty-ajax.php',
				data: {data:data},
				success: function(result) {
					$(this).siblings('.editclass-teacher').empty();
					$(this).siblings('.editclass-teacher').append(result);
				}
			});
		}
		
	});

	var selects = function() {
		var array = [];
		$('#editClass-form select.editclass-subjects').each(function() {
			array.push($(this).val());
		});
		return jQuery.unique( array ).length == 7 ? true : false;
	}

	$('#editClass-form').on('click', 'button', function(e) {
		e.preventDefault();
		var exists = false;
		$('#editClass-form select.editclass-subjects').each(function(){
			if($(this).val() == '') {
				exists = true;
			}
		});
		if (exists == false && selects() == true) {
			$('#editClass-form').submit();
		} else {
			alert('Please choose a subject for each schedule or a subject has been choosen twice.');
		}
	});

	$('.student-accounts-page #filter-year').on('change', function() {
		var data = 'year=' + $(this).val();

		$.ajax({
			type: 'POST',
			url: 'app/model/unstructured/student-year-payment.php',
			data: data,
			success: function(result) {
				$('#filter-year-stud').load('student-accounts #student-payment-history');
			}
		});
	});
});
/****************************************** END OF FRONT-END FUNCTIONALITIES USING JQUERY ******************************************/
