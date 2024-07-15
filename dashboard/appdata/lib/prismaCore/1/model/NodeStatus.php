<?php
/**
 * Class for Node
 * 
 * @author: N3 S.r.l.
 */
class NodeStatus
{
    public $status_id = null;
    public $descriptions = [
        "🔵 Online (ITA)",
        "🟢 Online (Freepon)",
        "🟠 In fase di installazione",
        "🟡 In fase di acquisto",
        "🔴 In manutenzione"
    ];

    public static $description_color = [
        "blue",
        "green",
        "orange",
        "yellow",
        "red"
    ];

    public static $ONLINE_ITA          = 0;
    public static $ONLINE_FREEPON      = 1;
    public static $INSTALLING          = 2;
    public static $BUYNG               = 3;
    public static $MAINTENANCE         = 4;

    public $status_description = null;
}
?>
