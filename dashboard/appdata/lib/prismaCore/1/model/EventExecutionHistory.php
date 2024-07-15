<?php
/**
 * Class for EventExecutionHistory
 * 
 * @author: N3 S.r.l.
 */
class EventExecutionHistory extends N3BusinessObject
{
	public $event_id;
	public $execution_datetime;
	public $config_parameters;
	public $stdout=null;
	public $stderr=null;
}
?>
