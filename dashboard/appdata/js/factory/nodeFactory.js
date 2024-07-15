/**
*
* @author: N3 S.r.l.
*/

class NodeModel extends Node {
  constructor() {
    super();
  }
  get(id = null, ...callBack) {
    if (id !== null) {
      let endpoint = this.endpointBase + "/" + id;
      getAjax(this, endpoint, ...callBack);
    } else {
      let helper = new NodeModel(this.version);
      let obj = this;
      $.each(helper, function (index, value) {
        obj[index] = value;
      });
      callBack.forEach((s) => s.apply());
    }
  }

  getCode(region_id, ...callBack) {
    if (region_id !== null) {
      let endpoint = this.endpointBase + "/stationcode/" + region_id;
      let helper = new NodeModel(this.version);
      let obj = this;
      var f = function () {
        obj.code = helper.code;
        callBack.forEach((s) => s.apply());
      };
      getAjax(helper, endpoint, f);
    }
  }

  getHostname(region_id, ...callBack) {
    if (region_id !== null) {
      let endpoint = this.endpointBase + "/stationhostname/" + region_id;
      let helper = new NodeModel(this.version);
      let obj = this;
      var f = function () {
        obj.hostname = helper.hostname;
        callBack.forEach((s) => s.apply());
      };
      getAjax(helper, endpoint, f);
    }
  }

  insert(...callBack) {
    let endpoint = this.endpointBase + "";
    let obj = this.parseToObj;
    let json = JSON.stringify(obj);
    postAjax(this, endpoint, json, ...callBack);
  }
  update(...callBack) {
    let endpoint = this.endpointBase + "";
    let obj = this.parseToObj;
    let json = JSON.stringify(obj);
    putAjax(this, endpoint, json, ...callBack);
  }

  updateActive(...callBack) {
    let endpoint = this.endpointBase + "/status/update";
    let obj = this.parseToObj;
    let json = JSON.stringify(obj);
    patchAjax(this, endpoint, json, ...callBack);
  }
  erase(id = null, ...callBack) {
    let endpoint = this.endpointBase + "";
    let helper = new NodeModel(this.version);
    helper.endpoint = this.endpoint;
    helper.id = id;
    let obj = helper.parseToObj;
    let json = JSON.stringify(obj);
    patchAjax(this, endpoint, json, ...callBack);
  }
  delete(id = null, ...callBack) {
    let endpoint = this.endpointBase + "";
    let helper = new NodeModel(this.version);
    helper.endpoint = this.endpoint;
    helper.id = id;
    let obj = helper.parseToObj;
    let json = JSON.stringify(obj);
    deleteAjax(this, endpoint, json, ...callBack);
  }
  get parseToObj() {
    let obj = {
      id: this.id,
      code: this.code,
      nickname: this.nickname,
      region_id: this.region_id,
      IPaddress: this.IPaddress,
      refered_to: this.refered_to,
      altitude: this.altitude,
      longitude: this.longitude,
      latitude: this.latitude,
      note: this.note,
      hostname: this.hostname,
      active: this.active,
      nameof_company_association: this.nameof_company_association,
      camera_model: this.camera_model,
      focal_length: this.focal_length,
      node_version: this.node_version,
      erased: this.erased,
      last_update: this.last_update,
      assigned: this.assigned,
      oid: this.oid,
      station_id: this.station_id,
      MAC_address: this.MAC_address,
      CName: this.CName,
      freeture_configuration_file: this.freeture_configuration_file,
      ovpnfile: this.ovpnfile,
      interval_running_DEA: this.interval_running_DEA,
      relative_path: this.relative_path,
    };
    return obj;
  }
  parseJsonToObj(context_, json, ...callBack) {
    let obj_full = JSON.parse(json);
    let obj = obj_full.data;
    let context = context_;
    context.id = obj.id;
    context.code = obj.code;
    context.nickname = obj.nickname;
    context.region_id = obj.region_id;
    context.IPaddress = obj.IPaddress;
    context.refered_to = obj.refered_to;
    context.altitude = obj.altitude;
    context.longitude = obj.longitude;
    context.latitude = obj.latitude;
    context.note = obj.note;
    context.hostname = obj.hostname;
    context.active = obj.active;
    context.nameof_company_association = obj.nameof_company_association;
    context.camera_model = obj.camera_model;
    context.focal_length = obj.focal_length;
    context.node_version = obj.node_version;
    context.erased = obj.erased;
    context.last_update = obj.last_update;
    context.assigned = obj.assigned;

    context.oid = obj.oid;
    context.station_id = obj.station_id;
    context.MAC_address = obj.MAC_address;
    context.CName = obj.CName;
    context.freeture_configuration_file = obj.freeture_configuration_file;
    context.ovpnfile = obj.ovpnfile;
    context.interval_running_DEA = obj.interval_running_DEA;
    context.relative_path = obj.relative_path;
    //callback
    callBack.forEach((s) => s.apply());
  }
}
function setNodeVisibility(){ 

	let prnode_visibility = new Node();

	prnode_visibility.id = true;
	prnode_visibility.code = true;
	prnode_visibility.nickname = true;
	prnode_visibility.region_id = true; 
	prnode_visibility.IPaddress = true; 
	prnode_visibility.refered_to = true; 
	prnode_visibility.altitude = true; 
	prnode_visibility.longitude = true; 
	prnode_visibility.latitude = true; 
	prnode_visibility.note = true; 
	prnode_visibility.hostname = true; 
	prnode_visibility.active = true; 
	prnode_visibility.nameof_company_association = true; 
	prnode_visibility.camera_model = true;
	prnode_visibility.oid = true; 
	prnode_visibility.station_id = true; 
	prnode_visibility.MAC_address = true; 
	prnode_visibility.CName = true; 
	prnode_visibility.freeture_configuration_file = true; 
	prnode_visibility.ovpnfile = true; 
	prnode_visibility.interval_running_DEA = true; 
	prnode_visibility.relative_path = true; 
	prnode_visibility.modified_by = true; 
	prnode_visibility.created_by = true; 
	prnode_visibility.assigned = true; 
	prnode_visibility.erased = true; 
	prnode_visibility.last_update = true; 


	$.each(prnode_visibility, function(key, value){
		if (!value)
			$("." +$.md5(key)).hide();
	});

}

