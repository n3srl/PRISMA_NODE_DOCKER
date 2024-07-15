/**
 *
 * @author: N3 S.r.l.
 */

$(setDetectionVisibility());
var monthly_calibration = new MonthlyCalibrationModel('1');
var lastEditId = '';
var indexToShow = null;
var isPreviewEnabled = false;
var table1 = null;
var table2 = null;
var isProcessingZip = false;
var isProcessingVideo = false;
var zipRow = null;
var videoRow = null;
var createZipXhr = null;
var createVideoXhr = null;
var zipName = null;
var zipDownload = false;
var videoName = null;
var videoDownload = false;
var folder = null;
//  var month = 1;

$(function () {
	disableForm(monthly_calibration);
});

function setLastEditId() {
	lastEditId = monthly_calibration.id;
}
/**
 * 
 
// function editObj(id) {
// 	disableForm(monthly_calibration, true);
// 	detectionLogic.get(monthly_calibration, id);
// 	$('td').removeClass('lastEditedRow');
// 	lastEditId = '';
// }

// function allowEditObj() {
// 	enableForm(monthly_calibration, false);
// }

// function saveObj() {
// 	var f = function () {
// 		disableForm(monthly_calibration);
// 	}
// 	detectionLogic.save(monthly_calibration, setIndexToShow, setLastEditId, f, reloadAllDatatable);
// }

// function removeObj() {
// 	var f = function () {
// 		disableForm(monthly_calibration);
// 	}
// 	detectionLogic.remove(monthly_calibration, monthly_calibration.id, safeDelete, f, reloadAllDatatable);
// }

// function newObj() {
// 	newForm(monthly_calibration);
// 	detectionLogic.get(monthly_calibration, null);
// 	$('td').removeClass('lastEditedRow');
// 	lastEditId = '';
// }

// function undoObj() {
// 	var f = function () {
// 		editObj(monthly_calibration.id);
// 	};
// 	alertConfirm("Conferma", "Sei sicuro di voler annullare le modifiche? Le modifiche non salvate andranno perse", f);
// }

// function setIndexToShow() {
// 	indexToShow = monthly_calibration.id;
// }
*/
/**
// // Enable detections previews
// $("#enable-detection-preview").on('change', function (event) {
// 	isPreviewEnabled = $("#enable-detection-preview").is(":checked");
// 	$('#DetectionList').dataTable().fnDraw();
// });

// // Enable all detections
// $("#enable-detection-all").on('click', function (event) {
// 	folder = '';
// 	$('#DetectionList').dataTable().fnDraw();
// });

// Enable only month------------------------------------------------------------------------------
// $("#montlycal").on('click', function (event) {
// 	var l1 = document.getElementById("montlycal");
// 	if (l1.checked == true) {
// 		month = 1;
// 	} else {
// 		month = 0;
// 	}
// 	$('#DetectionList').dataTable().fnDraw();
// });
*/
// Create detection zip
function getZip(row) {
	var data = table2.rows(row).data()[0];
	defaultSuccess("Il tuo download inizierà tra qualche minuto");
	isProcessingZip = true;
	zipRow = row;
	$('#DetectionList').dataTable().fnDraw();

	createZipXhr = $.ajax({
		url: "/lib/prismaCore/1/calibrationexecutionhistory/createzip/" + data[0].split(".")[0] + ":" + data[0].split(".")[1],
		async: true,
		global: false,
		method: 'POST',
		success: function (json) {
			downloadZip(json);
		}
	});
}

// Download detection zip
function downloadZip(json) {
	isProcessingZip = false;
	zipRow = null;
	zipDownload = true;
	zipName = JSON.parse(json).data;
	$('#DetectionList').dataTable().fnDraw();
}

// Abort detection zip
function cancelZip() {
	createZipXhr.abort();
	isProcessingZip = false;
	zipRow = null;
	$.ajax({
		async: true,
		type: "POST",
		global: false,
		url: "/lib/detection/V2/detection/zip/cancel",
		success: function (json) {
			defaultError("Zip annullato");
		}
	});
	$('#DetectionList').dataTable().fnDraw();
}

