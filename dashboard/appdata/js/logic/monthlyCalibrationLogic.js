/**
*
* @author: N3 S.r.l.
*/

let monthlycalibratioLogic = {
	save: function(obj, ...callBack){
		saveClass(obj, ...callBack);
	},
	get: function(obj, id, ...callBack){
		getClass(obj, id, ...callBack);
	},
	remove: function(obj, id, safeDelete, ...callBack){
		removeClass(obj,id, safeDelete, ...callBack);
	},
    updateDefaultCalibration(obj, ...callback ){
        updateDefCal(obj, ...callback);
    }
};

