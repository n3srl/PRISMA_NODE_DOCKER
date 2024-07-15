/**
*
* @author: N3 S.r.l.
*/

class EventModel extends Event {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new EventModel(this.version);
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
		let helper = new EventModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new EventModel(this.version);
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
			code: this.code,
			to_process: this.to_process,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.code = obj.code;
		context.to_process = obj.to_process;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setEventVisibility(){ 

	let prevent_visibility = new Event(); 

	prevent_visibility.id = true; 
	prevent_visibility.oid = true; 
	prevent_visibility.code = true; 
	prevent_visibility.to_process = true; 
	prevent_visibility.modified_by = true; 
	prevent_visibility.created_by = true; 
	prevent_visibility.assigned = true; 
	prevent_visibility.erased = true; 
	prevent_visibility.last_update = true; 
	

	$.each(prevent_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

