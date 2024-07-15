/**
*
* @author: N3 S.r.l.
*/

class EventExecutionHistory extends N3Obj{
	constructor(){
		super("1","prismaCore","eventexecutionhistory");
		this.event_id = null;
		this.execution_datetime = null;
		this.config_parameters = null;
		this.stdout = null;
		this.stderr = null;
	}
}


