<?php
    $insert_user = $_POST['insert_user'];
    $text = $_POST['text'];
    $thread_id = $_POST['thread_id'];
    
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
        
        # TODO: 全角書込み
        // スレッドへの書込み
        $thread_detail_insert_stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/insert_thread_detail.sql"));
        $thread_detail_insert_stmt->execute(array($thread_id,$text,$insert_user));
        
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