$(window).bind('beforeunload', function () {
	if (isProcessingZip || isProcessingVideo) {
		return 'Se lasci o ricarichi la pagina i download correnti verranno interrotti. Vuoi continuare lo stesso?';
	}
});

$(window).unload(function () {
	$.ajax({
		async: true,
		type: "POST",
		global: false,
		url: "/lib/detection/V2/detection/video/cancel"
	});
	$.ajax({
		async: true,
		type: "POST",
		global: false,
		url: "/lib/detection/V2/detection/zip/cancel"
	});
});

$(document).ready(function () {
	table1 = $('#DetectionDayList').DataTable({
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
			aoData.push({ "name": "searchPageById", "value": indexToShow });
			if ($("." + $.md5('date')).is(":visible"))
				aoData.push({ "name": "date", "value": $('#F_date').val() });
			if ($("." + $.md5('number')).is(":visible"))
				aoData.push({ "name": "number", "value": $('#F_number').val() });
			if ($("." + $.md5('folder')).is(":visible"))
				aoData.push({ "name": "folder", "value": $('#F_folder').val() });
		},
		"drawCallback": function (settings) {
			if (table1.data().count()) {
				folder = table1.row(':eq(0)').data()[2];
				$('#DetectionDayList tbody tr:eq(0)').addClass('selected');
				if (table2) {
					$('#DetectionList').dataTable().fnDraw();
				} else {
					initDetectionsDatatable();
				}
			}
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
		//"order": [[groupColumn, 'desc']],
		bProcessing: true,
		bServerSide: true,
		bStateSave: true,
		sAjaxSource: '/lib/prismaCore/1/detection/datatable/daylist',
		"paging": true,
		"bLengthChange": false,
		"ordering": false,
		"info": true,
		"searching": false
	});
});

function format(callback, name) {
	$.ajax({
		type: "GET",
		url: "/lib/prismaCore/1/monthlycalibration/calibrationfiles/" + name,
		dataType: "json",
		cache: false,
		success: function (response) {
			//var data = JSON.parse(response);
			var tbody = "";
			tbody += "<tr><td>" + "Nodo: " + response.results[0].node_code + "</td></tr>"
			$.each(response.results, function (index, value) {
				tbody += "<tr><td>" + value.name + "</td></tr>";
			});

			callback($("<table class='table table-striped'>" + tbody + "</table>")).show();
		},
		error: function (response) {
			alertError("Errore", "Non sono presenti file per questa calibrazione mensile.");
		}

	});
}

function setDefaultCalibration(calibration_name, calibration_date) {
	
	monthly_calibration.date = calibration_date;
	monthly_calibration.name = calibration_name;
	//console.log(monthly_calibration);
	let f = function () {
		monthlycalibratioLogic.updateDefaultCalibration(monthly_calibration, reloadAllDatatable);
	};
	alertConfirm("Modifica calibrazione predefinita", "Sei sicuro di voler impostare questa calibrazione come predefinita?", f);
}

