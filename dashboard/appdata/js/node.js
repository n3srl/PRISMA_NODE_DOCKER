/**
*
* @author: N3 S.r.l.
*/
$(setNodeVisibility());
$(setPersonVisibility());
var prnode = new NodeModel('1');
var core_person = new ContactModel('1');
var lastEditNodeId = '';
var lastEditPersonId = '';
var nodeIndexToShow = null;
var personIndexToShow = null;
$(function () {
	disableForm(prnode);
	disableForm(core_person, false, true);

});

function setLastEditNodeId() {
	lastEditNodeId = prnode.id;
}

function setLastEditPersonId() {
	lastEditPersonId = core_person.idPerson;
}
var isReference = false;

/**
 * 
 * NODE
 * 
 */
function editObj(id) {

	disableForm(prnode, true);

	nodeLogic.get(prnode, id);
	isReference = true;
	$('td').removeClass('lastEditedRow');
	lastEditNodeId = '';
}

function allowEditObj() {
	isReference = true;
	enableForm(prnode, false);
}

function saveObj() {
	var f = function () { disableForm(prnode); }
	nodeLogic.save(prnode, setNodeIndexToShow, setLastEditNodeId, f, reloadAllDatatable);
}

function removeObj() {
	var f = function () { disableForm(prnode); }
	nodeLogic.remove(prnode, prnode.id, safeDelete, f, reloadAllDatatable);
}

function newObj() {
	isReference = true;
	disableForm(core_person);
	newForm(prnode, false, false);
	nodeLogic.get(prnode, null);
	$('td').removeClass('lastEditedRow');
	lastEditNodeId = '';
}

