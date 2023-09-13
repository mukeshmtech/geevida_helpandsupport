<?php
date_default_timezone_set('America/Chicago');
$timestamp = date("Y-m-d H:i:s");

session_start();
define('baseUrl', 'http://localhost/geevida_helpandsupport/server/');
define('baseAPIUrl', 'http://localhost/geevida_helpandsupport/server/class/api_call.php/');
require_once("inc/config.php");
require_once("class/UserClass.php");
require_once("class/AdClass.php");
?>
<script> 
    var baseAPIUrl= "<?php echo baseAPIUrl; ?>";
    var baseUrl= "<?php echo baseUrl; ?>";
</script>
