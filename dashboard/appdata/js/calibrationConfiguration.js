/**
*
* @author: N3 S.r.l.
*/
$(setNodeVisibility());
var prnode = new NodeModel('1');
var lastEditNodeId = '';
var nodeIndexToShow = null;
$(function () {
	disableForm(prnode);
});

function editObj(id) {
}

function setLastEditNodeId() {
	lastEditNodeId = prnode.id;
}

$(document).ready(function () {
	table = $('#NodeList').DataTable({
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
			//if ($("." + $.md5('altitude')).is(":visible"))
			aoData.push({ "name": "altitude", "value": $('#F_altitude').val() });
			//if ($("." + $.md5('longitude')).is(":visible"))
			aoData.push({ "name": "longitude", "value": $('#F_longitude').val() });
			//if ($("." + $.md5('latitude')).is(":visible"))
			aoData.push({ "name": "latitude", "value": $('#F_latitude').val() });
			//if ($("." + $.md5('note')).is(":visible"))
			aoData.push({ "name": "note", "value": $('#F_note').val() });
			// if ($("." + $.md5('id')).is(":visible"))
			//aoData.push({ "name": "id", "value": $('#F_id').val() });
			// if ($("." + $.md5('oid')).is(":visible"))
			aoData.push({ "name": "oid", "value": $('#F_oid').val() });
		},
		"fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
			
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
		},
		bProcessing: true,
		bServerSide: true,
		bStateSave: true,
		sAjaxSource: '/lib/prismaCore/1/calibrationconfiguration/datatable/list'
	});
});