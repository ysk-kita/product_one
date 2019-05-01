<?php
    print "<h1>hello BBS</h1>";

    # TODO: sql実行はserviceに切り出し
    try {
        # TODO: デプロイ時にホスト等書換
        $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
        $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // スレッドタイトル一覧を表示
        $thread_mst_list = $mysqlPdo->query(file_get_contents("resource/sql/find_thread_mst_list.sql"));
        while($row = $thread_mst_list->fetch(PDO::FETCH_OBJ)){
            print "<label><a href='thread_detail.php?thread_id={$row->thread_id}' >{$row->thread_title}({$row->rows})</a></label>";
        }        
        
    } catch (PDOException $e){
        print('Error:'.$e->getMessage());
        die();
    }
    
    # todo: アカウント作成も追加
    print <<<LOGIN
        <div>
            <form action="login.php" method="post">
                id:<input type="text" name="login_id" />
                password:<input type="texl" name="password" />
                <button type="submit">login</button>
            </form>
        </div>
    LOGIN;
?>


