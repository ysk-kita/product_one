<?php
    $thread_title = $_GET['thread_title'];
    
    print "<h2>Viewing thread:{$thread_title}</h2>";

    try {
        # TODO:デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // スレッドの書込みを表示
        $stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/find_thread_detail_list.sql"));
        $stmt->execute(array($_GET['thread_id']));
        while($row = $stmt->fetch(PDO::FETCH_OBJ)){
            print <<<VIEW_THREAD
                <div>
                    <span>{$row->row_no}:{$row->insert_user}</span> <br/>
                    <span>{$row->text}</span>
                </div>            
            VIEW_THREAD;
        }
        
        print <<<WRITE_THREAD
            <div>
                <form action="thread_detail_insert_confirm.php" method="post">
                    user name:<input type="text" name="write_user" /><br />
                    write text:<textarea name="text" rows="4" cols="50"></textarea><br />
                    <button type="submit">writing</button>
                </form>        
            </div>
        WRITE_THREAD;
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
?>

