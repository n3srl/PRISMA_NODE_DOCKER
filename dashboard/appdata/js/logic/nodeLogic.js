/**
*
* @author: N3 S.r.l.
*/

let nodeLogic = {
	save: function(obj, ...callBack){
		saveClass(obj, ...callBack);
	},
	get: function(obj, id, ...callBack){
		getClass(obj, id, ...callBack);
	},
	remove: function(obj, id, safeDelete, ...callBack){
		removeClass(obj,id, safeDelete, ...callBack);
	},
	getCode: function(obj, region_id, ...callBack){
		getGeneratedCode(obj, region_id, ...callBack);
	},
	getHostname: function(obj, region_id, ...callBack){
		getGeneratedHostname(obj, region_id, ...callBack);
	},
	updateNodeStatus: function(obj, ...callBack){
		updateActiveStatus(obj, ...callBack);
	}
};

