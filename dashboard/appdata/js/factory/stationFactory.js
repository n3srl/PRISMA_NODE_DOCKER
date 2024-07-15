/**
*
* @author: N3 S.r.l.
*/

class StationModel extends Station {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new StationModel(this.version);
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
		let helper = new StationModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new StationModel(this.version);
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
			region_id: this.region_id,
			code: this.code,
			sequence_number: this.sequence_number,
			altitude: this.altitude,
			longitude: this.longitude,
			latitude: this.latitude,
			note: this.note,
			nickname: this.nickname,
			registration_date: this.registration_date,
			active: this.active,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.region_id = obj.region_id;
		context.code = obj.code;
		context.sequence_number = obj.sequence_number;
		context.altitude = obj.altitude;
		context.longitude = obj.longitude;
		context.latitude = obj.latitude;
		context.note = obj.note;
		context.nickname = obj.nickname;
		context.registration_date = obj.registration_date;
		context.active = obj.active;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setStationVisibility(){ 

	let prstation_visibility = new Station(); 

	prstation_visibility.id = true; 
	prstation_visibility.oid = true; 
	prstation_visibility.region_id = true; 
	prstation_visibility.code = true; 
	prstation_visibility.sequence_number = true; 
	prstation_visibility.altitude = true; 
	prstation_visibility.longitude = true; 
	prstation_visibility.latitude = true; 
	prstation_visibility.note = true; 
	prstation_visibility.nickname = true; 
	prstation_visibility.registration_date = true; 
	prstation_visibility.active = true; 
	prstation_visibility.modified_by = true; 
	prstation_visibility.created_by = true; 
	prstation_visibility.assigned = true; 
	prstation_visibility.erased = true; 
	prstation_visibility.last_update = true; 
	

	$.each(prstation_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

