<?php
    include 'includes/login.php';
?>


<?php 
    // if(isset($_POST['textarea_1']) && isset($_POST['textarea_2'])){    
    // echo "チェック１". $_POST['textarea_1'],"チェック２" . $_POST['textarea_2'];
    // }else if(isset($_POST['textarea_1'])){
    //     echo "チェック１". $_POST['textarea_1'];
    // }else if(isset($_POST['textarea_2'])
    // ){
    //     echo "チェック２". $_POST['textarea_2'];
    // }

    if($_POST == null){
        ;
    }else{
        //前頁で入力して自動生成したリファレンスナンバー
        $reference_number = $_SESSION['reference'];
        //一次試験格納用
        $once = 1;
        //ポストされたデータを配列に格納
        $once_date = $_POST['once_date'];
        $start_time = $_POST['start_time'];
        $end_time = $_POST['end_time'];
        

        $test_type = $_POST['test_type'];
        $array_type_text;

        
        foreach($test_type as $value){
            //チェックが入っている場所をkey値として、textを代入する予定。key値は1～10で指定されている。
            $array_type_text[$value] = 'test1'; 
        }
        echo $array_type_text['1'];
    
    
    
        // $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        // $user = 'user';
        // $password = 'test';

        // try{
        //     $db = new PDO($dsn, $user, $password);
        //     $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //     //プリペアドステートメントを作成
                    
        //     $stmt = $db->prepare("INSERT INTO tests_tb VALUE (:reference_number,:td_status,:date_data,begin_time_data,end_time_data)");

        //     $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
        //     $stmt->bindParam(':tb_status',$once, PDO::PARAM_INT);
        //     $stmt->bindParam(':date_data',$once_date, PDO::PARAM_STR);
        //     $stmt->bindParam(':begin_time_data',$start_time, PDO::PARAM_STR);
        //     $stmt->bindParam(':end_time_data',$end_time, PDO::PARAM_STR);

        //     //クエリの実行
        //     $stmt->execute();

        //     $stmt = $db->prepare("INSERT INTO test_details_tb VALUE (:reference_number,:td_status,:sp_number,:details) ");

        //     $stmt->bindParam(':reference_number',$reference_number, PDO::PARAM_INT);
        //     $stmt->bindParam(':tb_status',$once, PDO::PARAM_INT);
        //     $stmt->bindParam(':sp_number',$once, PDO::PARAM_INT);
        //     $stmt->bindParam(':details',$once, PDO::PARAM_STR);

            
        //     //クエリの実行
        //     $stmt->execute();

        // }catch(PDOException $e){
        //     exit('エラー：' . $e->getMessage());
        // }

    }

    
    
?>













<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_Input_Form.css">
            <title>入力画面</title>
        </head>
        <body>
            <div class="return">
                <a href="Input_Form_1.php"><img src="images/innu.jpeg"></a>
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
                            <input type="date" class="input-view" name="once_date" id="test_day">
                        </div>      
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="start_time">開始日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" name="start_time" id="start_time">
                        </div> 
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="end_time">終了日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" name="end_time" id="end_time">
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
                            </div>
                        </div>
                        <div class="divdiv_width_all_ex" id="text_info">
                            <!-- ここに詳細欄を追加していく-->
                        </div>  
                        
                    </div>
                    
                    <div class="button">
                        <input type="reset"  class="btn_item" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="btn_item" value="保存" alt="保存">
                        <input type="submit" class="btn_item" value="二次→" alt="二次→">
                    </div>
                </form>
            </div>

            


            <script type="text/javascript" src="methot.js"></script>
            <script type="text/javascript">setting_detail()</script>

        </body>
    </html>
</html>