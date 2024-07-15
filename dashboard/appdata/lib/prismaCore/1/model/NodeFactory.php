<?php

use Symfony\Component\Routing\Loader\ObjectRouteLoader;

/**
 * Class for NodeFactory
 * 
 * @author: N3 S.r.l.
 */
class NodeFactory extends NodeFactoryBase
{
	public static function CheckData($object, $clean = true)
	{
		if ($object->longitude == '') {
			$object->longitude = 0;
		}

		if ($object->latitude == '') {
			$object->latitude = 0;
		}

		if ($object->refered_to == '') {
			$object->refered_to = 'null';
		}
		// $errors = array();
		// $parse_error = false;

		// $tmp = $object->nickname;
		// $quote = "'";
		// if (empty($tmp)) {
		// 	$errors[] = _('station name obbligatorio');
		// 	$parse_error = true;
		// }
		// if ($object->altitude == '') {
		// 	$errors[] = _('altitude obbligatorio');
		// 	$parse_error = true;
		// }
		// if ($object->longitude == '') {
		// 	$errors[] = _('longitudine obbligatorio');
		// 	$parse_error = true;
		// }
		// if (!is_float($object->longitude) && $object->longitude != null &&  $object->longitude != '' && $object->longitude != 'null') {
		// 	$errors[] = _('longitudine non decimale');
		// 	$parse_error = true;
		// }
		// if ($object->latitude == '') {
		// 	$errors[] = _('latitude obbligatorio');
		// 	$parse_error = true;
		// }
		// if (!is_float($object->latitude) && $object->latitude != null &&  $object->latitude != '' && $object->latitude != 'null') {
		// 	$errors[] = _('latitude non decimale');
		// 	$parse_error = true;
		// }

		// $tmp = $object->IPaddress;
		// $quote = "'";
		// if(!filter_var('"' . $object->IPaddress . '"', FILTER_VALIDATE_IP)){
		// 	$errors[] = _('	IPaddress non valido');
		// 	$parse_error = true;
		// }

		// if (empty($object->IPaddress)) {
		// 	$errors[] = _('IPaddress obbligatorio');
		// 	$parse_error = true;
		// }
		if ($object->active == '') {
			$errors[] = _('active obbligatorio');
			$parse_error = true;
		}
		/*if (!is_numeric($object->active) && $object->active != null && $object->active != '' && $object->active != 'null') {
			$errors[] = _('active non numerico');
			$parse_error = true;
		}*/
		
		/* if (empty($object->hostname)){
			$errors[] = _('hostname obbligatorio');
			$parse_error = true;
		} */
		
		if(empty($object->nickname)){
			$errors[] = _('station name obbligatorio');
			$parse_error = true;
		}
		// if ($object->modified_by == '') {
		// 	$errors[] = _('modified_by obbligatorio');
		// 	$parse_error = true;
		// }
		// if (!is_numeric($object->modified_by) && $object->modified_by != null && $object->modified_by != '' && $object->modified_by != 'null') {
		// 	$errors[] = _('modified_by non numerico');
		// 	$parse_error = true;
		// }
		// if ($object->created_by == '') {
		// 	$errors[] = _('created_by obbligatorio');
		// 	$parse_error = true;
		// }
		// if (!is_numeric($object->created_by) && $object->created_by != null && $object->created_by != '' && $object->created_by != 'null') {
		// 	$errors[] = _('created_by non numerico');
		// 	$parse_error = true;
		// }
		// if ($object->assigned == '') {
		// 	$errors[] = _('assigned obbligatorio');
		// 	$parse_error = true;
		// }
		// if (!is_numeric($object->assigned) && $object->assigned != null && $object->assigned != '' && $object->assigned != 'null') {
		// 	$errors[] = _('assigned non numerico');
		// 	$parse_error = true;
		// }
		// // if ($object->refered_to == '') {
		// // 	$errors[] = _('refered_to obbligatorio');
		// // 	$parse_error = true;
		// // }
		// if (!is_numeric($object->refered_to) && $object->refered_to != null && $object->refered_to != '' && $object->refered_to != 'null') {
		// 	$errors[] = _('refered_to non numerico');
		// 	$parse_error = true;
		// }
		// if ($object->erased == '') {
		// 	$errors[] = _('erased obbligatorio');
		// 	$parse_error = true;
		// }
		// if (($object->erased === true && $object->erased != null) || $object->erased == 'true' || $object->erased == '1') {
		// 	$object->erased = 1;
		// } else {
		// 	$object->erased = 0;
		// }
		// if (!is_numeric($object->erased) && $object->erased != null && $object->erased != '' && $object->erased != 'null') {
		// 	$errors[] = _('erased non numerico');
		// 	$parse_error = true;
		// }
		if ($parse_error) {
			$errors[] = ApiLogic::getFieldErrorCode();
			throw new ApiException(ApiException::$FieldException, $errors);
		}
	}

