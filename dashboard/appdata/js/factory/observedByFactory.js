/**
*
* @author: N3 S.r.l.
*/

class ObservedByModel extends ObservedBy {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new ObservedByModel(this.version);
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
		let helper = new ObservedByModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new ObservedByModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		deleteAjax(this,endpoint,json,...callBack);
	}
	get parseToObj(){
		let obj = {
			id: this.id,
			event_id: this.event_id,
			detection_id: this.detection_id,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.event_id = obj.event_id;
		context.detection_id = obj.detection_id;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setObservedByVisibility(){ 

	let probservedby_visibility = new ObservedBy(); 

	probservedby_visibility.id = true; 
	probservedby_visibility.event_id = true; 
	probservedby_visibility.detection_id = true; 
	probservedby_visibility.erased = true; 
	probservedby_visibility.last_update = true; 
	

	$.each(probservedby_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

