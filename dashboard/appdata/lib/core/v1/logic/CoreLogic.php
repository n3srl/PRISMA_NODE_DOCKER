<?php

class CoreLogic {

    public static function CheckSession() {
        if (isset($_SESSION["person_id"])) {
            return true;
        }
        return false;
    }

    public static function SetSession($person_id) {
        $_SESSION["person_id"] = $person_id;
    }

    public static function GetPersonLogged() {
        $person = null;
        if (isset($_SESSION["person_id"])) {
            
            if($_SESSION["person_id"] == _NOTLOGGEDUSERSESSIONID_){
                return true;
            }
            $person_id = $_SESSION["person_id"];
            $person = PersonFactory::Get($person_id);
            $GroupHasPerson = GroupHasPersonFactory::GetByPerson($person_id);
            $Group = GroupFactory::Get($GroupHasPerson->group_id);
            $person->group_id =$GroupHasPerson->group_id;
            $person->group = $Group; 
        }
        return $person;
    }
    public static function isPersonPublic() {
        if (isset($_SESSION["person_id"])) {
            if($_SESSION["person_id"] == _NOTLOGGEDUSERSESSIONID_){
                return true;
            }
        }
        return false;
    }
    public static function GetGroupPersonLogged() {
        $Person = CoreLogic::GetPersonLogged();
        $Group = null;
        if(!empty($Person)){

            $Group = GroupHasPersonLogic::GetByPerson($Person->id);

        }
        return $Group;
    }

    public static function VerifyPermission() {
        //TODO
        return null;
    }
    
    /**
     * 
     * @param type $verifyPermission
     * @return Person
     * @throws ApiException
     */
    public static function VerifyPerson($verifyPermission = false) {
        $Person = self::GetPersonLogged();
        if ($verifyPermission) {
            /* Metodo pensato per introdurre anche le parti di licenza della person */
            self::VerifyPermission();
        }
        
        if (empty($Person)) {
            throw new ApiException(ApiException::$PersonException);
        }

        return $Person;
    }

    public static function Logout() {

        if (isset($_SESSION["person_id"])) {
            unset($_SESSION["person_id"]);
            session_destroy();
        }

        return self::GenerateResponse(true);
    }

    public static function GenerateCSRF() {
        try {

            $Person = CoreLogic::VerifyPerson();
            $token = bin2hex(openssl_random_pseudo_bytes(16));
            $_SESSION["token"][] = $token;
            $dataObj = new stdClass();
            $dataObj->token = $token;
            $data = $dataObj;
            return self::GenerateResponse(true, $data);
        } catch (PersonException $p) {
            return CoreLogic::GenerateErrorResponse($p->message);
        }
    }

    public static function CheckCSRF($csfr) {
        $result = false;
        if (isset($_SESSION["token"])) {
            $pos = array_search($csfr, $_SESSION["token"]);

            if ($pos !== false) {
                $result = true;
            }
        }

        if (!$result) {
            throw new ApiException(ApiException::$CSRFException);
        }

        unset($_SESSION["token"][$pos]);
    }

    public static function CheckSave($obj, $params = null) {

        if ($params != null) {
            if (!empty($obj->{$params})) {
                throw new Exception(ApiLogic::getCrudErrorCode());
            }
        } else if (!empty($obj->id)) {
            throw new Exception(ApiLogic::getCrudErrorCode());
        }
    }

    public static function Login($request) {


        /*
         * Oggetto di risposta
          {
          "result": true,
          "data": {
          "person": {
          "oid": "string",
          "title": "string",
          "first_name": "string",
          "middle_name": "string",
          "company": "string"
          }
          }
          }

         */

        global $db_conn;
        $username = mysqli_real_escape_string($db_conn, $request->get('username'));
        $password = mysqli_real_escape_string($db_conn, $request->get('password'));

        $result = false;
        $data = null;
        $Person = PersonFactory::Get4Username($username);

        if ($Person) {
            if (password_verify($password, $Person->password)) {
                self::setSession($Person->id);
                $result = true;
                $dataObj = new stdClass();

                $dataObj->person = $Person;

                $data = $dataObj;
            }
        }

        return self::GenerateResponse($result, $data);
    }

    public static function Registration() {
        global $db_conn;

//Utilizzare password_hash per cryptare la password
//password_hash("password", PASSWORD_BCRYPT);
    }

    public static function Permission($request) {
        global $db_conn;

        $result = false;
        $data = null;
        if (self::checkSession()) {
            $result = true;

//Estraggo tutte le permission per la gui richiesta
            $gui = mysqli_real_escape_string($db_conn, $request->get('gui'));
            $Permission = PermissionFactory::Get4Gui(self::GetPersonLogged(), $gui);
            if ($Permission) {
                $dataObj = new stdClass();
                $dataObj->permission = PermissionLogic::SmallPermission($Permission);
                $data = $dataObj;
            }
        }

        return self::GenerateResponse($result, $data);
    }