	public static function CreateSolutionFile()
	{
		$data = self::GetNodesCode();
		$result = "";
		$separator = "-----------------------------------------\n";
		$result .= $separator;
		$result .= sprintf("%11s%30s\n", "camera", "pseudo");
		$result .= $separator;

		foreach ($data as $node) {
			$result .= sprintf("%11s%30s\n", $node['code'], $node['nickname']);
		}

		$fileName = "solutions.ini";
		$filePath = _WEBROOTDIR_ . "tmp-media/" . $fileName;
		$file = fopen($filePath, "w") or die("Unable to open file!");
		fwrite($file, $result);
		fclose($file);

		return $filePath;
	}

	public static function CreateFreetureConfigurationFile($id)
	{
		$node = NodeFactory::Get($id);
		if(!$node) return false;

	try {
		$fileName = "configuration.cfg";
		$filePath = _WEBROOTDIR_ . __TMP_CONFIG__ . $fileName;
		$file = fopen($filePath, "w") or die("Unable to open file!");

		$filecontent = NodeFactory::GetConfigurationFileContent($node);

		fwrite($file, $filecontent);
		fclose($file);
		return true;
	} catch (Exception $e)
	{
		return false;
	}
	}

	public static function GetNodeConfiguration($id)
	{
		return NodeFactory::CreateFreetureConfigurationFile($id);
	}

	public static function GetNodeConfigurationZipped($id)
	{
		try 
		{
			
			$node = NodeFactory::Get($id);
		// Move certificate
		// Create Zip
			$zip = new ZipArchive();
			$file = _WEBROOTDIR_ . __TMP_CONFIG__ . $node->code."_".$node->nickname."_PRISMA_NODE_Configuration.zip";
			
			if($zip->open($file, ZipArchive::CREATE))
			{
				
				$zip->addFile(_WEBROOTDIR_.__VPN_CERTIFICATE_PATH__.$node->code.".ovpn",$node->code.".ovpn");
				$zip->addFile(_WEBROOTDIR_.__TMP_CONFIG__.__FREETURE_CFG_FILE__,__FREETURE_CFG_FILE__);
				$zip->close();
			} 
			
		} catch(Exception $e)
		{
			echo "Error";
		}
		
		return $file;
	}

