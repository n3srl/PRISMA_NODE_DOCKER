/**
*
* @author: N3 S.r.l.
*/

$(setStationVisibility());
var prstation = new StationModel('1');
var lastEditId = '';
var indexToShow = null;
$(function(){
	disableForm(prstation);

});

function setLastEditId(){
	lastEditId = prstation.id;
}

function editObj(id){
	disableForm(prstation,true);
	stationLogic.get(prstation,id);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function allowEditObj(){
	enableForm(prstation,false);
}

function saveObj(){
	var f = function(){disableForm(prstation);}
	stationLogic.save(prstation,setIndexToShow,setLastEditId, f, reloadAllDatatable);
}

function removeObj(){
	var f = function(){disableForm(prstation);}
	stationLogic.remove(prstation,prstation.id, safeDelete, f, reloadAllDatatable);
}


function hideKMLForm(){
    $("#kml_upload_form").hide();
}

function showKMLForm(){
    $("#kml_upload_form").show();
}

function importKML(){
    showKMLForm();
}

function exportKML(){

}

function newObj(){
	newForm(prstation);
	stationLogic.get(prstation, null);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function undoObj(){
	var f = function(){
		editObj(prstation.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setIndexToShow(){
	indexToShow = prstation.id;
}

$(document).ready(function () {
	table = $('#StationList').DataTable({
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
			aoData.push({"name": "searchPageById", "value": indexToShow});
			if ($("." +$.md5('id')).is(":visible"))
				aoData.push({"name": "id", "value": $('#F_id').val()});
			if ($("." +$.md5('oid')).is(":visible"))
				aoData.push({"name": "oid", "value": $('#F_oid').val()});
			if ($("." +$.md5('region_id')).is(":visible"))
				aoData.push({"name": "region_id", "value": $('#F_region_id').val()});
			if ($("." +$.md5('code')).is(":visible"))
				aoData.push({"name": "code", "value": $('#F_code').val()});
			if ($("." +$.md5('sequence_number')).is(":visible"))
				aoData.push({"name": "sequence_number", "value": $('#F_sequence_number').val()});
			if ($("." +$.md5('altitude')).is(":visible"))
				aoData.push({"name": "altitude", "value": $('#F_altitude').val()});
			if ($("." +$.md5('longitude')).is(":visible"))
				aoData.push({"name": "longitude", "value": $('#F_longitude').val()});
			if ($("." +$.md5('latitude')).is(":visible"))
				aoData.push({"name": "latitude", "value": $('#F_latitude').val()});
			if ($("." +$.md5('note')).is(":visible"))
				aoData.push({"name": "note", "value": $('#F_note').val()});
			if ($("." +$.md5('nickname')).is(":visible"))
				aoData.push({"name": "nickname", "value": $('#F_nickname').val()});
			if ($("." +$.md5('registration_date')).is(":visible"))
				aoData.push({"name": "registration_date", "value": $('#F_registration_date').val()});
			if ($("." +$.md5('active')).is(":visible"))
				aoData.push({"name": "active", "value": $('#F_active').val()});
		},
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			if (aData[aData.length - 1] == lastEditId) {
				$('td', nRow).addClass('lastEditedRow');
			}
		},
		"fnDrawCallback": function (settings, json) {
			// Show page with passed index
			indexToShow = null;
				setTimeout(function () {
				if (settings.json.pageToShow !== null) {
					if ($('.dataTable').DataTable().page.info().page !== settings.json.pageToShow) {
						$('.dataTable').DataTable().page(settings.json.pageToShow).draw('page');
					}
				}
			}, 100);
		},
		bProcessing: true,
		bServerSide: true,
		bStateSave: true,
		sAjaxSource: '/lib/prismaCore/1/station/datatable/list'
	});
});

 $(function() {
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
				url: '/lib/prismaCore/1/station/autocomplete/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 1
		});
	});
	$(".filter-date, .date").each(function (index) {
		$(this).daterangepicker(setData, function(){reloadAllDatatable();});
	});
	$(".foreign_key").each(function (index) {
		$(this).select2({
			language: 'it',
			maximumSelectionLength: 0,
			multiple: false,
			ajax: {
				url: '/lib/prismaCore/1/station/foreignkey/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}