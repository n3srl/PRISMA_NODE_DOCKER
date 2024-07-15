<?php

class guiLogic {

    public static function SmallMenu($Menu) {
        foreach ($Menu as $M) {
            unset($M->id);
            unset($M->oid);
            unset($M->menu_item);
            unset($M->create_date);
            unset($M->valid_from);
            unset($M->valid_to);
            unset($M->erased);
            unset($M->last_update);
        }
    }
    
    public static function OrderingMenu($Menu, $parent_id){
        $Menus = array();
        $MenusSimple = array();
        if($parent_id != null){
            $MenusSimple = array_filter(
                $Menu,
                function ($e) use (&$parent_id) {
                    return $e->parent_id == $parent_id;
                }
            );
            
        }
        foreach ($MenusSimple as $M){
            $Elements = guiLogic::OrderingMenu($Menu, $M->id);
            
            if(!empty($Elements)){
                $M->subpage = $Elements;
            }else{
                $M->subpage = [];
            }
            
            guiLogic::SmallMenu($M);
            
                
            $Menus[] = $M;
        }
        
        return $Menus;
    }
    
    public static function getMenu(){
        
        $Menu = [];
        $RowMenu = GuiFactory::GetRowMenu();

        if ($RowMenu) {
            //Carico solo i menu che l'utente può vedere
            $Menu = GuiFactory::GetFullMenu(coreLogic::getPersonLogged(), $RowMenu->id);
            $Menu = guiLogic::OrderingMenu($Menu, $RowMenu->id);
            guiLogic::SmallMenu($Menu);
        }

        return $Menu;
    }

}
