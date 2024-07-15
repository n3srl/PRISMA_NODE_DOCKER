<?php



class SettingsView extends N3BusinessObject{
    
    public static $CORE_MOD = "CORE";
    public static $NAME_MOD = "NAME";
    public static $DOCUMENT_MOD = "DOCU";
    public static $ITEM_MOD = "ITEM";
    public static $WAREHOUSE_MOD = "WARE";
    public static $TAX_MOD = "TAX";
    public static $RELATION_MOD = "REL";
    public static $EINV_MOD = "EINV";
    public static $ATTACHMENT_MOD = "ATT";
    public static $N3MAIL_MOD = "MAIL";
    
    // MAIL config
    public $DEVELOP_MAIL;
    public $DEVELOP_SEND;
    public $TEMPLATE_EMAIL_FOOTER;
    public $TEMPLATE_EMAIL_INFORMATION;
    public $MSG_N3_SMTP_FROM;
    public $MSG_N3_SMTP_PASSWORD;
    public $MSG_N3_SMTP_USERNAME;
    public $MSG_N3_SMTP_AUTH;
    public $MSG_N3_SMTP_PORT;
    public $MSG_N3_SMTP_HOST;
    
    public $MSG_N3_DEFAULT_INVS_RECEIVER;
    
    
    // DOCUMENT CONFIG
    public $PUBLIC_MINIMUM_QUANTITY_TO_ORDER;
    
    
    
    private static function validateModuleName($module){
        $module = strtoupper($module);
        switch($module){            
            case SettingsView::$N3MAIL_MOD:
                return SettingsView::$N3MAIL_MOD;
                break;
            case SettingsView::$DOCUMENT_MOD:
                return SettingsView::$DOCUMENT_MOD;
                break;
            case SettingsView::$CORE_MOD:
                return SettingsView::$CORE_MOD;
                break;
            case SettingsView::$NAME_MOD:
                return SettingsView::$NAME_MOD;
                break;
            case SettingsView::$ITEM_MOD:
                return SettingsView::$ITEM_MOD;
                break;
            case SettingsView::$WAREHOUSE_MOD:
                return SettingsView::$WAREHOUSE_MOD;
                break;
            case SettingsView::$TAX_MOD:
                return SettingsView::$TAX_MOD;
                break;
            case SettingsView::$RELATION_MOD:
                return SettingsView::$RELATION_MOD;
                break;
            case SettingsView::$EINV_MOD:
                return SettingsView::$EINV_MOD;
                break;
            case SettingsView::$ATTACHMENT_MOD:
                return SettingsView::$ATTACHMENT_MOD;
                break;
            default:
                throw new ModuleNotSupportedException("Module $module not supported");
        }
    }
    /**
     * 
     * @param SettingsView $ob
     * @param string $module
     */
    public static function idemUpdateSettingsByModuleView($data, $module){
        global $db_conn;
        $ob = self::FilterClass($data, $module);
        unset($ob->id);
        unset($ob->oid);
        unset($ob->modified_by);
        unset($ob->created_by);
        unset($ob->assigned);
        unset($ob->create_date);
        unset($ob->valid_from);
        unset($ob->valid_to);
        unset($ob->erased);
        unset($ob->last_update);
        $res = true;
        $list = self::GetListByModule($module, false);
        if(!empty($list)){
            foreach($list as $l){
                $res &= SettingsFactory::Erase($l);
            }
        }
        foreach($ob as $key=>$value){
            $setObj = new Settings();
            $Person = CoreLogic::VerifyPerson();
            N3BusinessObject::Init($setObj, $Person);
            $setObj->module = mysqli_real_escape_string($db_conn, $module);
            $setObj->parameter_name = mysqli_real_escape_string($db_conn, $key);
            $setObj->parameter_value = mysqli_real_escape_string($db_conn, $value);
            $res &= SettingsFactory::Save($setObj);
            
        }
        return $res;
    }
    
    
    
