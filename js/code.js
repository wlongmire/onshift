(function($, window, document, undefined){
	$('html').addClass('js');

//***************DATA****************//
	this.department_data = {
		Anesthesiology: [{
			index:0,
			firstName:"Doctor",
			lastName:"Anesthetics",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		}],


		Cardiology: [],

		Gynaecology: [{
			index:1,
			firstName:"Sudarsahn",
			lastName:"Muralidhar",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		}],


		Neurology: [{
			index:2,
			firstName:"Megaman",
			lastName:"X",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		},{
			index:3,
			firstName:"Mahatma",
			lastName:"Gandhi",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		}],

		Oncology: [],

		Orthopedics: [{
			index:4,
			firstName:"George",
			lastName:"Washington",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		}],

		Pediatrics: [{
			index:5,
			firstName:"Hamidhasan",
			lastName:" Ahmed",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"5pm",
			offTime:"1am"

			},{

			index:6,
			firstName:"Benjamin",
			lastName:"Franklin",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"5pm",
			offTime:"1am"
		}],

		Pharmacology: [{
			index:7,
			firstName:"Faiyaz",
			lastName:"Ahmed",
			thumbnail:"http://www.vectorstock.com/i/composite/38,41/doctor-vector-583841.jpg",
			onTime:"3pm",
			offTime:"11pm"
		}]
	};

	var get_doctor_list = function(data) {
		var docs = [];

		$.each(data, function(department, obj) {
			$.each(obj, function(i, obj){obj.department = department});
			docs = docs.concat(obj);
		});

		return(docs);
	}


	var get_doctor = function (data, index) {
		return(get_doctor_list(data)[index]);
	}

	this.onShift = {
		generatePageContainer:function(pageName) {
			var elm = $('<div data-role="page" id="' + pageName + '"></div>');
			return(elm);
		},

		generateHeader:function(pageTitle) {
			var elm = $('<div data-theme="a" data-role="header"></div>')
				.append('<h3><span id="logo"></span><span id="title">OnShift<span></h3>');

			var docListActive = (pageTitle === "doctorListPage")?"ui-btn-active ui-state-persist":"";
			var departmentActive = (pageTitle === "departmentPage")?"ui-btn-active ui-state-persist":"";

			var navBar = $('<div class="navbar" data-role="navbar" data-iconpos="top"></div>')
				.append('<ul><li><a href="#departmentPage" data-transition="fade" class = "' + departmentActive + '" data-theme="a" data-icon="">Departments</a></li><li><a href="#doctorListPage" data-transition="fade" data-theme="" data-icon="" class="' + docListActive + '">Doctors</a></li><li><a href="#loginPage" data-transition="fade" data-theme="" data-icon="">Logout</a></li></ul>');

			elm.append(navBar);
			
			return(elm);
		},

		generateDoctorItem:function(obj) {
			var doctor_set = $('<div>');
			if (obj[0]) {
				$.each(obj, function(i, obj){
					var doctor = $('<ul class="doctor_elem" data-role="listview" data-divider-theme="b" data-inset="true">')
					.append('<li data-role="list-divider" role="heading">' + obj.lastName + ', ' + obj.firstName + '</li>')
					.append('<li data-theme="c" class="time_heading"><a href="#" data-docIndex= ' + obj.index + '  data-transition="slide">' + obj.onTime + '-' + obj.offTime + '</a></li>');
		    		doctor_set.append(doctor);
				});
			} else {
				doctor_set.append("<h1>No doctors on staff for this time.</h1>")
			}
			return(doctor_set);
		},

		generateDoctorListPage:function() {
			var self = this,
				pageName = "doctorListPage",
				content = $("<div>"),
				docs = get_doctor_list(self.data);

			$.each(docs, function(i, obj) {
				var doctor = $('<ul class="doctor_elem" data-role="listview" data-divider-theme="b" data-inset="true">')
					.append('<li data-role="list-divider" role="heading">' + obj.lastName + ',' + obj.firstName + '</li>')
					.append('<li data-theme="c" class="time_heading"><a href="#" data-docIndex= ' + obj.index + ' rel="external" data-transition="slide">' + obj.department + '</span><br/>' + obj.onTime + '-' + obj.offTime + "</a></li>");
				content.append(doctor);
			});


			var rawHTML = $(self.generatePageContainer(pageName))
				.append(self.generateHeader(pageName))
				.append(content);

			var page = rawHTML.appendTo('body').page();

			return(page);
		},

		generateDepartmentPage:function() {
			var self = this,
				pageName = "departmentPage",
				content = $("<div>");

			$.each(self.data, function(i, obj) {
				var department = $('<div data-role="collapsible" data-collapsed="true data-theme="a"></div>');
				department.append('<h3>' + i + '</h3>');
				department.append(self.generateDoctorItem(obj));
				content.append(department);
			});

			var rawHTML = $(self.generatePageContainer(pageName))
				.append(self.generateHeader(pageName))
				.append(content);

			var page = rawHTML.appendTo('body').page();

			return(page);
		},

		generateDoctorPage:function(index) {
			var self = this,
				pageName = "doctorPage",
				obj = get_doctor(self.data, index);

			var content = $('<div id="doctor_container">')
					.append('<h2 class="doctor-name">' + obj.lastName + ', ' + obj.firstName + '</h2>')
					.append('<h3 class="doctor-department">' + obj.department + '</h3>')
					.append('<img class="large_thumbnail_image" src="' + obj.thumbnail + '" alt="doc' + obj.index + 'thumbnail"/>')
					.append('<div id="com_nav" data-role="navbar" data-iconpos="top"><ul><li><a id="page_button" href="#"data-transition="fade" data-theme="b" data-icon=""><h3>Page</h3></a></li><li><a id="call_button"  href="#" data-transition="fade" data-theme="b" data-icon=""><h3>Call</h3></a></li><li><a id="text_button" href="#" data-transition="fade" data-theme="b" data-icon=""><h3>Text</h3></a></li></ul></div>')
					.after('<div id="text_area" style="width:100%; text-align:center; background-color:#6D88B3" id="texting_box"><textarea rows="4" cols="50"></textarea><button style="display:inline; width:20px" id="textbutton">Send</button><button style="display:inline; width:20px"  id="textbutton">Attach</button></div>')
			var rawHTML = $(self.generatePageContainer(pageName))
				.append(self.generateHeader(pageName))
				.append(content);

			var page = rawHTML.appendTo('body').page();

			return(page);
		},

		loadEvents:function() {
			var self = this;

			$('#loginPage').on('click', '#enter_button', function(e){
				
				$.mobile.changePage(self.pages['doctorList'], {
					transition:'slide'
				});

				e.preventDefault();
			});
			
			var doctorPageLink = function(e) {
				var $this = $(this);

				if ($this.data('docindex') !== undefined) {
					
					var page = self.generateDoctorPage($this.data('docindex'));
					
					$.mobile.changePage(page, {
						transition:'slide'
					});
				}

				e.preventDefault();
			};

			$('#doctorListPage').on('click', 'a', doctorPageLink);
			$('#departmentPage').on('click', 'a', doctorPageLink);

			$('')
		},

		init:function(config) {
			this.data = config.data;
			var self = this;
			
			this.pages = {
				doctorList:self.generateDoctorListPage(),
				departmentList:self.generateDepartmentPage()
			}

			this.loadEvents('login');
		}
	};


	onShift.init({
		data:this.department_data
	});
/*
	$(document).on('pageinit', '#about', function(e){
		alert("pageinit");
	});

	$(document).on('pagebeforechange', function(e){
		alert("pagebeforechange");
	});

	$(document).on('pagebeforechange', function(e){
	var $this = $(this);
	
	var activeElement = e.currentTarget.activeElement.id;
	switch(activeElement) {
		case(''): //initial load
			break
	}
});


*/
}(jQuery, window, document));