initDetectionsDatatable();
// Create datatable with detections of selected day
function initDetectionsDatatable() {
	// var groupColumn = 1;
	table2 = $('#DetectionList').DataTable({
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
		columnDefs: [
			{
				"targets": "_all",
				"orderable": false
			},
			{
				"targets": [-1],
				render: function (data, type, row, meta) {
					if (isProcessingZip && meta.row === zipRow) {
						return "<center>" +
							"<button class='btn btn-danger' onclick='cancelZip()'><i class='fa fa-close'></i></button>" +
							"</center>";
					}
					var disabled = "";
					if (isProcessingZip || isProcessingVideo) {
						disabled = "disabled";
					}
					return "<center>" +
						"<button class='btn btn-success' " + disabled + " onclick= 'getZip(" + meta.row + ")'><i class='fa fa-download'></i></button>" +
						"</center>";
				}
			},
			{
				"targets": [-2],
				render: function (data, type, row, meta) {
					if (data == '0') {
						return "<center>" +
							"<button class='btn btn-success' onclick= " + `setDefaultCalibration("${row[0]}","${row[1]}")` +"><i class='fa fa-star'></i></button>" +
							"</center>";

					}
					return "<center>" +
						"<button class='btn btn-warning' onclick= " + `setDefaultCalibration("${row[0]}, ${row[1]}")` + "><i class='fa fa-star'></i></button>" +
						"</center>";


				}
			}
		],
		responsive: true,
		dom: 'lfrt<t>ip',
		"fnServerParams": function (aoData) {
			// Show page with passed index
			// aoData.push({ "name": "searchPageById", "value": indexToShow });
			aoData.push({ "name": "dayDir", "value": folder });
			// aoData.push({ "name": "enablePreview", "value": isPreviewEnabled });
			//aoData.push({"name": "month", "value": month});
			// if ($("." + $.md5('id')).is(":visible"))
			// 	aoData.push({ "name": "id", "value": $('#F_id').val() });
			// if ($("." + $.md5('name')).is(":visible"))
			// 	aoData.push({ "name": "name", "value": $('#F_name').val() });
			// if ($("." + $.md5('date')).is(":visible"))
			// 	aoData.push({ "name": "date", "value": $('#F_date').val() });
			// if ($("." + $.md5('hour')).is(":visible"))
			// 	aoData.push({ "name": "hour", "value": $('#F_hour').val() });
		},
		// "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
		// 	// console.log(aData);

		// 	// if(	aData[3] == '0')
		// 	// {
		// 	// 	$(nRow).find('td:eq(2)').html("<center>" +
		// 	// 		"<button class='btn btn-success' onclick= " + `setDefaultCalibration("${aData[3]}")` + "><i class='fa fa-tree'></i></button>" +
		// 	// 		"</center>");
		// 	// }
		// },
		//  rowGroup: {
		// 	 startRender: function (rows, group) {
		// 		 var info = group.split(":");
		// 		 return $('<tr class="group" style="background-color:#C6CAD4;">')
		// 				 .append('<td colspan="7">' + info[0] + ' (' + info[1] + ' detection)' + '</td></tr>');
		// 	 },
		// 	 endRender: null,
		// 	 dataSrc: groupColumn
		//  },
		// "drawCallback": function (oSettings) {
		// 	if (zipDownload) {
		// 		//window.location.href = "/lib/prismaCore/1/detection/download/" + zipName; //originale ma non funziona perche .zip manda in confusione php
		// 		window.location.href = "/lib/prismaCore/1/calibrationexecutionhistory/download/" + zipName.split(".")[0] + ":" + zipName.split(".")[1];
		// 		zipName = null;
		// 		zipDownload = false;
		// 	}
		// },
		// "order": [[groupColumn, 'desc']],
		"iDisplayLength": 10,
		"iDisplayStart": 0,
		"pageLength": 10,
		bProcessing: true,
		bServerSide: true,
		//bStateSave: true, TODO: verificare perché la colonna "Mese" viene mostrata solo con questo flag a false
		sAjaxSource: '/lib/prismaCore/1/monthlycalibration/datatable/monthlycalibration',
		"paging": true,
		"bLengthChange": false,
		"searching": false
	}
	);



	$('#DetectionList').on('click', 'tr', function () {
		var tr = $(this).closest('tr');
		var row = table2.row(tr);
		var data = table2.row(tr).data();
		if (row.child.isShown()) {
			row.child.hide();
			tr.removeClass('shown');
		} else {
			format(row.child, data[0]);
		}
	});

	// Change detections displayed by click on corresponding day
	$('#DetectionDayList tbody').on('click', 'tr', function () {
		var rowData = table1.row(this).data();
		folder = rowData[0];
		$('#DetectionList').dataTable().fnDraw();
		table1.$('tr.selected').removeClass('selected');
		$(this).addClass('selected');
	});

	/**
	// Hide preview columns and enable preview toggle if media preview not enabled
	$.get("/lib/ft/V2/freeturefinal/media/preview", function (json) {
		var data = JSON.parse(json).data;
		table2.column(3).visible(data);
		table2.column(4).visible(data);
		table2.column(5).visible(data);
		if (!data) {
			$("#enable-detection-preview-box").hide();
		}
	});

	// Hide zip and video column and enable preview toggle if media processing not enabled
	$.get("/lib/ft/V2/freeturefinal/media/processing", function (json) {
		var data = JSON.parse(json).data;
		table2.column(6).visible(data);
		table2.column(7).visible(data);
	});
	*/
}