    public static function Menu() {
        global $db_conn;

        $result = false;
        $data = null;
        if (self::checkSession()) {

            $result = true;
//Estraggo il Menu per l'utente
            $data = GuiLogic::getMenu();
        }

        return self::GenerateResponse($result, $data);
    }

    public static function GenerateResponse($result = false, $data = null) {
        $obj = new stdClass();
        $obj->result = $result;
        $obj->data = $data;
        return $obj;
    }

    public static function GenerateErrorResponse($message = "", $code = "00") {
        $obj = new stdClass();
        $obj->result = false;
        $obj->message = $message;
        $obj->code = $code;
        return $obj;
    }

    public static function ReloadObject($ob, $array, $sanitize = true, $exclude_validity_date = true) {
        global $db_conn;
        $temp_array = get_object_vars($ob);
        foreach ($temp_array as $key => $value) {
            if ($exclude_validity_date && ($key == "valid_from" || $key == "valid_to")) {
                continue;
            }
            if (isset($array[$key])) {
                if ($sanitize) {
                    $ob->$key = self::Sanitize($array[$key]);
                } else {
                    $ob->$key = trim($array->$key);
                }
            }
        }
    }

    public static function GetFromArray($ob, $array, $sanitize = true, $exclude_validity_date = true) {
        global $db_conn;
        $temp_array = get_object_vars($ob);
        foreach ($temp_array as $key => $value) {
            if ($exclude_validity_date && ($key == "valid_from" || $key == "valid_to")) {
                continue;
            }


            if (isset($array[$key])) {
                if ($sanitize) {
                    $ob->$key = self::Sanitize($array[$key]);
                } else {
                    $ob->$key = trim($array->$key);
                }
            } else {
                $ob->$key = null;
            }
        }
    }

    public static function Sanitize($value) {
        global $db_conn;
        if (is_array($value)) {
            foreach ($value as $v) {
                $v = trim(mysqli_real_escape_string($db_conn, $v));
            }
            return $value;
        } else {
            return trim(mysqli_real_escape_string($db_conn, $value));
        }
    }
    public static function SanitizeObject($obj) {
        global $db_conn;
        foreach ($obj as $k=>$v) {
            $obj->{$k} = trim(mysqli_real_escape_string($db_conn, $v));
        }
        return $obj;
    }

    public static function generateOID() {
        $tmp = self::GUID();
        return $tmp;
    }

    public static function beginTransaction() {
        global $db_conn;
        CoreFactory::beginTransaction();
    }

    public static function commitTransaction() {
        global $db_conn;
        CoreFactory::commitTransaction();
    }

    public static function rollbackTransaction() {
        global $db_conn;
        CoreFactory::rollbackTransaction();
    }

    private static function GUID($trim = true)
    {
        if (function_exists('com_create_guid') === true) {
        if ($trim === true)
            return md5(trim(com_create_guid(), '{}'));
        else
            return md5(com_create_guid());
    }

    // OSX/Linux
    if (function_exists('openssl_random_pseudo_bytes') === true) {
        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
        return md5(vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4)));
    }

    // Fallback (PHP 4.2+)
    mt_srand((double)microtime() * 10000);
    $charid = strtolower(md5(uniqid(rand(), true)));
    $hyphen = chr(45);                  // "-"
    $lbrace = $trim ? "" : chr(123);    // "{"
    $rbrace = $trim ? "" : chr(125);    // "}"
    $guidv4 = $lbrace.
              substr($charid,  0,  8).$hyphen.
              substr($charid,  8,  4).$hyphen.
              substr($charid, 12,  4).$hyphen.
              substr($charid, 16,  4).$hyphen.
              substr($charid, 20, 12).
              $rbrace;
    return md5($guidv4);

    }
    
    public static function GetWordInitials($word){
        $initials = preg_split("/\s+/", $word);
        $acronym = "";
        foreach ($initials as $w) {
            $acronym .= $w[0];
        }
        return $acronym;
        
    }
    
    public static function PersonIsAgent($person){
        $supplierlist = SupplierLogic::GetList("core_person_id = $person->id");
        foreach($supplierlist as $l){
            if($l->agent == true){
                return true;
            }
        }
        return false;
    }
    /**
     * 
     * @param Person $person
     * @return boolean
     */
    public static function PersonIsAdmin($person){
        $GroupHasPerson = GroupHasPersonFactory::GetByPerson($person->id);
        $Group = GroupFactory::Get($GroupHasPerson->group_id);
        if($Group->type == Group::$AC){
            return true;
        }
        return false;
    }

}
