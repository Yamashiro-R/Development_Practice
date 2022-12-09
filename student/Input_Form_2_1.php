<?php
    include 'includes/login.php';
    require_once 'function.php';
?>
<?php 
    //前頁で入力して自動生成したリファレンスナンバー
    $_SESSION['reference'] = 2;
    $reference_number = $_SESSION['reference'];
    //一次試験格納用
    $once = 1;
?>


<?php 
    if( empty($_SESSION['reference']) ){
        //空だった場合はなにもしない
        ;
    }else{
        //設定されている場合はDBを探索しデータを表示したい。

        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        $tests_tb_data = fetch_tests_tb($reference_number,$once);
        $test_detalis_tb_data = fetch_test_detalis_tb($reference_number,$once);
    }

        
?>


<?php
    if($_POST){
        //ここでテキストエリアの文字が入力されているかチェックして
        if( empty($_POST['textarea']) ){
            //テキストのエリアが無い = 入力してない or 入力してある項目すべて削除した
            //なので消す動作を入れている 
            Delete_test_detalis_tb_data($reference_number,$once);
            //そして、tests_tbに入力するデータがあるかチェックする。

            //ポストされた値が入っているか其々チェック
            if( empty($_POST['once_date']) && empty($_POST['start_time']) &&
            empty($_POST['end_time']) ) {
            //空の時何もしない
            ;
            }else{
                //値を変数に格納。
                $once_date = $_POST['once_date'];
                $start_time = $_POST['start_time'];
                $end_time = $_POST['end_time'];

                //値がある時
                //tests_tbのデータをDeleteして
                Delete_tests_tb_data($reference_number,$once);
            
                //ポストされた値をINSERTする。
                Insert_tests_tb_data($reference_number,$once,$once_date,$start_time,$end_time);

                //タイムスタンプでデータを更新する処理
                timestamp($reference_number); 
                
            }

            
        }else{
            //どれかに値が入っていたら
            $i=0;
            
            foreach($_POST['textarea'] as  $key => $value){
                if( empty($value) ){
                    continue;
                }else{
                    $i++;
                } 
            }

            //チェックボタンと入力されているテキストエリアの数を照合
            if( count($_POST['test_type']) != $i ){
                echo 'データとカウントが一致しない。';
            }else{
                //数があっていたらDBの処理に移行する。
                //ポストされたデータを配列に格納
                $test_type = $_POST['test_type'];
                $textareas = $_POST['textarea'];
                $array_type_text;
                for($tmp =0 ; $tmp < count($test_type) ; $tmp++){
                    //チェックが入っている場所をkey値として、textを代入する予定。key値は1～10で指定されている。
                    //key = textデータとして入力された分のみ其々を結びつけ連想配列化。
                    //$array_type_text[$value] = $_POST['textarea_'.$value];
                    $array_type_text[$test_type[$tmp]] = $textareas[$tmp];                 
                }
                    Delete_test_detalis_tb_data($reference_number,$once);
            }
            //ポストされた値が入っているか其々チェック
            if( empty($_POST['once_date']) && empty($_POST['start_time']) &&
            empty($_POST['end_time']) ) {
            echo "date_dataと開始時間、終了時間の３つが空だったら何もしない。"
            ;
            }else{
                //値を変数に格納。
                $once_date = $_POST['once_date'];
                $start_time = $_POST['start_time'];
                $end_time = $_POST['end_time'];

                //値がある時
                //tests_tbのデータをDeleteして
                Delete_tests_tb_data($reference_number,$once);
            
                //ポストされた値をINSERTする。
                Insert_tests_tb_data($reference_number,$once,$once_date,$start_time,$end_time);

                Insert_test_detalis_tb_data($reference_number,$once,$array_type_text);

            }
            
            //タイムスタンプでデータを更新する処理
            timestamp($reference_number); 
        

            $tests_tb_data = fetch_tests_tb($reference_number,$once);
            $test_detalis_tb_data = fetch_test_detalis_tb($reference_number,$once);

            //二次へのボタンが押されてたら次のページへ遷移。保存なら何もしない。
            if( !empty( $_POST['next'] ) ){
                header('Location:Input_Form_2_2.php');
            }   
        }
    }

?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_Input_Form.css">
            <title>入力画面</title>
        </head>
        <?php include 'header.php' ?>

        <body>
            <div class="return">
                <a href="Input_Form_1.php"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title"> 
                <h1>就職活動報告</h1>
                <h2>ステップ２</h2>
                <h3>一次試験</h3>
            </div>

            <div class="big-div">   
                <form action="Input_Form_2_1.php" method="post" name="test">
                    <div class="div-info">
                        <div class="divdiv_col_1 divdiv input_width"> 
                            <p class="p-info p-width_1"><label for="test_day">一次試験日付：</label></p>
                            <input type="date" class="input-view" name="once_date" id="test_day" value="<?php echo $tests_tb_data['date_data']; ?>">
                        </div>      
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="start_time">開始日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" name="start_time" id="start_time" value="<?php  echo $tests_tb_data['begin_time_data']; ?>">
                        </div> 
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="end_time">終了日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" name="end_time" id="end_time" value="<?php  echo $tests_tb_data['end_time_data']; ?>">
                        </div> 


                        <div class="divdiv_width_all">
                            <p class="p-info">一次試験内容：</p>
                            
                            <div class="Input_Form_2_1_area_div">
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="1">筆記(専門)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="2">筆記(一般<span class="comm">常識</span>)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="3">適性検査(専門)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="4">適性検査(一般<span class="comm">常識</span>)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="5">面接(個別)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="6">面接(集団)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="7">面接(ディスカッション等)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="8">作文</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="9">実技</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type[]" value="10">その他</label></div>
                                <?php //fetch_sp_number($test_detalis_tb_data,10);?>
                            </div>
                        </div>
                        <div class="divdiv_width_all_ex" id="text_info">
                            <!-- ここに詳細欄を追加していく-->
                        </div>  
                        
                    </div>
                    
                    <div class="button">
                        <input type="reset"  class="btn_item" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="btn_item" name="save" value="保存" alt="保存">
                        <input type="submit" class="btn_item" name="next" value="二次→" alt="二次へ" disabled>
                    </div>
                </form>
            </div>

            <!-- JSで操作するために値渡し -->
            <?php $test_json = json_encode($test_detalis_tb_data);?>
            

            <script type="text/javascript" src="methot.js"></script>
          
            <script type="text/javascript">

                let json_data = JSON.parse('<?php echo $test_json; ?>');
                let sp_data = json_data.map(item => item['sp_number']);
                let text_data = json_data.map(item => item['details']);
                
                Input_Form_2_monitoring(sp_data,text_data);
               
            </script>
             
        </body>
    </html>
</html>