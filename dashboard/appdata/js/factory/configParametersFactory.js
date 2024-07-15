/**
*
* @author: N3 S.r.l.
*/

class ConfigParametersModel extends ConfigParameters {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new ConfigParametersModel(this.version);
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
		let helper = new ConfigParametersModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new ConfigParametersModel(this.version);
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
			general_quiet: this.general_quiet,
			general_on_error: this.general_on_error,
			general_except: this.general_except,
			image_report_photo: this.image_report_photo,
			daily_report_astro: this.daily_report_astro,
			daily_histo: this.daily_histo,
			monthly_report_astro: this.monthly_report_astro,
			monthly_histo: this.monthly_histo,
			event_fill_frames: this.event_fill_frames,
			event_recenter: this.event_recenter,
			event_box_bolide: this.event_box_bolide,
			event_model_psf: this.event_model_psf,
			event_model_bar: this.event_model_bar,
			event_report: this.event_report,
			event_image: this.event_image,
			event_video: this.event_video,
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
		context.id = obj.id;
		context.oid = obj.oid;
		context.general_quiet = obj.general_quiet;
		context.general_on_error = obj.general_on_error;
		context.general_except = obj.general_except;
		context.image_report_photo = obj.image_report_photo;
		context.daily_report_astro = obj.daily_report_astro;
		context.daily_histo = obj.daily_histo;
		context.monthly_report_astro = obj.monthly_report_astro;
		context.monthly_histo = obj.monthly_histo;
		context.event_fill_frames = obj.event_fill_frames;
		context.event_recenter = obj.event_recenter;
		context.event_box_bolide = obj.event_box_bolide;
		context.event_model_psf = obj.event_model_psf;
		context.event_model_bar = obj.event_model_bar;
		context.event_report = obj.event_report;
		context.event_image = obj.event_image;
		context.event_video = obj.event_video;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setConfigParametersVisibility(){ 

	let prconfigparameters_visibility = new ConfigParameters(); 

	prconfigparameters_visibility.id = true; 
	prconfigparameters_visibility.oid = true; 
	prconfigparameters_visibility.general_quiet = true; 
	prconfigparameters_visibility.general_on_error = true; 
	prconfigparameters_visibility.general_except = true; 
	prconfigparameters_visibility.image_report_photo = true; 
	prconfigparameters_visibility.daily_report_astro = true; 
	prconfigparameters_visibility.daily_histo = true; 
	prconfigparameters_visibility.monthly_report_astro = true; 
	prconfigparameters_visibility.monthly_histo = true; 
	prconfigparameters_visibility.event_fill_frames = true; 
	prconfigparameters_visibility.event_recenter = true; 
	prconfigparameters_visibility.event_box_bolide = true; 
	prconfigparameters_visibility.event_model_psf = true; 
	prconfigparameters_visibility.event_model_bar = true; 
	prconfigparameters_visibility.event_report = true; 
	prconfigparameters_visibility.event_image = true; 
	prconfigparameters_visibility.event_video = true; 
	prconfigparameters_visibility.modified_by = true; 
	prconfigparameters_visibility.created_by = true; 
	prconfigparameters_visibility.assigned = true; 
	prconfigparameters_visibility.erased = true; 
	prconfigparameters_visibility.last_update = true; 
	

	$.each(prconfigparameters_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

