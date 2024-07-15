/**
*
* @author: N3 S.r.l.
*/

class CalibrationExecutionHistory extends N3Obj{
	constructor(){
		super("1","prismaCore","calibrationexecutionhistory");
		this.camera_id = null;
		this.date = null;
		this.execution_datetime = null;
		this.monthly_or_daily = null;
		this.config_parameters = null;
		this.stdout = null;
		this.stderr = null;
	}
}


