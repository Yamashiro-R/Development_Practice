<?php 
    /*値がないときの出力*/
    function check_null($value){
        if($value == "" || $value == null || $value == 0){
            echo "無回答";
        }else{
            echo $value;
        }
    }

    function check_null_re ($value){
        if($value == "" || $value == null || $value == 0){
            return "無回答";
        }else{
            return $value;
        }
    }

    function check_null_day ($value){
        if($value == "" || $value == null || $value == 0){
            echo "未申請";
        }else{
            echo $value;
        }
    }






    /*配列に添え字の要素があるか判定して、ある場合はその要素を出力*/ 
    function orig_array_key_exists (int $index, array $array) {
        if (array_key_exists($index,$array)) {
            check_null($array[$index]);
        }
    }






    /*アドレス値から市町村だけを出力。県外の場合は県名だけ出力*/
    function address_key_exists (int $index,array $array) {
        if (array_key_exists($index,$array)) {
            address_check($array[$index]);
        }
    }

    function address_check (string $address) {
            if(preg_match("/沖縄県/",$address)){
                create_address($address);
            }else{
                create_address_out($address);
            }
    }


    /*県名が沖縄県のとき市町村を判定し出力*/
    function create_address ($comp_address) {
        $okinawa = array("那覇市","宜野湾市","石垣市","浦添市","名護市","糸満市","沖縄市","豊見城市","うるま市","宮古島市","南城市",
                        "与那原町","南風原町","久米島町","渡嘉敷村","座間味村","粟国村","渡名喜村","南大東村","北大東村","伊平屋村",
                        "伊是名村","八重瀬町","国頭村","大宜味村","東村","今帰仁村","本部町","恩納村","宜野座村","金武町","伊江村",
                        "多良間村","竹富町","与那国町","読谷村","嘉手納町","北谷町","北中城村","中城村","西原町");
        $i = 0;
        for(;$i < count($okinawa);$i++) {
            if(preg_match("/$okinawa[$i]/",$comp_address)){
                check_null($okinawa[$i]) ;
                break;
            }
        }

        if($i >= count($okinawa)) {
            check_null($comp_address);
        }
    }

    /*県名が沖縄県以外のとき県名だけ出力*/
    function create_address_out ($comp_address) {
        $kenn = array("北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県","茨城県","栃木県","群馬県","埼玉県",
                        "千葉県","東京都","神奈川県","新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県",
                        "静岡県","愛知県","三重県","滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県","鳥取県","島根県",
                        "岡山県","広島県","山口県","徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県","熊本県",
                        "大分県","宮崎県","鹿児島県");
        $i = 0;
        for(;$i < count($kenn);$i++) {
            if(preg_match("/$kenn[$i]/",$comp_address)){
                check_null($kenn[$i]) ;
                break;
            }
        }

        if($i >= count($kenn)) {
            check_null($comp_address) ;
        }
    }


    /*tableの中身を生成　生徒画面*/
    function create_tbody ($row,$page) {
        if($row != false){
            if($page == 'save'){
                $comp_name = array_column($row, 'comp_name');
                $comp_address = array_column($row, 'comp_address');
                $job = array_column($row, 'job');
                $apply_status = array_column($row, 'apply_status');
                $reference_numbe = array_column($row,'reference_numbe');
                $confirmation =  array_column($row,'confirmation');
                $as_number = array_column($row,'as_number');
                $application_Date = array_column($row,'application_Date');
        
                $i = 0;
                while($i < count($row)){
                    echo '<tr class="row', $i + 1 , '">
                        <td class="day">',date_only($i ,$application_Date) ,'</td>
                        <td class="comp-name"><label>', orig_array_key_exists( $i ,$comp_name) , create_button($i,$row,$page)   ,'</lable></td>
                        <td class="address" title="', orig_array_key_exists($i,$comp_address) ,'">', address_key_exists($i,$comp_address) , '</td>
                        <td class="job">', orig_array_key_exists($i,$job) ,'</td>
                        <td class="show">', create_button($i,$row,$page);
                    if($confirmation[$i] == false && ($as_number[$i] == 3 || $as_number[$i] == 4)){
                        echo '<br><span>未確認</span>';
                    }
                    echo '</td></tr>';

                    $i++;

                }
            }else if($page == 'past'){
                $application_Date = array_column($row,'application_Date');
                $comp_name = array_column($row, 'comp_name');
                $comp_address = array_column($row, 'comp_address');
                $job = array_column($row, 'job');
                $apply_status = array_column($row, 'apply_status');
                $reference_numbe = array_column($row,'reference_numbe');
                $confirmation =  array_column($row,'confirmation');
                $as_number = array_column($row,'as_number');
        
                $i = 0;
                while($i < count($row)){
                    echo '<tr class="row', $i + 1 , '">
                        <td class="day">', date_only($i ,$application_Date) ,'</td>
                        <td class="comp-name"><label>', orig_array_key_exists( $i ,$comp_name) , create_button($i,$row,$page)   ,'</lable></td>
                        <td class="address" title="', orig_array_key_exists($i,$comp_address) ,'">', address_key_exists($i,$comp_address) , '</td>
                        <td class="job">', orig_array_key_exists($i,$job) ,'</td>
                        <td class="show">', create_button($i,$row,$page),'</td></tr>';

                    $i++;

                }
            }
        }else{
            echo '<tr class="row">
            <td colspan="5">検索条件に該当するデータはありません</td>
            </tr>
                ';
        }
    }


        /*tableの中身を生成　管理者画面*/
        function t_create_tbody ($row,$page) {
            if($row != false){
                $application_Date = array_column($row,'application_Date');
                $comp_name = array_column($row, 'comp_name');
                $student_name = array_column($row, 'account_name');
                $apply_status = array_column($row, 'apply_status');
                $reference_numbe = array_column($row,'reference_numbe');
    
    
                $i = 0;
                while($i < count($row)){
                echo '<tr class="row', $i + 1 , '">
                    <td class="day">', date_only($i ,$application_Date) ,'</td>
                    <td class="comp-name"><label>', orig_array_key_exists( $i ,$comp_name) , create_button($i,$row,$page)   ,'</lable></td>
                    <td class="student_name">', orig_array_key_exists($i,$student_name) , '</td>
                    <td class="app_status">', orig_array_key_exists($i,$apply_status) ,'</td>
                    <td class="show">', create_button($i++,$row,$page) ,'</td>
                </tr>
                ';
                }
            }else{               
                echo '<tr class="row">
                    <td colspan="5">検索条件に該当するデータはありません</td>
                    </tr>
                ';
             }
        }
    





    /*buttonの作成*/ 
    function create_button(int $index, $row, $pass) {
        if (array_key_exists($index,$row)) {
            if($pass == 'save'){
                echo '<form action="savedata.php" class="btn_form" method="POST"><button type="submit" class="dvtable-view" value="' , $row[$index][0] ,
                    '" name="no">閲覧</button></form>';
            }else if($pass == 'past'){
            echo '<form action="pastdata.php" class="btn_form" method="POST"><button type="submit" class="dvtable-view" value="' , $row[$index][0] ,
                 '" name="no">閲覧</button></form>';
            }else if($pass == 'teach'){
                echo '<form action="teach_pd.php" class="btn_form" method="POST"><button type="submit" class="dvtable-view" value="' , $row[$index][0] ,
                '" name="no">閲覧</button></form>';
           }
        }

    }



    function create_btn_chg ($page,$records){
        if($records > 10){
            $max_page = ceil($records/10);
            $btn = "";
            if($page < 2){
                $btn .= '<form action="" class="btn_form"><button  class="dvtable-view" disabled>←前</button></form>';
            }else{
                $btn .= '<form action="" class="btn_form" method="GET"><button type="submit" class="dvtable-view" value="' . ($page-1) .
                '" name="page">←前</button></form>';
            }

            $btn .= '<p>' . $page . '/' . $max_page  . '</p>';

            if($page >= $max_page){
                $btn .= '<form action="" class="btn_form" ><button  class="dvtable-view" disabled>次→</button></form>';
            }else{
                 $btn .= '<form action="" class="btn_form" method="GET"><button type="submit" class="dvtable-view" value="' . ($page+1) .
                '" name="page">次→</button></form>';
            }
            
            echo $btn;
           
        }
    }





    /*日時の値で日付だけ出力したいとき*/
    function date_only($index,$date) {
        if (array_key_exists($index,$date)) {
           check_null_day($date[$index]) ;
        }
    }


    /*IDから出席番号の抽出*/
    function attend_number(int $id) :INT {
        return  $id % 100;
    }


    /*how_to_applyの出力形式の変換*/
    function change_format(string $hta){
        $new_hta = "";
        for($i = 0; $i < strlen($hta); $i++){
           if($hta[$i] != ','){
                $new_hta .= $hta[$i];
           }else{
                $new_hta .= "<br>";
           }
        }

        return $new_hta ;
    } 


    /*一次、二次、三次及びその他の出力形式の作成*/
    function print_data($day,$data){

        if($day){
            /*データの切り分け*/
            /*$day*/
            $youbi = array_column($day,'date_data');
            $begin_time_data = array_column($day,'begin_time_data');
            $end_time_data = array_column($day,'end_time_data');
            $status = 1;



            /*試験名を格納する配列*/
            $datalis = "";
            $test_data_no = 0;
            $sp_no = 0;
            $max = 0;




            for($i=0;$i < count($day)  && $status == $data[$test_data_no]['td_status'] ;$i++){
                $datalis .= 
                '<div class="test">
                    <div>
                        <p>'. $status .'次：</p><p>日付('.
                        date('m月d日',strtotime($youbi[$i])) .' ' .  date('H:i', strtotime($begin_time_data[$i]))  . '～' .  date('H:i',strtotime($end_time_data[$i])) .')</p></div>';
                        
                if($data){
                    /*$data*/
                    $test_data = array_column($data,'details');
                }

                while(true){
                        $datalis .= '<div><p class="p-info">試験内容＝＞';
                        if($data) {
                            $datalis .= check_null_re($data[$sp_no]['select_process'] );
                        }else{
                            $datalis .= check_null_re("");
                        } 
                        $datalis .= '</p>';
                        


                        $datalis .= '<p class="p-view">';
                        if($data) {
                            $datalis .= check_null_re($test_data[$test_data_no]);
                        }else{
                            $datalis .= check_null_re("");
                        } 
                        $datalis .= '</p></div>';
                    
                    
                 if($data && array_key_exists($test_data_no+1,$data) && $status == $data[$test_data_no+1]['td_status']){
                        $test_data_no++;
                        $sp_no++;
                    }else{
                        $test_data_no++;
                        $sp_no++;
                        $status++;
                        $datalis .= '</div>';
                        break;
                    }

                }
                                
            }
            echo $datalis;
        }
    }



    function delete_data($ref_num){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            $stmt = $db->prepare("delete from test_details_tb where reference_number = :num;");
            //パラメータ割り当て
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();

            //プリペアドステートメントを作成
            $stmt = $db->prepare("delete from tests_tb where reference_number = :num;");
            //パラメータ割り当て
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();

            //プリペアドステートメントを作成
            $stmt = $db->prepare("delete from ac_comp_data_tb where reference_number = :num;");
            //パラメータ割り当て
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();

                    
            //パラメータ割り当て
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();

    
            header('Location: dataView.php');
            exit();

        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    
        
    }


    /*teach_reqの新規依頼画面データ出力*/
    function teach_func($row) {
        if ($row != false) {
            $st_name = array_column($row,'account_name');
            $st_date = array_column($row,'application_Date');
            $st_comp = array_column($row,'comp_name');
            $st_ref_number = array_column($row,'reference_number');
             
            echo '<form class="req_form" method="POST" action="req_data.php">';
            for($i = 0; $i < count($row); $i++) {
                echo '<label>
                        <div class="test_div">
                            <p>', date_only($i,$st_date) ,'</p>
                            <p>', $st_name[$i] ,'</p>
                            <p>', $st_comp[$i] ,'</p>
                        </div>
                        <button type="submit" value="', $st_ref_number[$i] ,'" name="no" hidden></button>
                        </label>';
            }
            echo '</form>';
        }
    }



    /*req_data.phpでの承認内容をデータベースに反映*/
    
    function ap_status_up($ref_num,$i){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            if($i == 0){
                //プリペアドステートメントを作成
                $stmt = $db->prepare("UPDATE ac_comp_data_tb SET as_number = 3 WHERE reference_number = :num");
            }else if($i == 1){
                //プリペアドステートメントを作成
                $stmt = $db->prepare("UPDATE ac_comp_data_tb SET as_number = 4 WHERE reference_number = :num");
            }
            //パラメータ割り当て
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            //クエリの実行
            $stmt->execute();

            $stmt = $db->prepare("UPDATE ac_comp_data_tb SET confirmation = 0 WHERE reference_number = :num");
            $stmt->bindParam(':num', $ref_num, PDO::PARAM_STR);
            $stmt->execute();
            
            header('Location: req_data.php');
            exit();

        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }

    //Input_Formで使用する。

    //リファレンスキーを貰って現在のデータ状態を取得する
    function fetch_tests_tb($reference_number,$td_status){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
        
       
        
      
        try{
            //ここにリファレンスキーで現在データ状態を取得して表示する。
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            //test_tbにデータがあるかチェック。
            $stmt = $db->prepare("SELECT * FROM tests_tb where reference_number = :reference_number AND td_status = :td_status");
            
            //リファレンスナンバーバインド
            $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
            $stmt->bindParam(':td_status',$td_status, PDO::PARAM_INT);
            //クエリの実行
            $stmt->execute();
            
                $data_table = $stmt -> fetch();
            
            
            return $data_table; 

        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }

    }

    function fetch_test_details_tb($reference_number,$td_status){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
       
       
        
        
     
        try{
            //ここにリファレンスキーで現在データ状態を取得して表示する。
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            //test_tbにデータがあるかチェック。
            $stmt = $db->prepare("SELECT * FROM test_details_tb where reference_number = :reference_number AND td_status = :td_status ORDER BY sp_number");
            
            //リファレンスナンバーバインド
            $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
            $stmt->bindParam(':td_status',$td_status, PDO::PARAM_INT);
            //クエリの実行
            $stmt->execute();
            
            $data_table = $stmt -> fetchAll(PDO::FETCH_BOTH);
            
            
            return $data_table; 

        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }

    }



    //任意のtebleのDelete処理
    //reference_numberと一次or二次or三次で削除するレコード特定
    function Delete_tests_tb_data($reference_number,$interviewNo){
        

        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
       
        

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

             //リペアドステートメントを作成  
             $stmt = $db->prepare("DELETE FROM tests_tb WHERE reference_number = :reference_number AND td_status = :td_status");
             $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
             $stmt->bindParam(':td_status',$interviewNo, PDO::PARAM_INT);
             //クエリの実行
             $stmt->execute();
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
    
    function Delete_test_details_tb_data($reference_number,$interviewNo){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
        
       
        

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

              //プリペアドステートメントを作成  
              $stmt = $db->prepare("DELETE FROM test_details_tb WHERE reference_number = :reference_number AND td_status = :td_status");

              $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
              $stmt->bindParam(':td_status',$interviewNo, PDO::PARAM_INT);
              //クエリの実行
              $stmt->execute();
              


        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }

    }


    function Insert_tests_tb_data($reference_number,$interviewNo,$date_date,$start_time,$end_time){

        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
        
       
        

        
        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
            //リペアドステートメントを作成  
            $stmt = $db->prepare("INSERT INTO tests_tb VALUE (:reference_number,:td_status,:date_data,:begin_time_data,:end_time_data)");
        
            $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
            $stmt->bindParam(':td_status',$interviewNo, PDO::PARAM_INT);
            $stmt->bindParam(':date_data',$date_date, PDO::PARAM_STR);
            $stmt->bindParam(':begin_time_data',$start_time, PDO::PARAM_STR);
            $stmt->bindParam(':end_time_data',$end_time, PDO::PARAM_STR);
        
            //クエリの実行
            $stmt->execute();
        
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }
    
    function Insert_test_details_tb_data($reference_number,$interviewNo,$array_type_text){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';
        
       
       
        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        
            foreach($array_type_text as $Key => $Text){
                        
                $stmt = $db->prepare("INSERT INTO test_details_tb VALUE (:reference_number,:td_status,:sp_number,:details)");

                $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
                $stmt->bindParam(':td_status',$interviewNo, PDO::PARAM_INT);
                $stmt->bindParam(':sp_number',$Key, PDO::PARAM_INT);
                $stmt->bindParam(':details',$Text, PDO::PARAM_STR);

                //クエリの実行
                $stmt->execute();
            }
        }catch(PDOException $e){
            exit('エラー：' . $e->getMessage());
        }
    }

    //ac_comp_data_tbのタイムスタンプを更新する処理
    function timestamp($reference_number){
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            //プリリペアドステートメントを作成  
            $db = new PDO($dsn, $user, $password);
                    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

                    //タイムスタンプを更新する直前で取得。
                    $timestamp = new DateTimeImmutable('now',new DateTimeZone('Asia/Tokyo'));
                    $timestamp = $timestamp->format("Y-m-d H:i:s");

                    //プリペアドステートメントを作成
                    $stmt = $db->prepare("UPDATE ac_comp_data_tb SET modified = :time_stamp WHERE reference_number = :reference_number");

                    $stmt->bindParam(':time_stamp',$timestamp,PDO::PARAM_STR);
                    $stmt->bindParam(':reference_number',$reference_number,PDO::PARAM_INT);


                    //クエリの実行
                    $stmt->execute();
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }



    /*申請処理 request.php*/

    function request_data($refarence) {

        $day = date('Y-m-d');
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        try {
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            
            $stmt = $db->prepare("UPDATE ac_comp_data_tb SET as_number = 2 WHERE reference_number = $refarence");
            $stmt->execute();
            $stmt = $db->prepare("UPDATE ac_comp_data_tb SET application_Date = :DATEs WHERE reference_number = $refarence");
            $stmt->bindParam(':DATEs', $day, PDO::PARAM_STR);

            $stmt->execute();
            header('location: home_2.php');
            
        } catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }
    }




?>