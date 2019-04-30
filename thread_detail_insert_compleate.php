<?php
    $insert_user = $_POST['insert_user'];
    $text = $_POST['text'];
    $thread_id = $_POST['thread_id'];
    
    print $thread_id;
    print $text;
    print $insert_user;
    try {
        # TODO:デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // スレッドの書込みを表示
        $stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/insert_thread_detail.sql"));
        $stmt->execute(array($thread_id,$text,$insert_user));
        
        # TODO: mstの更新
        
        
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }

    # TODO: TopPageに戻る

?>