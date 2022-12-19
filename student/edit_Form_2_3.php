<?php
    include '../includes/login.php';
    require_once '../includes/function.php';

    $reference_number = $_SESSION['reference_edit'];
    //一次試験格納用
    $third = 3;

    if( empty($_SESSION['reference_edit']) ){
        //空だった場合はなにもしない
        header('Location: edit_Form_2_2.php');

    }else{
        $reference_number = $_SESSION['reference_edit'];

       if($_POST){
            if(isset($_POST['cancel'])){

            }else{

                Delete_test_details_tb_data($reference_number,$third);
                Delete_tests_tb_data($reference_number,$third);

                //値を変数に格納。
                $third_date = $_POST['third_date'];
                $start_time = $_POST['start_time'];
                $end_time = $_POST['end_time'];
                Insert_tests_tb_data($reference_number,$third,$third_date,$start_time,$end_time);


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

                Insert_test_details_tb_data($reference_number,$third,$array_type_text);
                //タイムスタンプでデータを更新する処理
                timestamp($reference_number); 

                if(isset($_POST['next'])){
                    $_SESSION['Input_3'] = 2;
                    header('Location: edit_Form_3.php');
                }else if(isset($_POST['fin'])) {
                    if($_SESSION['back_page'] == 'save'){
                        header('Location: savedata.php');
                        exit();
                    }else if($_SESSION['back_page'] == 'result'){
                        header('Location: result.php');
                        exit();
                    }
                }
            }
        }
        //設定されている場合はDBを探索しデータを表示したい。

        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

        $tests_tb_data = fetch_tests_tb($reference_number,$third);
        $test_details_tb_data = fetch_test_details_tb($reference_number,$third);
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
                <a href="edit_Form_2_2.php"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title"> 
            <h1 class="edit_h1">就職活動報告(編集)</h1>
                <h2 class="edit_h2">ステップ２</h2>
                <h3>三次試験</h3>
            </div>

            <div class="big-div">   
                <form action="edit_Form_2_3.php" method="post" name="test">
                    <div class="div-info">
                        <div class="divdiv_col_1 divdiv input_width"> 
                            <p class="p-info p-width_1"><label for="test_day">三次試験日付：</label></p>
                            <input type="date" class="input-view" name="third_date" id="test_day" value="<?php echo $tests_tb_data['date_data']; ?>">
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
                            <p class="p-info">三次試験内容：</p>
                            
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
                            </div>
                        </div>
                        <div class="divdiv_width_all_ex" id="text_info">
                            <!-- ここに詳細欄を追加していく-->
                        </div>  
                        
                    </div>
                    
                    <div class="button">
                        <input type="submit"  class="btn_item" name="cancel" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="btn_item" name="save" value="保存" alt="保存" onclick="save_alert()">
                        <input type="submit" class="btn_item next_step" name="next" value="次のステップ→" alt="次のステップへ" disabled>
                    </div>
                    <div class="button">
                        <input type="submit"  class="btn_item fin_btn" name="fin" value="編集終了" alt="編集終了">
                    </div>

                </form>
            </div>

            <!-- JSで操作するために値渡し -->
            <?php $test_json = json_encode($test_details_tb_data);?>
            

            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
          
            <script type="text/javascript">

                let json_data = parseJson('<?php echo $test_json; ?>');
                let sp_data = json_data.map(item => item['sp_number']);
                let text_data = json_data.map(item => item['details']);
                
                Input_Form_2_monitoring(sp_data,text_data);
               
            </script>
             
        </body>
    </html>
</html>