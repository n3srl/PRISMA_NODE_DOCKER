<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CoreApiLogic {

    public static function GetCurrentUser() {
        try {
            $res = false;
            $Person = CoreLogic::VerifyPerson();
            $ob = CoreLogic::GetPersonLogged();
            unset($ob->password);
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
        } catch (ApiException $a) {
            return CoreLogic::GenerateErrorResponse($a->message);
        }
        return CoreLogic::GenerateResponse($res, $ob);
    }

    
    public static function EventHandlerValidSession() {
        $SSE_MAX_EXECUTION_LOOP = SSE_MAX_EXECUTION_LOOP; // IMPORTANTE -> chiudere il loop infinito dopo un determinato delay per evitare che le risorse rimangano appese per troppo tempo
        header("Cache-Control: no-cache");
        header("Content-Type: text/event-stream"); // FONDAMENTALE -> l'header dev'essere di tipo text/event-stream per permettere il funzionamento
        session_write_close();
        $person = null;
        ignore_user_abort(true); // di default è a false, in combinazione con connection_aborted() [VEDI SOTTO] permette di definire dei comportamenti in caso di disconnessione !NOTA! -> il default a false non sembra funzionare e non chiude mai la connection
        while (true) {
            if ($SSE_MAX_EXECUTION_LOOP == 0) { // forzo la chiusura dopo un determinato intervallo - il client la riaprirà in automatico
                die;
                break;
            }
            $SSE_MAX_EXECUTION_LOOP --;
            $person = CoreLogic::GetPersonLogged();
            if (empty($person)) {
                echo "event: session_expired\n"; // definisce l'evento per la cattura da parte del frontend - importante il new line alla fine
                echo 'data: {"message": "'._("Per procedere è necessario rieffettuare l'accesso ad Orma").'","title": "'._("Attenzione, sessione scaduta").'"}'; // tutti i messaggi devono iniziare con data:
                echo "\n\n"; // il doppio new line indica il termine di un messaggio

                ob_end_clean();
                flush();
            }
            // Break the loop if the client aborted the connection (closed the page)
            if (connection_aborted()) { // Se il client frontend cambia pagina, aggiorna la pagina o la connection è chiusa da codice
                die;
                break;
            }
            sleep(1);
        }
    }

}
