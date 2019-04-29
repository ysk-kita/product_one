<?php
    print "<h1>hello BBS</h1>";

    try {
        # TODO:デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // スレッドタイトル一覧を表示
        $thread_mst_list = $mysqlPdo->query(file_get_contents("resource/sql/find_thread_mst_list.sql"));
        while($row = $thread_mst_list->fetch(PDO::FETCH_OBJ)){
            print "<label><a href='thread_detail.php'>{$row->thread_title}({$row->rows})</a></label>";
        }        
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
?>

