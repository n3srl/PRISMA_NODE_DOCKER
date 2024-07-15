<?php

class ModuleNotSupportedException extends Exception{
    // Redefine the exception so message isn't optional
    public function __construct($message, $code = 0, Throwable $previous = null) {
        // some code
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

class FieldException extends Exception {

    public $errors;
    public $message = "Error Field";

    public function __construct($errors) {
        error_log(json_encode($errors));
        $this->message = implode("<br />", $errors);

        $this->errors = $errors;
        parent::__construct();
    }

}

class PersonException extends Exception {

    public $errors;
    public $message = "Error Field";

    public function __construct($errors) {
        error_log(json_encode($errors));
        $this->message = implode("<br />", $errors);

        $this->errors = $errors;
        parent::__construct();
    }

}

class CSRFException extends Exception {

    public $errors;
    public $message = "Error Field";

    public function __construct($errors) {
        error_log(json_encode($errors));
        $this->message = implode("<br />", $errors);

        $this->errors = $errors;
        parent::__construct();
    }

}

class EmailException extends Exception {

    public $errors;
    public $message = "Error Email Address";

    public function __construct($errors) {
        error_log(json_encode($errors));
        $this->message = implode("<br />", $errors);

        $this->errors = $errors;
        parent::__construct();
    }

}

class ApiException extends Exception {

    public static $FieldException = "FIELD";
    public static $CSRFException = "CSRF";
    public static $PersonException = "PERSON";
    public static $PermissionException = "PERMISSION";
    public static $EmailException = "EMAIL NOT SET";
    public static $Generic = "GENERAL";
    public $errors;
    public $type;
    public $message = "Error Field";

    public function __construct($type, $errors = null) {
        $this->type = $type;
        switch ($type) {
            case self::$FieldException:
                $this->message = implode("<br />", $errors);
                $this->errors = $errors;
                break;
            case self::$CSRFException:
                $this->message = "Error CSRF";
                break;
            case self::$PersonException:
                $this->message = "Error Person";
                break;
            case self::$PermissionException:
                $this->message = "Error Permission";
                break;
            case self::$EmailException:
                $this->message = "Error Email Address";
                break;
            case self::$Generic:
                $this->message = "Generic Error";
                if ($errors != null) {
                    if (is_array($errors))
                        $this->message = implode("<br />", $errors);
                    else
                        $this->message = $errors;
                }
                break;
        }



        parent::__construct();
    }

}
