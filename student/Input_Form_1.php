
<?php
    include '../includes/login.php';
    include '../includes/function.php';

?>


<?php
    if($_POST == null){
            
        if( !empty($_SESSION['reference']) ){
            /*セッションidがセットされている時の処理をお願いします。*/
            //アップデート文未実装！！！


            // modifiedのtimestampは
            // 自動初期化されたカラムは、カラムに値を指定しない挿入行に対して現在のタイムスタンプに設定されます。
            // 自動更新されたカラムは、行内のほかのカラムの値がその現在の値から変更されると、現在のタイムスタンプに自動的に更新されます。
            //自動更新されたカラムは、ほかのすべてのカラムがその現在の値に設定されていれば、変更されないまま保持されます。
            // なので ステップ１は自動に任せます！

        }
    }else{

        //ポストされたデータを変数に格納
        $id = intval($_SESSION['ID']);
        $number = 1;
        $company_name = $_POST['company_name'];
        $company_address = $_POST['company_address'];

        $total_number = intval($_POST['number_of_applications']);
        $method = $_POST['application_method'];
        $document_screening = $_POST['document_screening'];
        $job = $_POST['occupation'];
        $document_submitted = "";
        $cntflag = 1;
        //データベースに格納できる様に書式を変更
        //checkboxに複数チェックがあるとき
        //例 履歴書,修了見込み証明書 に加工し1行で纏める。
        $document_submitted = implode(",",$_POST['Documents_submitted']);
        
        
        //DBに接続
        $dsn = 'mysql:host=192.168.1.171;dbname=job_hunt_manage;charset=utf8';
        $user = 'user';
        $password = 'test';

       

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            
            
            $stmt = $db->prepare("INSERT INTO ac_comp_data_tb(act_id,as_number,comp_name,comp_address,no_appli,
                                how_to_apply,docmt_screening,job,docmt_submit) VALUE (:ID,:as_number,:comp_name,:comp_address,:no_appli,
                                :how_to_apply,:docmt_screening,:job,:docmt_submit)");
            
            // modifiedのtimestampは
            // 自動初期化されたカラムは、カラムに値を指定しない挿入行に対して現在のタイムスタンプに設定されます。
            // 自動更新されたカラムは、行内のほかのカラムの値がその現在の値から変更されると、現在のタイムスタンプに自動的に更新されます。自動更新されたカラムは、ほかのすべてのカラムがその現在の値に設定されていれば、変更されないまま保持されます。
            // なので ステップ１は自動に任せます！

            $stmt->bindParam(':ID',$id, PDO::PARAM_INT);
            $stmt->bindParam(':as_number',$number,PDO::PARAM_INT);
            $stmt->bindParam(':comp_name',$company_name,PDO::PARAM_STR);
            $stmt->bindParam(':comp_address',$company_address,PDO::PARAM_STR);
            $stmt->bindParam(':no_appli',$total_number,PDO::PARAM_INT);
            $stmt->bindParam(':how_to_apply',$method,PDO::PARAM_STR);
            
            
            $stmt->bindParam(':docmt_screening',$document_screening,PDO::PARAM_STR);
            $stmt->bindParam(':job',$job,PDO::PARAM_STR);
            
            $stmt->bindParam(':docmt_submit',$document_submitted,PDO::PARAM_STR);

            //クエリの実行
            $stmt->execute();
        }catch (PDOException $e) {
            exit('エラー：' . $e->getMessage());
        }

        try{
            $db = new PDO($dsn, $user, $password);
            $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            //プリペアドステートメントを作成
            $stmt = $db->prepare("SELECT reference_number FROM ac_comp_data_tb WHERE act_id = :ID AND comp_name =:company_name");

            $stmt->bindParam(':ID',$id, PDO::PARAM_INT);
            $stmt->bindParam(':company_name',$company_name, PDO::PARAM_INT);
            $stmt->execute();

            $row = $stmt ->fetch(PDO::FETCH_ASSOC);
            

        }catch(PDOException $e){
            exit('エラー：' . $e->getMessage());
        }
        //入力したリファレンスnumber取得。
        $_SESSION['reference'] = $row['reference_number'];

        //INSERT完了したらページ遷移
        header('Location: Input_Form_2_1.php');
    
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
                <a href="home_2.php"><img src="../images/innu.jpeg"></a>
            </div>
            <div id="main_title"> 
                <h1>就職活動報告</h1>
                <h2>ステップ１</h2>
            </div>
            <div class="big-div">   
                <form action="Input_Form_1.php" method="post">
                        <!--　ポストで送信 -->
                    <div class="div-info">
                        <div class="divdiv_col_1 divdiv">   
                            <p class="p-info_col_1"><label for="company_name">応募先企業名：</label></p>
                            <div class="denger_field">
                                <input type="text" class="input-view" name="company_name"  id="company_name">
                                <!-- ここにエラー文を出力-->
                            </div>
                        </div>
                        <div class="divdiv_col_1 divdiv">   
                            <p class="p-info_col_1"><label for="company_address">応募先所在地：</label></p>
                            <div class="denger_field">
                                <input type="text" class="input-view" name="company_address" id="company_address">
                                <!-- ここにエラー文を出力-->
                            </div>
                        </div>
                        
                        <div class="divdiv" >   
                            <p class="p-info"><label for="application_method">応募方法：</label></p>
                            <div class="denger_field divsize">
                                <select class="input-view select_box" name="application_method">
                                    <option value="未選択">未選択</option>
                                    <option value="本校紹介">本校紹介</option>
                                    <option value="職安の紹介">職安の紹介</option>
                                    <option value="縁故者の紹介">縁故者の紹介</option>
                                    <option value="求人情報誌等">求人情報誌等</option>
                                    <option value="その他">その他</option>
                                </select>
                                <!-- ここにエラー文を出力-->
                            </div>
                        </div>
                        
                        <div class="divdiv">   
                            <p class="p-info">書類選考：</p>
                            <div class="input-view_1" id="radio">
                                <div class="denger_field">
                                    <div><label><input type="radio" name="document_screening" value="有">有</label></div>
                                    <div class="radio_right"><label><input type="radio" name="document_screening" value="無">無</label></div>
                                    <p><!-- ここにエラー文を出力--></p>
                                </div>
                            </div>
                        </div>
                        
                    
                        <div class="divdiv Form_1">   
                            <p class="p-info"><label for="occupation">職種：</label></p>
                            <div class="denger_field divsize"><input type="text" class="input-view" name="occupation" id="occupation"></label></div>
                        </div>
                        
                        <div class="divdiv Form_1">   
                            <p class="p-info"><label for="number_of_applications"> 応募件数：</label></p>
                            <div class="denger_field divsize"><input type="number" min="0" max="10" class="input-view" name="number_of_applications" id="number_of_applications"></div>
                        </div>
                        
                        <div class="divdiv_width_all" id="documents_checkbox">   
                            <p class="p-info">提出書類：</p>
                            <div class="docu_sele">
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="履歴書">履歴書</label></div>
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="職務経歴書">職務経歴書</label></div>
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="終了見込証明書">終了見込証明書</label></div>
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="成績証証明書">成績証明書</label></div>
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="健康診断書">健康診断書</label></div>
                                <div><label><input type="checkbox" name="Documents_submitted[]" value="作品">作品</label></div>
                                <div>
                                    <label>
                                        <input type="checkbox" name="Documents_submitted" value="その他" id="">その他：
                                    </label>
                                    <!--<input type="text" name="Documents_submitted">
                                    </label>-->
                                </div>
                                <div class="denger_field"><!-- ここにエラー文を出力--></div>
                            </div>
                        </div>    
                        <div class="denger_field"></div>
                    
                    </div>
                    <div class="button">
                        <input type="reset"  class="btn_item" value="キャンセル" alt="キャンセル">
                        <input type="submit" class="btn_item" value="保存" alt="保存">
                        <input type="submit" class="btn_item" value="一次→" alt="一次→">
                    </div>
                </form>
            </div>
            <script type="text/javascript" src="\DEVELOPMENT_PRACTICE/JS_files/methot.js"></script>
            <script>window.onload = validation_check()</script>
        </body>
        

    </html>


</html>