/**
*
* @author: N3 S.r.l.
*/

$(setReferToVisibility());
var prreferto = new ReferToModel('1');
var lastEditId = '';
var indexToShow = null;
$(function(){
	disableForm(prreferto);

});

function setLastEditId(){
	lastEditId = prreferto.id;
}

function editObj(id){
	disableForm(prreferto,true);
	refertoLogic.get(prreferto,id);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function allowEditObj(){
	enableForm(prreferto,false);
}

function saveObj(){
	var f = function(){disableForm(prreferto);}
	refertoLogic.save(prreferto,setIndexToShow,setLastEditId, f, reloadAllDatatable);
}

function removeObj(){
	var f = function(){disableForm(prreferto);}
	refertoLogic.remove(prreferto,prreferto.id, safeDelete, f, reloadAllDatatable);
}

function newObj(){
	newForm(prreferto);
	refertoLogic.get(prreferto, null);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function undoObj(){
	var f = function(){
		editObj(prreferto.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setIndexToShow(){
	indexToShow = prreferto.id;
}

$(document).ready(function () {
	table = $('#ReferToList').DataTable({
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
			if ($("." +$.md5('core_person_id')).is(":visible"))
				aoData.push({"name": "core_person_id", "value": $('#F_core_person_id').val()});
			if ($("." +$.md5('station_id')).is(":visible"))
				aoData.push({"name": "station_id", "value": $('#F_station_id').val()});
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
		sAjaxSource: '/lib/prismaCore/1/referto/datatable/list'
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
				url: '/lib/prismaCore/1/referto/autocomplete/' + $(this).attr('id').replace('F_',''),
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
				url: '/lib/prismaCore/1/referto/foreignkey/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}

