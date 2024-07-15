/**
*
* @author: N3 S.r.l.
*/

$(setConfigParametersVisibility());
var prconfigparameters = new ConfigParametersModel('1');
var lastEditId = '';
var indexToShow = null;
$(function(){
	disableForm(prconfigparameters);

});

function setLastEditId(){
	lastEditId = prconfigparameters.id;
}

function editObj(id){
	disableForm(prconfigparameters,true);
	configparametersLogic.get(prconfigparameters,id);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function allowEditObj(){
	enableForm(prconfigparameters,false);
}

function saveObj(){
	var f = function(){disableForm(prconfigparameters);}
	configparametersLogic.save(prconfigparameters,setIndexToShow,setLastEditId, f, reloadAllDatatable);
}

function removeObj(){
	var f = function(){disableForm(prconfigparameters);}
	configparametersLogic.remove(prconfigparameters,prconfigparameters.id, safeDelete, f, reloadAllDatatable);
}

function newObj(){
	newForm(prconfigparameters);
	configparametersLogic.get(prconfigparameters, null);
	$('td').removeClass('lastEditedRow');
	lastEditId = '';
}

function undoObj(){
	var f = function(){
		editObj(prconfigparameters.id);
	};
	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
}

function setIndexToShow(){
	indexToShow = prconfigparameters.id;
}

$(document).ready(function () {
	table = $('#ConfigParametersList').DataTable({
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
			if ($("." +$.md5('general_quiet')).is(":visible"))
				aoData.push({"name": "general_quiet", "value": $('#F_general_quiet').val()});
			if ($("." +$.md5('general_on_error')).is(":visible"))
				aoData.push({"name": "general_on_error", "value": $('#F_general_on_error').val()});
			if ($("." +$.md5('general_except')).is(":visible"))
				aoData.push({"name": "general_except", "value": $('#F_general_except').val()});
			if ($("." +$.md5('image_report_photo')).is(":visible"))
				aoData.push({"name": "image_report_photo", "value": $('#F_image_report_photo').val()});
			if ($("." +$.md5('daily_report_astro')).is(":visible"))
				aoData.push({"name": "daily_report_astro", "value": $('#F_daily_report_astro').val()});
			if ($("." +$.md5('daily_histo')).is(":visible"))
				aoData.push({"name": "daily_histo", "value": $('#F_daily_histo').val()});
			if ($("." +$.md5('monthly_report_astro')).is(":visible"))
				aoData.push({"name": "monthly_report_astro", "value": $('#F_monthly_report_astro').val()});
			if ($("." +$.md5('monthly_histo')).is(":visible"))
				aoData.push({"name": "monthly_histo", "value": $('#F_monthly_histo').val()});
			if ($("." +$.md5('event_fill_frames')).is(":visible"))
				aoData.push({"name": "event_fill_frames", "value": $('#F_event_fill_frames').val()});
			if ($("." +$.md5('event_recenter')).is(":visible"))
				aoData.push({"name": "event_recenter", "value": $('#F_event_recenter').val()});
			if ($("." +$.md5('event_box_bolide')).is(":visible"))
				aoData.push({"name": "event_box_bolide", "value": $('#F_event_box_bolide').val()});
			if ($("." +$.md5('event_model_psf')).is(":visible"))
				aoData.push({"name": "event_model_psf", "value": $('#F_event_model_psf').val()});
			if ($("." +$.md5('event_model_bar')).is(":visible"))
				aoData.push({"name": "event_model_bar", "value": $('#F_event_model_bar').val()});
			if ($("." +$.md5('event_report')).is(":visible"))
				aoData.push({"name": "event_report", "value": $('#F_event_report').val()});
			if ($("." +$.md5('event_image')).is(":visible"))
				aoData.push({"name": "event_image", "value": $('#F_event_image').val()});
			if ($("." +$.md5('event_video')).is(":visible"))
				aoData.push({"name": "event_video", "value": $('#F_event_video').val()});
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
		sAjaxSource: '/lib/prismaCore/1/configparameters/datatable/list'
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
				url: '/lib/prismaCore/1/configparameters/autocomplete/' + $(this).attr('id').replace('F_',''),
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
				url: '/lib/prismaCore/1/configparameters/foreignkey/' + $(this).attr('id').replace('F_',''),
				dataType: 'json'
			},
			minimumInputLength: 0
		});
	});
}