    /**
     * 
     * @param SettingsView $ob
     * @param string $module
     * @return type
     * @throws ModuleNotSupportedException
     */
    private static function FilterClass($ob, $module){
        $module = self::validateModuleName($module);

        
        switch($module){
            case settingsView::$N3MAIL_MOD:
                try{
                    //posso avere solo una configurazione attiva
                    unset($ob->PUBLIC_MINIMUM_QUANTITY_TO_ORDER);
                }catch(Exception $e){
                    return null;
                }
                return $ob;
                break;
            case settingsView::$DOCUMENT_MOD:
                try{
                    unset($ob->DEVELOP_MAIL);
                    unset($ob->DEVELOP_SEND);
                    unset($ob->TEMPLATE_EMAIL_FOOTER);
                    unset($ob->TEMPLATE_EMAIL_INFORMATION);
                    unset($ob->MSG_N3_SMTP_FROM);
                    unset($ob->MSG_N3_SMTP_PASSWORD);
                    unset($ob->MSG_N3_SMTP_USERNAME);
                    unset($ob->MSG_N3_SMTP_AUTH);
                    unset($ob->MSG_N3_SMTP_PORT);
                    unset($ob->MSG_N3_SMTP_HOST);
                    unset($ob->MSG_N3_DEFAULT_INVS_RECEIVER);
                }catch(Exception $e){
                    return null;
                }
                return $ob;
                break;
            case settingsView::$CORE_MOD:
            case settingsView::$NAME_MOD:
            case settingsView::$ITEM_MOD:
            case settingsView::$WAREHOUSE_MOD:
            case settingsView::$TAX_MOD:
            case settingsView::$RELATION_MOD:
            case settingsView::$EINV_MOD:
            case settingsView::$ATTACHMENT_MOD:
                return null;
                break;
            default:
                throw new ModuleNotSupportedException("Module $module not supported");
            
        }
        
        
    }
    
    /**
     * 
     * @param string $module
     * @return \SettingsView|\stdClass
     * @throws ModuleNotSupportedException
     */
    public static function getSettingsView($module){
        $module = self::validateModuleName($module);
        $ob = new SettingsView();
        $ob = self::FilterClass($ob, $module);        
        switch($module){
            case SettingsView::$N3MAIL_MOD:
                try{
                    $list = self::GetListByModule($module);
                    //posso avere solo una configurazione attiva
                    foreach($list as $obj){
                        switch($obj->parameter_name){
                            case "DEVELOP_MAIL":
                            case "DEVELOP_SEND":
                            case "TEMPLATE_EMAIL_FOOTER":
                            case "TEMPLATE_EMAIL_INFORMATION":
                            case "MSG_N3_SMTP_FROM":
                            case "MSG_N3_SMTP_PASSWORD":
                            case "MSG_N3_SMTP_USERNAME":
                            case "MSG_N3_SMTP_AUTH":
                            case "MSG_N3_SMTP_PORT":
                            case "MSG_N3_SMTP_HOST":
                            case "MSG_N3_DEFAULT_INVS_RECEIVER":
                                $ob->{$obj->parameter_name} = $obj->parameter_value;
                                break;
                        }
                    }
                }catch(Exception $e){
                    return null;
                }
                return $ob;
                break;
            case SettingsView::$DOCUMENT_MOD:
                try{
                    $list = self::GetListByModule($module);
                    //posso avere solo una configurazione attiva
                    foreach($list as $obj){
                        switch($obj->parameter_name){
                            case "PUBLIC_MINIMUM_QUANTITY_TO_ORDER":
                                $ob->{$obj->parameter_name} = $obj->parameter_value;
                                break;
                        }
                    }
                }catch(Exception $e){
                    return null;
                }
                return $ob;
                break;
            case SettingsView::$CORE_MOD:
            case SettingsView::$NAME_MOD:
            case SettingsView::$ITEM_MOD:
            case SettingsView::$WAREHOUSE_MOD:
            case SettingsView::$TAX_MOD:
            case SettingsView::$RELATION_MOD:
            case SettingsView::$EINV_MOD:
            case SettingsView::$ATTACHMENT_MOD:
                return null;
                break;
            default:
                throw new ModuleNotSupportedException("Module $module not supported");
            
        }
        
        
    }
    
    private static function GetListByModule($module, $getEmptyObject = true) {
        $module = self::validateModuleName($module);
        assert(!empty($module), new Exception("No module provided"));
        $where = "module = '$module'";
        $ob = SettingsFactory::GetList($where);
        if(empty($ob)){
            if($getEmptyObject){
                $ob = new SettingsView();
                $ob = self::FilterClass($ob, $module);
            }else{
                $ob = null;
            }
        }else{
            assert(count($ob) == 1, new Exception("Too much settings"));
        }
        return $ob;
    }
    
       
    
}