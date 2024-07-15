/**
*
* @author: N3 S.r.l.
*/

class CalibrationExecutionHistoryModel extends CalibrationExecutionHistory {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new CalibrationExecutionHistoryModel(this.version);
			let obj = this;
			$.each(helper, function (index, value) {
				obj[index] = value;
			});
			callBack.forEach(s => s.apply());
		}
	}
	insert(...callBack){
		let endpoint = this.endpointBase + '';
		let obj = this.parseToObj;
		let json = JSON.stringify(obj);
		postAjax(this,endpoint,json,...callBack);
	}
	update(...callBack){
		let endpoint = this.endpointBase + '';
		let obj = this.parseToObj;
		let json = JSON.stringify(obj);
		putAjax(this,endpoint,json,...callBack);
	}
	erase(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new CalibrationExecutionHistoryModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new CalibrationExecutionHistoryModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		deleteAjax(this,endpoint,json,...callBack);
	}
	get parseToObj(){
		let obj = {
			id: this.id,
			oid: this.oid,
			camera_id: this.camera_id,
			date: this.date,
			execution_datetime: this.execution_datetime,
			monthly_or_daily: this.monthly_or_daily,
			config_parameters: this.config_parameters,
			stdout: this.stdout,
			stderr: this.stderr,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.camera_id = obj.camera_id;
		context.date = obj.date;
		context.execution_datetime = obj.execution_datetime;
		context.monthly_or_daily = obj.monthly_or_daily;
		context.config_parameters = obj.config_parameters;
		context.stdout = obj.stdout;
		context.stderr = obj.stderr;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setCalibrationExecutionHistoryVisibility(){ 

	let prcalibrationexecutionhistory_visibility = new CalibrationExecutionHistory(); 

	prcalibrationexecutionhistory_visibility.id = true; 
	prcalibrationexecutionhistory_visibility.oid = true; 
	prcalibrationexecutionhistory_visibility.camera_id = true; 
	prcalibrationexecutionhistory_visibility.date = true; 
	prcalibrationexecutionhistory_visibility.execution_datetime = true; 
	prcalibrationexecutionhistory_visibility.monthly_or_daily = true; 
	prcalibrationexecutionhistory_visibility.config_parameters = true; 
	prcalibrationexecutionhistory_visibility.stdout = true; 
	prcalibrationexecutionhistory_visibility.stderr = true; 
	prcalibrationexecutionhistory_visibility.modified_by = true; 
	prcalibrationexecutionhistory_visibility.created_by = true; 
	prcalibrationexecutionhistory_visibility.assigned = true; 
	prcalibrationexecutionhistory_visibility.erased = true; 
	prcalibrationexecutionhistory_visibility.last_update = true; 
	

	$.each(prcalibrationexecutionhistory_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

