/**
*
* @author: N3 S.r.l.
*/

class ReferToModel extends ReferTo {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new ReferToModel(this.version);
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
		let helper = new ReferToModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new ReferToModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		deleteAjax(this,endpoint,json,...callBack);
	}
	get parseToObj(){
		let obj = {
			id: this.id,
			core_person_id: this.core_person_id,
			station_id: this.station_id,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.core_person_id = obj.core_person_id;
		context.station_id = obj.station_id;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setReferToVisibility(){ 

	let prreferto_visibility = new ReferTo(); 

	prreferto_visibility.id = true; 
	prreferto_visibility.core_person_id = true; 
	prreferto_visibility.station_id = true; 
	prreferto_visibility.erased = true; 
	prreferto_visibility.last_update = true; 
	

	$.each(prreferto_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

