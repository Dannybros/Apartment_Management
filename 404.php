<?php
http_response_code(404);
include_once('nav.php');
?>
<div>Oops</div>
<div>There is no such page. Please go back to home.</div>
<a href="index.php">Go To Home Page</a>
<?php
include_once('footer.php');
?>