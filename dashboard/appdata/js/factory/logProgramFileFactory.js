/**
*
* @author: N3 S.r.l.
*/

class LogProgramFileModel extends LogProgramFile {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new LogProgramFileModel(this.version);
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
		let helper = new LogProgramFileModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new LogProgramFileModel(this.version);
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
			timestamp: this.timestamp,
			type: this.type,
			level: this.level,
			text: this.text,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.timestamp = obj.timestamp;
		context.type = obj.type;
		context.level = obj.level;
		context.text = obj.text;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setLogProgramFileVisibility(){ 

	let prlogprogramfile_visibility = new LogProgramFile(); 

	prlogprogramfile_visibility.id = true; 
	prlogprogramfile_visibility.oid = true; 
	prlogprogramfile_visibility.timestamp = true; 
	prlogprogramfile_visibility.type = true; 
	prlogprogramfile_visibility.level = true; 
	prlogprogramfile_visibility.text = true; 
	prlogprogramfile_visibility.modified_by = true; 
	prlogprogramfile_visibility.created_by = true; 
	prlogprogramfile_visibility.assigned = true; 
	prlogprogramfile_visibility.erased = true; 
	prlogprogramfile_visibility.last_update = true; 
	

	$.each(prlogprogramfile_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

