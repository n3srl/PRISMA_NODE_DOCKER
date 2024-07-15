/**
*
* @author: N3 S.r.l.
*/

class EventExecutionHistoryModel extends EventExecutionHistory {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new EventExecutionHistoryModel(this.version);
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
		let helper = new EventExecutionHistoryModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new EventExecutionHistoryModel(this.version);
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
			event_id: this.event_id,
			execution_datetime: this.execution_datetime,
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
		context.event_id = obj.event_id;
		context.execution_datetime = obj.execution_datetime;
		context.config_parameters = obj.config_parameters;
		context.stdout = obj.stdout;
		context.stderr = obj.stderr;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setEventExecutionHistoryVisibility(){ 

	let preventexecutionhistory_visibility = new EventExecutionHistory(); 

	preventexecutionhistory_visibility.id = true; 
	preventexecutionhistory_visibility.oid = true; 
	preventexecutionhistory_visibility.event_id = true; 
	preventexecutionhistory_visibility.execution_datetime = true; 
	preventexecutionhistory_visibility.config_parameters = true; 
	preventexecutionhistory_visibility.stdout = true; 
	preventexecutionhistory_visibility.stderr = true; 
	preventexecutionhistory_visibility.modified_by = true; 
	preventexecutionhistory_visibility.created_by = true; 
	preventexecutionhistory_visibility.assigned = true; 
	preventexecutionhistory_visibility.erased = true; 
	preventexecutionhistory_visibility.last_update = true; 
	

	$.each(preventexecutionhistory_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

