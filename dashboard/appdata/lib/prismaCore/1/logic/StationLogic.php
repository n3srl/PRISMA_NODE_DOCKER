<?php
/**
*
* @author: N3 S.r.l.
*/

class StationLogic
{
	public static function Save($obj) {
			$Person = CoreLogic::VerifyPerson();
			N3BusinessObject::Init($obj, $Person);
			$res = StationFactory::Save($obj);
			return $res;
	}

	public static function Update($obj) {

		$Person = CoreLogic::VerifyPerson();
		N3BusinessObject::SetModified($obj, $Person);

		return StationFactory::Update($obj);
	}

	public static function Erase($obj) {
			$Person = CoreLogic::VerifyPerson();
			return StationFactory::Erase($obj);
	}

	public static function Delete($obj) {
			$Person = CoreLogic::VerifyPerson();
			return StationFactory::Delete($obj);
	}

	public static function Get($id) {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			return StationFactory::Get($id);
	}	
        
        public static function GetByCode($code) {
			$res = false;
			$Person = CoreLogic::VerifyPerson();
			return StationFactory::GetByCode($code);
	}

	public static function GetList() {
			$Person = CoreLogic::VerifyPerson();
			$ob = StationFactory::GetList();
			return $ob;
        }
        
        public static function GenerateGoogleMapsXMLMarkers()
        {
                            $ob = StationFactory::GetList();
                            
                            $markers = "<markers>";
                            
                            foreach ($ob as $current_staion){
                                
                                switch ($current_staion->active){
                                    case StationState::Operative: 
                                        $color = "blue";
                                        break;
                                    case  StationState::FriponBuying: 
                                        $color = "yellow";
                                         break;
                                    case  StationState::FriponInstallationInProgress: 
                                        $color = "orange";
                                         break;
                                    case  StationState::FriponMaintenance: 
                                        $color = "purple";
                                         break;
                                     case StationState::Inactive: 
                                        $color = "grey";
                                        break;
                                };
                                
                                $markers .= "<marker id = \"$current_staion->id\" name=\"$current_staion->code\" lat=\"$current_staion->latitude\" lng=\"$current_staion->longitude\" color=\"$color\" />";    
                            }
                            
                            $markers .= "</markers>";
                            return $markers;
        }

        public static function GenerateGoogleMapsXMLMarkers2()
        {
                            global $db_conn;
                            $markers = "<markers>";

                            $sQuery = "SELECT `code`, `latitude`, `longitude`, `IPaddress`, `node_version`, `active` FROM pr_node where erased <> 1";
                            $rResultFTotal = mysqli_query($db_conn, $sQuery);
                            foreach ($rResultFTotal as $node_array) {
                                
                                $color = NodeStatus::$description_color[$node_array["active"]];
                                $markers .= '<marker id = "'.$node_array["code"].'" name="'.$node_array["code"].'" lat="'.$node_array["latitude"].'" lng="'.$node_array["longitude"].'" color="'.$color.'" />';   
                            }                            
                            
                            $markers .= "</markers>";

                            return $markers;
        }
                        
        public static function ImportKML($file_path)
        {
            if (file_exists($file_path)) {
                $xml = simplexml_load_file($file_path);
                
                foreach( $xml->children() as $document )
                {
                    foreach( $document->children() as $folder )
                    {
                        if ($folder->getName() == "Folder" )
                        {
                            foreach( $folder->children() as $child )
                            {


                                if ($child->getName() == "name" )
                                {

                                    if ($child == "Camere PRISMA")
                                    {
                                        foreach( $folder->children() as $station )
                                        {
                                             if ($station->getName() == "Placemark" )
                                                {
                                                    $descrizione =  $station->ExtendedData->Data[0]->value;
                                                    $code        =  $station->ExtendedData->Data[1]->value;
                                                    $coordinates =  $station->Point->coordinates->__toString();
                                                    $color       =  $station->styleUrl->__toString();
                                                    
                                                    $Station = StationLogic::GetByCode($code);
                                                    
                                                    $save = false;
                                                    
                                                    if (empty($Station )) {
                                                        $save = true;
                                                        
                                                        $Station = new Station();
                                                        $Station->created_by = 1;
                                                        $Station->modified_by = 1;
                                                        $Station->create_date = date("Y-m-d H:i:s");
                                                        $Station->erased = 0;
                                                        
                                                        //parse station name
                                                        $region_code = substr($code, 2, 2);
                                                        $Region = RegionLogic::GetByCode($region_code);

                                                        $sequence_number = substr($code, 4);

                                                        $Station->region_id = $Region->id;
                                                        $Station->sequence_number  = $sequence_number;
                                                        
                                                        $Station->registration_date = date("Y-m-d H:i:s");
                                                    }
                                                    
                                                        //parse point
                                                        $LatLngAlt = explode(",",$coordinates);
                                                        
                                                        $Station->code = $code;
                                                        $Station->note = $descrizione;
                                                        $Station->latitude = $LatLngAlt[1];
                                                        $Station->longitude= $LatLngAlt[0];
                                                        $Station->altitude = $LatLngAlt[2];
                                                        
                                                        //Fripon Attiva
                                                        if (($color == "#icon-959-DB4436" ))
                                                        {
                                                             $Station->active = StationState::FriponOperative;
                                                        }
                                                        
                                                        if (($color == "#icon-959-7C3592" ) )
                                                        {
                                                             $Station->active = StationState::FriponMaintenance;
                                                        }
                                                        
                                                        if (($color == "#icon-959-F8971B" ) )
                                                        {
                                                             $Station->active = StationState::FriponInstallationInProgress;
                                                        }
                                                        
                                                        if (($color  =="#icon-959-FFDD5E" ))
                                                        {
                                                             $Station->active = StationState::FriponBuying;
                                                        }
                                                        
                                                        if ($save)
                                                           $res &= StationLogic::Save($Station);
                                                        else 
                                                           $res &= StationLogic::Update($Station);
                                                }
                                             }
                                        }
                                    }
                                }
                            }
                        }
                    }

                return true;
            } else {
                echo "file not exists";
                
            }
            
            return false;
        }

        public static function ExportKML()
        {
        
            return false;
        }            
}