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

    print <<<INSERT_TEXT
        <form action="thread_insert_compleate.php" method="post">
            <input type="hidden" value="{$text}" name="text" />
            <input type="hidden" value="{$insert_user}" name="insert_user" />
            <button type="submit">writing compleate</button>
        </form>        
    INSERT_TEXT;
?>
