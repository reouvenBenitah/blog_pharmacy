<?php
require_once '_app/helpers.php';
// destroys and delete the user session from the sys


$for_time = time() - 3600;
setcookie("rememberme_id", "", $for_time);
setcookie("rememberme_name", "", $for_time);
setcookie("rememberme_user_ip", "", $for_time);
setcookie("rememberme_user_agent", "", $for_time);


session_start();
session_destroy();
header('location: ./');




?>


//* בשביל להכיל על קוד ההתנתקות דרך הטסטר צריך
//* דרך לולאת foreach
//* להרוס את כל הסשנים אחד אחרי השני