function undoObj() {
	var f = function () {
		editObj(prnode.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function getGenCode(region_id) {
	var f = function () {
		$('#code').val(prnode.code);
	}
	nodeLogic.getCode(prnode, region_id, f);
}

function getGenHostname(region_id) {
	var f = function () {
		$('#hostname').val(prnode.hostname);
	}
	nodeLogic.getHostname(prnode, region_id, f);
}

function updateNodeStatus() {
	nodeLogic.updateNodeStatus(prnode, setNodeIndexToShow, setLastEditNodeId, reloadAllDatatable);
}

function setNodeIndexToShow() {
	nodeIndexToShow = prnode.id;
}

/**
 * 
 * PERSON
 * 
 */
function editPerson(id) {
	if (isReference) {
		var f1 = function () { $('#refered_to').val(prnode.refered_to); }
		var f2 = function () { $('#refered_to_name').val(core_person.first_name + ' ' + core_person.last_name); }
		personLogic.getUser(core_person, prnode, id, f1, f2);
		$('td').removeClass('lastEditedRow');
		lastEditPersonId = '';
	} else {
		disableForm(core_person, true, true);
		personLogic.get(core_person, id);
		$('td').removeClass('lastEditedRow');
		lastEditPersonId = '';
	}
}

function savePerson() {
	var f = function () { disableForm(core_person); }
	contactLogic.save(core_person, setPersonIndexToShow, setLastEditPersonId, f, reloadAllDatatable);
}

function allowEditPerson() {
	isReference = false;
	enableForm(core_person, false, true);
}

function removePerson() {
	var f = function () { disableForm(core_person); }

	contactLogic.remove(core_person, core_person.idPerson, safeDelete, f, reloadAllDatatable);
}

function newPerson() {
	isReference = false;
	disableForm(prnode);
	newForm(core_person, false, true);
	contactLogic.get(core_person, null);
	$('td').removeClass('lastEditedRow');
	lastEditPersonId = '';

	$("#is_station_referer").prop("checked", true);
	$("#is_station_referer").val(1);
	$("#is_administrator").prop("checked", true);
	$("#is_administrator").val(0);
}

function undoPerson() {
	var f = function () {
		editPerson(core_person.idPerson);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setPersonIndexToShow() {
	personIndexToShow = core_person.idPerson;
	$('td').removeClass('lastEditedRow');

}

function showPersonForm() {
	//$('#PersonBlock').toggle();
	// if ($('#CompanyForm').is(':visible')) {
	// 	$('#CompanyForm').toggle(false);
	// }
	disableForm(prnode, false);
	//$('#PersonForm').toggle(true);
}

function showCompanyForm() {
	// if ($('#PersonForm').is(':visible')) {
	// 	$('#PersonForm').toggle(false);
	// }
	disableForm(core_person, false);
	//$('#CompanyForm').toggle(true);
}


$(document).ready(function () {
	tableNode = $('#NodeList').DataTable({
		"oLanguage": {
			"sZeroRecords": "Nessun risultato",
			"sSearch": "Cerca:",
			"oPaginate": {
				"sPrevious": "Indietro",
				"sNext": "Avanti"
			},
			"sInfo": "Mostra pagina _PAGE_ di _PAGES_",
			"sInfoFiltered": "",
			"sInfoEmpty": "Mostra pagina 0 di 0 elementi",
			"sEmptyTable": "Nessun risultato",
			"sLengthMenu": "Mostra _MENU_ elementi"
		},
		"columnDefs": [{
			"targets": [-2, -3],
			"orderable": false, 
			"defaultContent":'<button>Details</button>'
		},
		{
			"targets": [-1],
			"visible": false
		}
		],
		responsive: true,
		dom: 'lfrt<t>ip',
		"fnServerParams": function (aoData) {
			// Show page with passed index
			aoData.push({ "name": "searchPageById", "value": nodeIndexToShow });

			//GUARDARE PERCHÈ SOLO IL PRIMO IF È TRUE
			//if ($("." + $.md5('id')).is(":visible"))
			aoData.push({ "name": "id", "value": $('#F_id').val() });
			//if ($("." + $.md5('code')).is(":visible"))
			aoData.push({ "name": "code", "value": $('#F_code').val() });
			//if ($("." + $.md5('nickname')).is(":visible"))
			aoData.push({ "name": "nickname", "value": $('#F_nickname').val() });
			//if ($("." + $.md5('region_id')).is(":visible"))
			aoData.push({ "name": "region_id", "value": $('#F_region_id').val() });
			//if ($("." + $.md5('IPaddress')).is(":visible"))
			aoData.push({ "name": "IPaddress", "value": $('#F_IPaddress').val() });
			//if ($("." + $.md5('refered_to')).is(":visible"))
			aoData.push({ "name": "refered_to", "value": $('#F_refered_to').val() });
			//if ($("." + $.md5('altitude')).is(":visible"))
			aoData.push({ "name": "altitude", "value": $('#F_altitude').val() });
			//if ($("." + $.md5('longitude')).is(":visible"))
			aoData.push({ "name": "longitude", "value": $('#F_longitude').val() });
			//if ($("." + $.md5('latitude')).is(":visible"))
			aoData.push({ "name": "latitude", "value": $('#F_latitude').val() });
			//if ($("." + $.md5('note')).is(":visible"))
			aoData.push({ "name": "note", "value": $('#F_note').val() });
			//if ($("." + $.md5('hostname')).is(":visible"))
			aoData.push({ "name": "hostname", "value": $('#F_hostname').val() });
			//if ($("." + $.md5('active')).is(":visible"))
			aoData.push({ "name": "active", "value": $('#F_active').val() });
			//if ($("." + $.md5('nameof_company-association')).is(":visible"))
			aoData.push({ "name": "nameof_company-association", "value": $('#F_nameof_company-association').val() });
			//if ($("." + $.md5('Camera_model')).is(":visible"))
			//aoData.push({ "name": "camera_model", "value": $('#F_camera_model').val() });
			//aoData.push({ "name": "focal_length", "value": $('#F_focal_length').val() });
			//aoData.push({ "name": "node_version", "value": $('#F_node_version').val() });
			// if ($("." + $.md5('id')).is(":visible"))
			//aoData.push({ "name": "id", "value": $('#F_id').val() });
			// if ($("." + $.md5('oid')).is(":visible"))
			aoData.push({ "name": "oid", "value": $('#F_oid').val() });
			// if ($("." + $.md5('station_id')).is(":visible"))
			//aoData.push({ "name": "station_id", "value": $('#F_station_id').val() });
			// if ($("." + $.md5('MAC_address')).is(":visible"))
			aoData.push({ "name": "MAC_address", "value": $('#F_MAC_address').val() });
			// if ($("." + $.md5('hostname')).is(":visible"))
			//aoData.push({ "name": "hostname", "value": $('#F_hostname').val() });
			// if ($("." + $.md5('CName')).is(":visible"))
			aoData.push({ "name": "CName", "value": $('#F_CName').val() });
			// if ($("." + $.md5('freeture_configuration_file')).is(":visible"))
			aoData.push({ "name": "freeture_configuration_file", "value": $('#F_freeture_configuration_file').val() });
			// if ($("." + $.md5('ovpnfile')).is(":visible"))
			aoData.push({ "name": "ovpnfile", "value": $('#F_ovpnfile').val() });
			// if ($("." + $.md5('interval_running_DEA')).is(":visible"))
			aoData.push({ "name": "interval_running_DEA", "value": $('#F_interval_running_DEA').val() });
			// if ($("." + $.md5('relative_path')).is(":visible"))
			aoData.push({ "name": "relative_path", "value": $('#F_relative_path').val() });
		},
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[aData.length - 1] == lastEditNodeId) {
				$('td', nRow).addClass('lastEditedRow');
			}
			$(nRow).find('td:eq(10)').html("<select id='" + aData[15] + "' class='form-control nodestatus'><option selected = 'selected'>" + aData[10][1] + "</option></select>");

		},
		"fnDrawCallback": function (settings, json) {
			// Show page with passed index
			nodeIndexToShow = null;
			setTimeout(function () {
				if (settings.json.pageToShow !== null) {
					if ($('.dataTable').DataTable().page.info().page !== settings.json.pageToShow) {
						$('.dataTable').DataTable().page(settings.json.pageToShow).draw('page');
					}
				}
			}, 100);


			$(".nodestatus").each(function (index) {

				$(this).select2({
					language: 'it',
					maximumSelectionLength: 0,
					multiple: false,
					ajax: {
						url: '/lib/prismaCore/1/node/status/nodestatus',
						dataType: 'json'
					},
					minimumInputLength: 0
				}).on('select2:select', function (e) {
					prnode.id = $(this).attr('id');
					prnode.active = $(e.target).select2("val");
					updateNodeStatus();
				});
			});


		},
		bProcessing: true,
		bServerSide: true,
		bStateSave: true,
		sAjaxSource: '/lib/prismaCore/1/node/datatable/list'
	});


	tablePerson = $('#CorePersonList').DataTable({
		"oLanguage": {
			"sZeroRecords": "Nessun risultato",
			"sSearch": "Cerca:",
			"oPaginate": {
				"sPrevious": "Indietro",
				"sNext": "Avanti"
			},
			"sInfo": "Mostra pagina _PAGE_ di _PAGES_",
			"sInfoFiltered": "",
			"sInfoEmpty": "Mostra pagina 0 di 0 elementi",
			"sEmptyTable": "Nessun risultato",
			"sLengthMenu": "Mostra _MENU_ elementi"
		},
		"columnDefs": [{
			"targets": [-2, -3],
			"orderable": false
		},
		{
			"targets": [-1],
			"visible": false
		}],
		responsive: true,
		dom: 'lfrt<t>ip',
		"fnServerParams": function (aoData) {
			// Show page with passed index
			aoData.push({ "name": "searchPageById", "value": personIndexToShow });
			if ($("." + $.md5('id')).is(":visible"))
				aoData.push({ "name": "id", "value": $('#F_id').val() });
			if ($("." + $.md5('oid')).is(":visible"))
				aoData.push({ "name": "oid", "value": $('#F_oid').val() });
			if ($("." + $.md5('username')).is(":visible"))
				aoData.push({ "name": "username", "value": $('#F_username').val() });
			if ($("." + $.md5('password')).is(":visible"))
				aoData.push({ "name": "password", "value": $('#F_password').val() });
			if ($("." + $.md5('title')).is(":visible"))
				aoData.push({ "name": "title", "value": $('#F_title').val() });
			if ($("." + $.md5('first_name')).is(":visible"))
				aoData.push({ "name": "first_name", "value": $('#F_first_name').val() });
			if ($("." + $.md5('middle_name')).is(":visible"))
				aoData.push({ "name": "middle_name", "value": $('#F_middle_name').val() });
			if ($("." + $.md5('last_name')).is(":visible"))
				aoData.push({ "name": "last_name", "value": $('#F_last_name').val() });
			if ($("." + $.md5('suffix')).is(":visible"))
				aoData.push({ "name": "suffix", "value": $('#F_suffix').val() });
			if ($("." + $.md5('company')).is(":visible"))
				aoData.push({ "name": "company", "value": $('#F_company').val() });
			if ($("." + $.md5('job_title')).is(":visible"))
				aoData.push({ "name": "job_title", "value": $('#F_job_title').val() });
			if ($("." + $.md5('email')).is(":visible"))
				aoData.push({ "name": "email", "value": $('#F_email').val() });
			if ($("." + $.md5('web_page_address')).is(":visible"))
				aoData.push({ "name": "web_page_address", "value": $('#F_web_page_address').val() });
			if ($("." + $.md5('im_address')).is(":visible"))
				aoData.push({ "name": "im_address", "value": $('#F_im_address').val() });
			if ($("." + $.md5('phone')).is(":visible"))
				aoData.push({ "name": "phone", "value": $('#F_phone').val() });
			if ($("." + $.md5('address')).is(":visible"))
				aoData.push({ "name": "address", "value": $('#F_address').val() });
			if ($("." + $.md5('postcode')).is(":visible"))
				aoData.push({ "name": "postcode", "value": $('#F_postcode').val() });
			if ($("." + $.md5('number')).is(":visible"))
				aoData.push({ "name": "number", "value": $('#F_number').val() });
			if ($("." + $.md5('city')).is(":visible"))
				aoData.push({ "name": "city", "value": $('#F_city').val() });
			if ($("." + $.md5('province')).is(":visible"))
				aoData.push({ "name": "province", "value": $('#F_province').val() });
			if ($("." + $.md5('country')).is(":visible"))
				aoData.push({ "name": "country", "value": $('#F_country').val() });
			if ($("." + $.md5('timezone')).is(":visible"))
				aoData.push({ "name": "timezone", "value": $('#F_timezone').val() });
		},
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[aData.length - 1] == lastEditPersonId) {
				$('td', nRow).addClass('lastEditedRow');
			}
		},
		"fnDrawCallback": function (settings, json) {
			// Show page with passed index
			personIndexToShow = null;
			setTimeout(function () {
				if (settings.json.pageToShow != null) {
					if ($('.dataTable').DataTable().page.info().page !== settings.json.pageToShow) {

						$('.dataTable').DataTable().page(settings.json.pageToShow).draw('page');
					}
				}
			}, 100);
		},
		bProcessing: true,
		bServerSide: true,
		bStateSave: true,
		sAjaxSource: '/lib/prismaCore/1/contact/datatable/list'
	});

	table = [{ tableId: "NodeList", table: tableNode }, { tableId: "CorePersonList", table: tablePerson }];
});


function exportSolutionsFile() {
	window.location.href = "/lib/prismaCore/1/node/solutions/download";
}

$(function () {
	initFilters();
});
var setData = {
	singleDatePicker: true, opens: 'right',
	calender_style: "picker_2",
	format: 'DD/MM/YYYY'
};
function initFilters() {
	$(".filter-text").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 1,
			multiple: true,
			ajax: {
				url: '/lib/prismaCore/1/node/autocomplete/' + $(this).attr('id').replace('F_', ''),
				dataType: 'json'
			},
			minimumInputLength: 1
		});
	});
	$(".filter-date, .date").each(function (index) {
		$(this).daterangepicker(setData, function () { reloadAllDatatable(); });
	});
	$(".foreign_key").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/node/foreignkey/' + $(this).attr('id').replace('F_', ''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
	$(".region_name").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/node/regionname/' + $(this).attr('id').replace('F_', ''),
				dataType: 'json'
			},
			minimumInputLength: 0
		}).on('select2:select', function (e) {

			getGenCode($(e.target).select2("val"));
			getGenHostname($(e.target).select2("val"));

		});
	});

	$(".camera_model").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/cameramodel',
				dataType: 'json'
			},
			minimumInputLength: 0
		}).on('select2:select', function (e) {

			

		});
	});

	$(".node_version").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/nodeversion',
				dataType: 'json'
			},
			minimumInputLength: 0
		})
	});

	$(".refered_to_name").each(function (index){
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/node/referedtoname/' + $(this).attr('id').replace('F_', ''),
				dataType: 'json'
			},
			minimumInputLength: 0
		})
	});
	$(".nodestatusForm").each(function (index) {

		$(this).select2({
			language: 'it',
			placeholder: 'Seleziona uno stato',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/node/status/nodestatus',
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}




