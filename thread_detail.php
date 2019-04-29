<?php
    $thread_title = $_GET['thread_title'];
    
    print "<h2>Viewing thread:{$thread_title}</h2>";

    try {
        # TODO:デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/find_thread_detail_list.sql"));
        $stmt->execute(array($_GET['thread_id']));
            
        #while($row = $thread_detail_list->fetch(PDO::FETCH_OBJ)){
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
            print <<<VIEW_THREAD
                <div>
                    <span>{$row->row_no}:{$row->insert_user}</span> <br/>
                    <span>{$row->text}</span>
                </div>            
            VIEW_THREAD;
        }        
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
?>
