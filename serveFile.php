<?php
header("Content-disposition: attachment; filename=https://id.iit.edu/wp-content/uploads/2020/01/IIT-ID-Pathways-Report-2020.pdf");
header("Content-type: application/pdf");
readfile("https://id.iit.edu/wp-content/uploads/2020/01/IIT-ID-Pathways-Report-2020.pdf");
?>
