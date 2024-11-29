<?php 
$headtitle = "404 NOT Found!";
ob_start();
?>
<section>
    <h1>the required page does not exist</h1>
</section>
<?php 
$mainContent = ob_get_clean();
?>