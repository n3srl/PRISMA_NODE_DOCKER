/**
*
* @author: N3 S.r.l.
*/

class Node extends N3Obj{
	constructor(){
		super("1","prismaCore","node");
		this.id = null;
		this.code = null;
		this.nickname = null;
		this.region_id = null;
		this.sequence_number = null;
		this.altitude = null;
		this.longitude = null;
		this.latitude = null;
		this.note = null;
		this.IPaddress = null;
		this.MAC_address = null;
		this.hostname = null;
		this.active = null;
		this.refered_to = null;
		this.nameof_company_association = null;
		this.camera_model = null;
		this.focal_length = null;
		this.node_version = null;
		this.address=null;
		this.postcode=null;
		this.city=null;
		this.province=null;
		this.country=null;
		this.erased = null;
		this.last_update = null;
		
		//this.CName = null;
		//this.freeture_configuration_file = null;
		//this.ovpnfile = null;
		//this.interval_running_DEA = null;
		//this.relative_path = null;
	}
}


