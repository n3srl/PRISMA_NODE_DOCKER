/**
*
* @author: N3 S.r.l.
*/

class SystemConfigurationModel extends SystemConfiguration {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new SystemConfigurationModel(this.version);
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
		let helper = new SystemConfigurationModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new SystemConfigurationModel(this.version);
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
			parameter_name: this.parameter_name,
			parameter_value: this.parameter_value,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.parameter_name = obj.parameter_name;
		context.parameter_value = obj.parameter_value;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setSystemConfigurationVisibility(){ 

	let prsystemconfiguration_visibility = new SystemConfiguration(); 

	prsystemconfiguration_visibility.id = true; 
	prsystemconfiguration_visibility.oid = true; 
	prsystemconfiguration_visibility.parameter_name = true; 
	prsystemconfiguration_visibility.parameter_value = true; 
	prsystemconfiguration_visibility.modified_by = true; 
	prsystemconfiguration_visibility.created_by = true; 
	prsystemconfiguration_visibility.assigned = true; 
	prsystemconfiguration_visibility.erased = true; 
	prsystemconfiguration_visibility.last_update = true; 
	

	$.each(prsystemconfiguration_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

