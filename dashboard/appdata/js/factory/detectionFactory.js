/**
*
* @author: N3 S.r.l.
*/

class DetectionModel extends Detection {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new DetectionModel(this.version);
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
		let helper = new DetectionModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new DetectionModel(this.version);
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
			node_id: this.node_id,
			event_id: this.event_id,
			inserted_timestamp: this.inserted_timestamp,
			detected_timestamp: this.detected_timestamp,
			is_fake: this.is_fake,
                        GeMapImg: this.GeMapImg,
                        DirMapImg: this.DirMapImg,
                        EventImg: this.EventImg
                        
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.node_id = obj.node_id;
		context.event_id = obj.event_id;
		context.inserted_timestamp = obj.inserted_timestamp;
		context.detected_timestamp = obj.detected_timestamp;
		context.is_fake = obj.is_fake;
                context.GeMapImg = obj.GeMapImg;
                context.DirMapImg = obj.DirMapImg;
                context.EventImg =  obj.EventImg;               
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setDetectionVisibility(){ 

	let prdetection_visibility = new Detection(); 

	prdetection_visibility.id = true; 
	prdetection_visibility.oid = true; 
	prdetection_visibility.node_id = true; 
	prdetection_visibility.event_id = true; 
	prdetection_visibility.inserted_timestamp = true; 
	prdetection_visibility.detected_timestamp = true; 
	prdetection_visibility.is_fake = true; 
	prdetection_visibility.modified_by = true; 
	prdetection_visibility.created_by = true; 
	prdetection_visibility.assigned = true; 
	prdetection_visibility.erased = true; 
	prdetection_visibility.last_update = true; 
	

	$.each(prdetection_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

