/**
*
* @author: N3 S.r.l.
*/

$(setEmailAlertVisibility());
var premailalert = new EmailAlertModel('1');
var lastEditId = '';
var indexToShow = null;
$(function(){
	disableForm(premailalert);

});

function setLastEditId(){
	lastEditId = premailalert.id;
}

function editObj(id){
	disableForm(premailalert,true);
	emailalertLogic.get(premailalert,id);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function allowEditObj(){
	enableForm(premailalert,false);
}

function saveObj(){
	var f = function(){disableForm(premailalert);}
	emailalertLogic.save(premailalert,setIndexToShow,setLastEditId, f, reloadAllDatatable);
}

function removeObj(){
	var f = function(){disableForm(premailalert);}
	emailalertLogic.remove(premailalert,premailalert.id, safeDelete, f, reloadAllDatatable);
}

function newObj(){
	newForm(premailalert);
	emailalertLogic.get(premailalert, null);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function undoObj(){
	var f = function(){
		editObj(premailalert.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setIndexToShow(){
	indexToShow = premailalert.id;
}

$(document).ready(function () {
	table = $('#EmailAlertList').DataTable({
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
			if ($("." +$.md5('event_id')).is(":visible"))
				aoData.push({"name": "event_id", "value": $('#F_event_id').val()});
			if ($("." +$.md5('core_person_id')).is(":visible"))
				aoData.push({"name": "core_person_id", "value": $('#F_core_person_id').val()});
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
		sAjaxSource: '/lib/prismaCore/1/emailalert/datatable/list'
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
				url: '/lib/prismaCore/1/emailalert/autocomplete/' + $(this).attr('id').replace('F_',''),
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
				url: '/lib/prismaCore/1/emailalert/foreignkey/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}

