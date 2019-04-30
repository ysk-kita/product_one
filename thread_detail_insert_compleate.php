<?php
    $thread_id = $_POST['thread_id'];
    $text = $_POST['text'];
    $insert_user = $_POST['insert_user'];

    print <<<INSERT_THINGS
        <div>
            <span>次の内容を書込みました</span>
            <span>{$text}</span>
        </div>
    INSERT_THINGS;

    try {
        # TODO:デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $get_rowno_stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/find_thread_detail_rowno.sql"));
        $get_rowno_stmt->execute(array($thread_id));
        $rowno_stmt = $get_rowno_stmt->fetch(PDO::FETCH_ASSOC);
        $row_no = $rowno_stmt['row_no'] + 1;
        
        // スレッドへの書込み
        $thread_detail_insert_stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/insert_thread_detail.sql"));
        $thread_detail_insert_stmt->execute(array($thread_id, $row_no, $text, $insert_user));
        
        // mstの更新
        $thread_mst_update_stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/update_thread_mst.sql"));
        $thread_mst_update_stmt->execute(array($thread_id));
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

    print <<<BACK_PAGE
        <label><a href='index.php'>top page</a></label>
        <label><a href='thread_detail.php?thread_id={$thread_id}'>back thread</a></label>
    BACK_PAGE;
?>
