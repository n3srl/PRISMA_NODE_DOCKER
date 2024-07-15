/**
*
* @author: N3 S.r.l.
*/

class Detection extends N3Obj{
	constructor(){
		super("1","prismaCore","detection");
		this.node_id = null;
		this.event_id = null;
		this.inserted_timestamp = null;
		this.detected_timestamp = null;
		this.is_fake = null;
                this.GeMapImg = "";
                this.DirMapImg = "";
                this.EventImg = "";
	}
}


