<?php
    include 'includes/login.php';
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
                <a href="Input_Form_2_1.php"><img src="images/innu.jpeg"></a>
            </div>
            <div id="main_title"> 
                <h1>就職活動報告</h1>
                <h2>ステップ２</h2>
            </div>

            <div class="big-div">   
                <form action="#">
                    <div class="div-info">
                        <div class="divdiv_col_1 divdiv input_width"> 
                            <p class="p-info p-width_1"><label for="test_day">二次試験日：</label></p>
                            <input type="date" class="input-view" name="once_date" id="test_day">
                        </div>      
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="start_time">開始日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" id="start_time">
                        </div> 
                        <div class="divdiv"> 
                            <p class="p-info p-width_2"><label for="end_time">終了日時：</label></p>
                            <input type="time" class="input-view input_view_time time_margin" id="end_time">
                        </div> 


                        <div class="divdiv_width_all">
                            <p class="p-info">二次試験内容：</p>

                            <div class="Input_Form_2_1_area_div">
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="1">筆記(専門)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="2">筆記(一般<span class="comm">常識</span>)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="3">適性検査(専門)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="4">適性検査(一般<span class="comm">常識</span>)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="5">面接(個別)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="6">面接(集団)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="7">面接(ディスカッション等)</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="8">作文</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="9">実技</label></div>
                                <div class="exam_test"><label><input type="checkbox" name="test_type" value="10">その他</label></div>
                            </div>
                        </div>
                        <div class="divdiv_width_all_ex" id="text_info">
                            <!-- ここに詳細欄を追加していく-->
                        </div>
                     </div>
                    <div class="button">
                        <input type="reset"  class="btn_item" value="キャンセル" alt="キャンセル">
                        <input type="button" class="btn_item" value="保存" alt="保存">
                        <input type="button" onclick="location.href='Input_Form_2_3.php'" class="btn_item" value="三次→" alt="三次→">
                    </div>
                </form>
            </div>
            <script type="text/javascript" src="methot.js"></script>
            <script type="text/javascript">setting_detail()</script>

        </body>
    </html>


</html>