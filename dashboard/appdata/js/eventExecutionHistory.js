/**
*
* @author: N3 S.r.l.
*/

$(setEventExecutionHistoryVisibility());
var preventexecutionhistory = new EventExecutionHistoryModel('1');
var lastEditId = '';
var indexToShow = null;
$(function(){
	disableForm(preventexecutionhistory);

});

function setLastEditId(){
	lastEditId = preventexecutionhistory.id;
}

function editObj(id){
	disableForm(preventexecutionhistory,true);
	eventexecutionhistoryLogic.get(preventexecutionhistory,id);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function allowEditObj(){
	enableForm(preventexecutionhistory,false);
}

function saveObj(){
	var f = function(){disableForm(preventexecutionhistory);}
	eventexecutionhistoryLogic.save(preventexecutionhistory,setIndexToShow,setLastEditId, f, reloadAllDatatable);
}

function removeObj(){
	var f = function(){disableForm(preventexecutionhistory);}
	eventexecutionhistoryLogic.remove(preventexecutionhistory,preventexecutionhistory.id, safeDelete, f, reloadAllDatatable);
}

function newObj(){
	newForm(preventexecutionhistory);
	eventexecutionhistoryLogic.get(preventexecutionhistory, null);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function undoObj(){
	var f = function(){
		editObj(preventexecutionhistory.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setIndexToShow(){
	indexToShow = preventexecutionhistory.id;
}

$(document).ready(function () {
	table = $('#EventExecutionHistoryList').DataTable({
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
			if ($("." +$.md5('event_id')).is(":visible"))
				aoData.push({"name": "event_id", "value": $('#F_event_id').val()});
			if ($("." +$.md5('execution_datetime')).is(":visible"))
				aoData.push({"name": "execution_datetime", "value": $('#F_execution_datetime').val()});
			if ($("." +$.md5('config_parameters')).is(":visible"))
				aoData.push({"name": "config_parameters", "value": $('#F_config_parameters').val()});
			if ($("." +$.md5('stdout')).is(":visible"))
				aoData.push({"name": "stdout", "value": $('#F_stdout').val()});
			if ($("." +$.md5('stderr')).is(":visible"))
				aoData.push({"name": "stderr", "value": $('#F_stderr').val()});
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
		sAjaxSource: '/lib/prismaCore/1/eventexecutionhistory/datatable/list'
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
				url: '/lib/prismaCore/1/eventexecutionhistory/autocomplete/' + $(this).attr('id').replace('F_',''),
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
				url: '/lib/prismaCore/1/eventexecutionhistory/foreignkey/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}

