<?php
    $insert_user = htmlentities($_POST['write_user']) ?? "No Name" ;
    $text = htmlentities($_POST['text']) ?? "" ;
    $thread_id = $_POST['thread_id'];
    print <<<CONFIRM_WRITE_THINGS
        <h3>Writing thing confirm</h3>
        <div>
            <span>user:{$insert_user}</span> <br/>
            <span>text:{$text}</span>
        </div>
    CONFIRM_WRITE_THINGS;

    print <<<INSERT_TEXT
        <form action="thread_detail_insert_compleate.php" method="post">
            <input type="hidden" value="{$text}" name="text" />
            <input type="hidden" value="{$insert_user}" name="insert_user" />
            <input type="hidden" value="{$thread_id}" name="thread_id" />
            <button type="submit">writing compleate</button>
        </form>        
    INSERT_TEXT;
?>
