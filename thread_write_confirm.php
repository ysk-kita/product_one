<?php
    $insert_user = htmlentities($_POST['write_user']) ?? "No Name" ;
    $text = htmlentities($_POST['text']) ?? "" ;
    $text = nl2br($text);
    print <<<CONFIRM_WRITE_THINGS
        <h3>Writing thing confirm</h3>
        <div>
            <span>user:{$insert_user}</span> <br/>
            <span>text:{$text}</span>
        </div>
    CONFIRM_WRITE_THINGS;


?>
