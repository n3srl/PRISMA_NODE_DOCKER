/**
*
* @author: N3 S.r.l.
*/

class CameraModel extends Camera {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new CameraModel(this.version);
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
		let helper = new CameraModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new CameraModel(this.version);
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
			code: this.code,
			config_file: this.config_file,
			mask_file: this.mask_file,
			model: this.model,
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
		context.code = obj.code;
		context.config_file = obj.config_file;
		context.mask_file = obj.mask_file;
		context.model = obj.model;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setCameraVisibility(){ 

	let prcamera_visibility = new Camera(); 

	prcamera_visibility.id = true; 
	prcamera_visibility.oid = true; 
	prcamera_visibility.node_id = true; 
	prcamera_visibility.code = true; 
	prcamera_visibility.config_file = true; 
	prcamera_visibility.mask_file = true; 
	prcamera_visibility.model = true; 
	prcamera_visibility.modified_by = true; 
	prcamera_visibility.created_by = true; 
	prcamera_visibility.assigned = true; 
	prcamera_visibility.erased = true; 
	prcamera_visibility.last_update = true; 
	

	$.each(prcamera_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

