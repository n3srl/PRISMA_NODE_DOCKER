<?php

/**
 *
 * @author: N3 S.r.l.
 */
class PersonLogic {

    public static function Save($obj) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::Init($obj, $Person);
        $res = PersonFactory::Save($obj);
        //GroupHasPersonLogic::SaveGroup($obj->id);
        return $res;
    }

    public static function Update($obj) {
        $Person = CoreLogic::VerifyPerson();
        N3BusinessObject::SetModified($obj, $Person);

        return PersonFactory::Update($obj);
    }

    public static function Erase($obj) {
        $Person = CoreLogic::VerifyPerson();
        return PersonFactory::Erase($obj);
    }

    public static function Delete($obj) {
        $Person = CoreLogic::VerifyPerson();
        return PersonFactory::Delete($obj);
    }

    public static function Get($id) {
        $res = false;
        $Person = CoreLogic::VerifyPerson();
        /* if (!GroupHasPersonLogic::VerifyGroup($id)) {
          throw new ApiException(ApiException::$PersonException);
          } */
        return PersonFactory::Get($id);
    }

    public static function GetList() {
        $Person = CoreLogic::VerifyPerson();
        $ob = PersonFactory::GetList();
        return $ob;
    }

    public static function GetListPersonName($term) {
        $Person = CoreLogic::VerifyPerson();
        $ob = PersonFactory::GetListPersonName($term);
        return $ob;
    }
    
    public static function ExtractMailFromPerson($person){
        $addr = '';
        if(!empty($person->email)){
            $addr .= $person->email.";";
        }
        
        $companies = CustomerLogic::GetListCompany("", "core_person_id = $person->id");
        foreach($companies as $company){
            $contacts = ContactLogic::GetListByCompany($company->name_company_id);
            foreach($contacts as $contact){
                $emails = EmailLogic::GetListByContact($contact->id);
                foreach($emails as $email){
                    if((!$email->not_valid || empty($email->not_valid)) && (!$email->do_not_use || empty($email->do_not_use))){
                        if(!empty($email->email)){
                            $addr .= $email->email.";";
                        }
                    }
                }
            }
        }
        return $addr;
    }

}
