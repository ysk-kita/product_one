<?php 
    print $_SERVER['HTTP_REFERER'];
    if(isset($_SERVER['HTTP_REFERER'])){
        
        try {
            # TODO:デプロイ時にホスト等書換
            $mysqlPdo = new PDO("mysql:host=127.0.0.1; port=3306; dbname=ForThread; charset=utf8", "root", "");
            $mysqlPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // スレッドの書込みを表示
            $stmt = $mysqlPdo->prepare(file_get_contents("resource/sql/find_user_mst.sql"));
            $stmt->execute(array($_POST['login_id']));
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
            if(!$user){
                print "Input login_id not exist";
            }
            
            if(!password_verify($_POST['password'], $user['password'])){
                print "Password differnt";
            } else {
                print "login successed";
            }
            
        } catch (PDOException $e){
            print('Error:'.$e->getMessage());
            die();
        }

        
    } else {
        
    }

    
?>

