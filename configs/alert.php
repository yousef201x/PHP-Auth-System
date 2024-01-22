<?php
// Check if 'action' and 'status' parameters are present in the URL and 'action' is 'invalid'.
if (!empty($_GET['action']) && $_GET['action'] == 'invalid') { ?>
    <!-- Display a paragraph with the class 'notValid' and the status message from the URL. -->
    <p class="notValid"><?php echo $_GET['status'] ?></p>
<?php }
// Check if 'action' and 'status' parameters are present in the URL and 'action' is 'valid'.
elseif (!empty($_GET['action']) && $_GET['action'] == 'valid') { ?>
    <!-- Display a paragraph with the class 'valid' and the status message from the URL. -->
    <p class="valid"><?php echo $_GET['status'] ?></p>
<?php } ?>