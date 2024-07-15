/**
*
* @author: N3 S.r.l.
*/

class MonthlyCalibrationModel extends MonthlyCalibration {
	constructor(){
		super();
	}
	get(id = null,...callBack){
		if (id !== null){
			let endpoint = this.endpointBase + '/'+id;
			getAjax(this,endpoint,...callBack);
		}else{
			let helper = new MonthlyCalibrationModel(this.version);
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

    updateDefaultCalibration(...callBack){
        let endpoint = this.endpointBase + '/defaultcalibration/set';
		let obj = this.parseToObj;
		console.log(this);
		let json = JSON.stringify(obj);
		patchAjax(this, endpoint, json, ...callBack);
    }

	erase(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new MonthlyCalibrationModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		patchAjax(this,endpoint,json,...callBack);
	}
	delete(id = null, ...callBack){
		let endpoint = this.endpointBase + '';
		let helper = new MonthlyCalibrationModel(this.version);
		helper.endpoint = this.endpoint;
		helper.id = id;
		let obj = helper.parseToObj;
		let json = JSON.stringify(obj);
		deleteAjax(this,endpoint,json,...callBack);
	}
	get parseToObj(){
		let obj = {
            name: this.name,
            date: this.date,
            //default_calibration: this.default_calibration
		};
		return obj;
	}
	parseJsonToObj(context_,json,...callBack){
		let obj_full = JSON.parse(json);
		let obj = obj_full.data;
		let context = context_;
        context.name = obj.name;
        context.date = obj.date;
        //context.default_calibration = obj.default_calibration;
		//callback
		callBack.forEach(s => s.apply());
	}
}
function setMonthlyCalibrationVisibility(){ 

	let prmonthlycalibration_visibility = new MonthlyCalibration(); 


	

	$.each(prmonthlycalibration_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});
}