	public static function GetNodesCode()
	{
		global $db_conn;
		$object_list = array();
		$where = " WHERE erased = 0 ";
		$query = "SELECT code, nickname FROM pr_node $where";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();

		while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC)) {
			$object_list[] = $row;
		}
		return $object_list;
	}

	public static function GetRegionFK($table, $column = 'id', $code, $where = '')
	{
		global $db_conn;
		$object_list = array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT distinct " . $column . ", name FROM $table $where_ and name LIKE '%" . $code . "%'; ";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}

	public static function GetPersonFK($table, $column = 'id', $code, $where = '')
	{
		//echo "GET PERSON FK: ". $table ." -> ";
		global $db_conn;
		$object_list = array();
		$where_ = "WHERE erased = 0";
		if ($where != '') {
			$where_ .= ' AND ' . $where;
		}
		$query = "SELECT distinct " . $column . ", last_name, first_name FROM $table $where_ and last_name LIKE '%" . $code . "%'; ";
		//echo $query;
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return array();
		while ($row = mysqli_fetch_object($res)) {
			$object_list[] = $row;
		}
		return $object_list;
	}


	public static function GetRegionCode($region_id, $where = '')
	{
		global $db_conn;
		$object_list = array();
		$where_ = "WHERE erased = 0 and id =" . $region_id;
		if ($where != '') {
			$where_ = ' AND ' . $where;
		}
		$query = "SELECT state, code FROM pr_region $where_";
		$res = mysqli_query($db_conn, $query);

		if (!$res || mysqli_num_rows($res) <= 0)
			return array();

		while ($row = mysqli_fetch_object($res)) {
			$object = $row;
		}
		return $object;
	}

	public static function GetContactName($person_id, $where = '')
	{
		global $db_conn;
		$where_ = "WHERE erased = 0 AND id =" . $person_id;
		if ($where != '') {
			$where_ = ' AND ' . $where;
		}

		$query = "SELECT first_name, last_name FROM core_person $where_";
		$res = mysqli_query($db_conn, $query);
		if (!$res || mysqli_num_rows($res) <= 0)
			return false;

		$object = new stdClass();
		while ($row = mysqli_fetch_object($res)) {
			$object->name = $row->first_name . " " . $row->last_name;
			$object->id = $person_id;
		}
		return $object;
	}

	public static function GetNodeStatus()
	{
		$status = new NodeStatus();
		$obj = array();
		foreach ($status->descriptions as $key => $value) {
			$object = new stdClass();
			$object->id = (string)$key;
			$object->text = $value;
			$obj[] = $object;
		}
		return $obj;
	}

	// public static function SetSequenceNumber($object)
	// {
	// 	$sequence_number = NodeFactory::GetLastSequenceNumber($object->region_id) + 1;
	// 	$object->sequence_number = $sequence_number;
	// 	return $object->sequence_number + 1;
	// }

	public static function SetSequenceNumber($region_id)
	{
		$sequence_number = NodeFactory::GetLastSequenceNumber($region_id) + 1;
		return sprintf("%'.02d", $sequence_number);
	}

	public static function GetLastSequenceNumber($region_id)
	{
		global $db_conn;
		$query = "SELECT MAX(CAST(sequence_number AS unsigned INT)) AS max_sequence_number FROM pr_node WHERE region_id=" . $region_id;
		$res = @mysqli_query($db_conn, $query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);
		$sequence_number = $object->max_sequence_number;

		return $sequence_number;
	}

	public static function CheckRow($id)
	{
		global $db_conn;
		$query = "SELECT region_id FROM pr_node WHERE id=" . $id;
		$res = @mysqli_query($db_conn, $query);
		if ($res === false || mysqli_num_rows($res) <= 0)
			return false;
		$object = mysqli_fetch_object($res);

		$region_id = $object->region_id;
		return $region_id;
	}

	public static function UpdateNodeStatus($obj)
	{
		global $db_conn;


		
		// NodeFactory::CheckData($obj);
		// NodeFactoryBase::cleanData($obj);
		//$query = "UPDATE pr_node SET `station_id` = $object->station_id,`MAC_address` =$object->MAC_address,`hostname` =$object->hostname,`CName` =$object->CName,`freeture_configuration_file` =$object->freeture_configuration_file,`ovpnfile` =$object->ovpnfile,`interval_running_DEA` = $object->interval_running_DEA,`relative_path` =$object->relative_path,`modified_by` = $object->modified_by,`assigned` = $object->assigned,`erased` = $object->erased,`last_update`=now() WHERE id=" . $object->id;
		$query = "UPDATE pr_node 
				SET 
				`active` =$obj->active,`modified_by` =$obj->modified_by,
				`last_update`=now()
				 WHERE id=" . $obj->id;


		$res = mysqli_query($db_conn, $query);
		if ($res === false) return false;
		else return true;
	}

	public static function GetConfigurationFileContent($node)
	{
		switch($node->cnamera_model)
		{
			case "PHX016S-MS":
				$node = new PHX016SNode($node);
				break;
			case "BASLER1300gm":
				$node = new BASLER1300gmNode($node);
				break;
			default:
				$node = new PHX016SNode($node);
				break;
		}
		
		$code = $node->get("code");
		$siteelev = $node->get("altitude");
		$sitelat = $node->get("latitude");
		$sitelon = $node->get("longitude");
		$station_name = $node->get("nickname");
		$observer = "Osservatore";
		$camera = $node->get("camera_model");
		$focal_length = $node->get("focal_length");
		$acqregular = $node->ACQ_REGULAR_CFG;
		$acqschedule = $node->ACQ_SCHEDULE;

		$filecontent = "
		#################################################################################
########################## FreeTure Configuration file v1.2.0 #####################
#################################################################################

# This configuration file is mainly used by FreeTure in mode 3. 
# Use '-c' option to indicates the configuration file location to FreeTure.
# Example : freeture -m 3 -c configuration.cfg

#################################################################################
#------------------------------- DEVICE IN INPUT --------------------------------
#################################################################################

# Identification number of the camera to use. 
# Use 'freeture -l' command to list available devices.
# <Camera Index value> | <VIDEOFILE> | <FRAMESDIR>
CAMERA_ID = 0


# List of videos to analyse.
# Use ',' separator between paths.
INPUT_VIDEO_PATH = /freeture/

# List of frames directory (in fits).
# Use ',' separator between paths.
INPUT_FRAMES_DIRECTORY_PATH = /freeture/

# Time (in ms) between two fits loading or two video frames.
# Used if the input is a video or a frames directory to give more 
# time for the detection process to analyse frames.
INPUT_TIME_INTERVAL = 500

#################################################################################
#---------------------------- ACQUISITION PARAMETERS ----------------------------
#################################################################################

# Camera's acquisition frequency. 
ACQ_FPS = 60

# Camera's acquisition format. 
# Use '--listformats' option with a '-d deviceIndex' to see available pixel formats.
# <MONO8>(Index 0) | <MONO12> (Index 1) | <YUYV> (index 4) etc...
ACQ_FORMAT = MONO12

# Use custom camera resolution.
ACQ_RES_CUSTOM_SIZE = false

# Specify camera x,y offset.
# Format : (x),(y). Ex. '150,100'
ACQ_OFFSET = 0,0

# Specify camera resolution.
# Format : (width)x(height). Ex. '640x480'
ACQ_RES_SIZE = 1440x1080

# DMK Gige Cameras use last 12 bits in MONO12.
# This parameter shifts bits in order to use the first 12 bits.
SHIFT_BITS = false

# Enable to use a mask.
ACQ_MASK_ENABLED = false

# Location of the mask.
ACQ_MASK_PATH = /freeture/$code/default.bmp

# Size of the frame buffer (in seconds).
ACQ_BUFFER_SIZE = 30

# Fix exposure time during the night (us)  		
ACQ_NIGHT_EXPOSURE = $node->exp_night

# Fix gain during the night.
ACQ_NIGHT_GAIN = $node->gain_night

#--------------------------------------------------------------------------------
#---------------------------- DAYTIME ACQUISITION -------------------------------
#--------------------------------------------------------------------------------

# Fix exposure time during daytime (us). 
#(Applied from end of sunrise until start of sunset)
ACQ_DAY_EXPOSURE = $node->exp_day

# Fix gain during daytime. 
#(Applied from end of sunrise until start of sunset)
ACQ_DAY_GAIN = $node->gain_day

# Enable auto computation of sun ephemeris. 
EPHEMERIS_ENABLED = true

# Sun horizon height (in degree) where it's the start of sunrise and the end of sunset.
SUN_HORIZON_1 = -12

# Sun horizon height (in degree) where it's the end of sunrise and the start of sunset.
SUN_HORIZON_2 = -1

# Start of sunrise (UT) if EPHEMERIS_ENABLED is disabled.
SUNRISE_TIME = 13:39

# Start of sunset (UT) if EPHEMERIS_ENABLED is disabled.
SUNSET_TIME = 21:00

# Duration of the sunset if EPHEMERIS_ENABLED is disabled.
SUNSET_DURATION = 300

# Duration of the sunrise if EPHEMERIS_ENABLED is disabled.
SUNRISE_DURATION = 3600

# Time interval (seconds) between two exposure control.
EXPOSURE_CONTROL_FREQUENCY = 120

# Enable to save final image with auto exposure control.
EXPOSURE_CONTROL_SAVE_IMAGE = false

# Enable to save informations in a .txt file about auto exposure control process.
EXPOSURE_CONTROL_SAVE_INFOS = true

#--------------------------------------------------------------------------------
#---------------------------- REGULAR CAPTURES ----------------------------------
#--------------------------------------------------------------------------------

# Enable regular single capture.If enabled, ACQ_SCHEDULE_ENABLED has to be disabled.
ACQ_REGULAR_ENABLED = true

# Possible values : <DAY> | <NIGHT> | <DAYNIGHT> 
# <DAY> (Images are only regularly captured from start of dawn until end of twilight)
# <NIGHT> (Images are only regularly captured from end of twilight until start of dawn )
# <DAYNIGHT> (Images are always regularly captured)
ACQ_REGULAR_MODE = DAYNIGHT

# Specify the time interval of captures, exposure time, gain, format.
# Format is : .h.m.s.e.g.f.n where '.' is a number)
# (h/m/s = time interval, e = exposure, g = gain, f = format, n =repetition)
ACQ_REGULAR_CFG = $acqregular

# Captured image prefix
ACQ_REGULAR_PRFX = $code

# Captured image format. 
# <JPEG> | <FITS>
ACQ_REGULAR_OUTPUT = FITS

#--------------------------------------------------------------------------------
#---------------------------- SCHEDULED CAPTURES --------------------------------
#--------------------------------------------------------------------------------

# Enable scheduled acquisition.If enabled, ACQ_REGULAR_ENABLED has to be disabled.
ACQ_SCHEDULE_ENABLED = false

# Schedule (UT).(Format is : .h.m.s.e.g.f.n where '.' is a number)
# (e = exposure, g = gain, f = format index, n =repetition)
ACQ_SCHEDULE = $acqschedule


# Captured image format. 
# <JPEG> | <FITS>
ACQ_SCHEDULE_OUTPUT = FITS

#################################################################################
#--------------------------- DETECTION PARAMETERS -------------------------------
#################################################################################


# Enable detection process.
DET_ENABLED = true	

# Detection mode.
# <DAY> | <NIGHT> | <DAYNIGHT>
DET_MODE = NIGHT

# Enable debug of the detection process.
# (used for fits frames or video in input)
DET_DEBUG = false

# Location of debug data.
DET_DEBUG_PATH =  /freeture/$code/debug/

# Time to keep before and after an event (seconds).
DET_TIME_AROUND = 5

# Maximum duration of an event.
# Available range : 1 to 30 seconds.
DET_TIME_MAX = 20

# Choose a detection method.
DET_METHOD = TEMPORAL_MTHD

# Save fits3D in output.
DET_SAVE_FITS3D = false		

# Save fits2D in output.
DET_SAVE_FITS2D = true

# Stack the event's frames.
DET_SAVE_SUM = true

# Reduce sum to 16 bits file.
DET_SUM_REDUCTION = true

# Sum reduction method.
DET_SUM_MTHD = SUM

# Enable histogram equalization on DET_SUM_MTHD
DET_SAVE_SUM_WITH_HIST_EQUALIZATION = true

# Save a film .avi in output.
DET_SAVE_AVI = true	

# Enable auto-masking.
DET_UPDATE_MASK = true

# Frequency of auto-masking evaluation. (In seconds)
DET_UPDATE_MASK_FREQUENCY = 30

# Enable to debug auto-masking process.
DET_DEBUG_UPDATE_MASK = false

#--------------------------------------------------------------------------------
#--------------------------------- TEMPORAL METHOD ------------------------------
#--------------------------------------------------------------------------------

# Enable to downsample (/2) frames.	
# Can be set to false for resolution under 640x480. To true otherwise.
DET_DOWNSAMPLE_ENABLED = true

# Save map of the global event.
DET_SAVE_GEMAP = true 

# Save direction map of an event.
DET_SAVE_DIRMAP = true 

# Save in a .txt file the approximate position x,y of the event.
DET_SAVE_POS = true	

# Maximum local event to extract on a single frame.
DET_LE_MAX = 10

# Maximum number of global event to track over time.
DET_GE_MAX = 10

#################################################################################
#------------------------------- STACK PARAMETERS -------------------------------
#################################################################################

# Enable to stack frames. 
STACK_ENABLED = true	

# Stack mode.
# <DAY> | <NIGHT> | <DAYNIGHT>	
STACK_MODE = DAYNIGHT

# Integration time of the stack (seconds).
STACK_TIME = 60

# Time to wait before to start a new stack.     
STACK_INTERVAL = 0    

# Stack method.
# <MEAN> | <SUM>
STACK_MTHD = SUM

# Allowed dynamic reduction (Save in 16 bits instead of 32 bits)
STACK_REDUCTION = true

#################################################################################
#----------------------------- GENERAL PARAMETERS -------------------------------
#################################################################################

# Path where to save data.
DATA_PATH = /freeture/$code/

# Path of logs files.
LOG_PATH = /freeture/$code/log/

# Time to keep archive.
LOG_ARCHIVE_DAY = 120

# Limit size of logs on the hard disk (mo)
LOG_SIZE_LIMIT = 500

# Level of messages to save in log files.
# <normal> | <notification> | <fail> | <warning> | <critical>
LOG_SEVERITY = notification

# Enable compression (Experimental. Original fitskeys will be lost)
# https://heasarc.gsfc.nasa.gov/docs/software/fitsio/c/c_user/node41.html
FITS_COMPRESSION = false

# Specify cfitsio compression method by enclosing its parameters in square brackets.
# [compress] 
# [compress GZIP] 
# [compress PLIO] 
# [compress HCOMP] 
FITS_COMPRESSION_METHOD = [compress]

#--------------------------------------------------------------------------------
#---------------------------- STATION INFORMATIONS  -----------------------------
#--------------------------------------------------------------------------------

# Name of the station.
STATION_NAME = $station_name
	
# Station name.
TELESCOP = $code

# Person in charge.
OBSERVER = $observer

# Instrument name.
INSTRUME = PRISMA CAMERA

# Camera model name.
CAMERA = $camera

# Camera focal.
FOCAL = $focal_length

# Camera aperture.
APERTURE = 2.0

# Longitude observatory.
SITELONG = $sitelon

# Latitude observatory.
SITELAT = $sitelat

# Elevation observatory.
SITEELEV = $siteelev

#--------------------------------------------------------------------------------
#--------------------------------- FITS KEYWORDS --------------------------------
#--------------------------------------------------------------------------------

FILTER 		= NONE			
K1 		= 0.0 			#R = K1 * f * sin(theta/K2)
K2 		= 0.0
COMMENT		= comments
CD1_1 		= 0.17	        #deg/pix
CD1_2		= 0.0       	#deg/pix
CD2_1 		= 0.0        	#deg/pix
CD2_2		= -0.17        	#deg/pix
XPIXEL 		= 3.45			#physical's size of a pixel in micro meter
YPIXEL 		= 3.45

#--------------------------------------------------------------------------------
#----------------------------- MAIL CONFIGURATION -------------------------------
#--------------------------------------------------------------------------------

# Allow mail notifications.
MAIL_DETECTION_ENABLED = false

# SMTP server to send mail.
MAIL_SMTP_SERVER = 10.8.0.1

# Enable or disable SMTP server authentification.
# <NO_SECURITY> | <USE_SSL>
MAIL_CONNECTION_TYPE = NO_SECURITY

# SMTP server user.
MAIL_SMTP_LOGIN = 

# Password encoded in base64 (https://www.base64encode.org/). BE CAREFULL, THIS IS NOT WELL SECURED !
MAIL_SMTP_PASSWORD = 

# Recipients of mail notifications. Use ',' as separators between mail adress.
MAIL_RECIPIENT = prisma_po@inaf.it
		";
	return $filecontent;
	}
}
