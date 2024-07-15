/**
*
* @author: N3 S.r.l.
*/

class RegionModel extends Region {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new RegionModel(this.version);
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
		let helper = new RegionModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new RegionModel(this.version);
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
			state: this.state,
			code: this.code,
			name: this.name,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.state = obj.state;
		context.code = obj.code;
		context.name = obj.name;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setRegionVisibility(){ 

	let prregion_visibility = new Region(); 

	prregion_visibility.id = true; 
	prregion_visibility.oid = true; 
	prregion_visibility.state = true; 
	prregion_visibility.code = true; 
	prregion_visibility.name = true; 
	prregion_visibility.modified_by = true; 
	prregion_visibility.created_by = true; 
	prregion_visibility.assigned = true; 
	prregion_visibility.erased = true; 
	prregion_visibility.last_update = true; 
	

	$.each(prregion_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

