<?php 
    /*配列に添え字の要素があるか判定して、ある場合はその要素を出力*/ 
    function orig_array_key_exists (int $index, array $array) {
        if (array_key_exists($index,$array)) {
            echo $array[$index];
        }
    }



    /*アドレス値から市町村だけを出力。県外の場合は県名だけ出力*/
    function address_key_exists (int $index, array $array) {
        if (array_key_exists($index,$array)) {
            if(preg_match("/沖縄県/",$array[$index])){
                create_address($array[$index]);
            }else{
                create_address_out($array[$index]);
            }
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
                echo $okinawa[$i];
                break;
            }
        }

        if($i >= count($okinawa)) {
            echo $comp_address;
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
                echo $kenn[$i];
                break;
            }
        }

        if($i >= count($kenn)) {
            echo $comp_address;
        }
    }


    /*tableの中身を生成*/
    function create_tbody ($row) {
        if($row != false){
            $modified = array_column($row, 'modified');
            $comp_name = array_column($row, 'comp_name');
            $comp_address = array_column($row, 'comp_address');
            $job = array_column($row, 'job');
            $apply_status = array_column($row, 'apply_status');
            $reference_numbe = array_column($row,'reference_numbe');


            $i = 0;
            while($i < 5){
            echo '<tr class="row', $i + 1 , '">
                <td class="day">', date_only($i ,$modified) ,'</td>
                <td class="comp-name">', orig_array_key_exists( $i ,$comp_name) , create_button($i,$row) ,'</td>
                <td class="address">', address_key_exists($i,$comp_address) , '</td>
                <td class="job">', orig_array_key_exists($i,$job) ,'</td>
                <td class="satus">', orig_array_key_exists($i++,$apply_status) ,'</td>
            </tr>
            ';
            }
        }else{
            $i = 0;
            while($i < 5){
            echo '<tr class="row">
                <td class="day"></td>
                <td class="comp-name"></td>
                <td class="address"></td>
                <td class="job"></td>
                <td class="satus"></td>
            </tr>
            ';

            }
         }
    }

    /*buttonの作成*/ 
    function create_button (int $index, $row) {
        if (array_key_exists($index,$row)) {
            echo '<form action="savedata.php" class="btn_form" method="POST"><button type="submit" class="dvtable-view" value="' , $row[$index][0] ,
                 '" name="no">詳細閲覧</button>';
        }

    }



    /*日時の値で日付だけ出力したいとき*/
    function date_only($index,$date) {
        $day = "";
        if (array_key_exists($index,$date)) {
            echo date('Y年m月d日',strtotime($date[$index]));
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

        echo $new_hta ;
    } 


    /*一次、二次、三次及びその他の出力形式の作成*/
    function print_data($day,$data){
        /*データの切り分け*/
        /*$day*/
        $youbi = array_column($day,'date_data');
        $begin_time_data = array_column($day,'begin_time_data');
        $end_time_data = array_column($day,'end_time_data');

        /*$data*/
        $status = 1;
        $test_data = array_column($data,'details');
        


        /*試験名を格納する配列*/
        $datalis = "";
        $sps= array(3);
        $sps[0] = array(10);
        $sps[1] = array(10);
        $sps[2] = array(10);
        $test_data_no = 0;
        $sp_no = 0;

        for($i=0;$i < 3;$i++){
            $datalis .= 
            '<div class="test">
                <div>
                    <p>'. $status .'次：</p><p>日付(<'.
                    date('m月d日',strtotime($youbi[$i])) .' ' . $begin_time_data[$i] . '～' . $end_time_data[$i] .')</p>
                    <p>試験内容＝＞';
                    
            for($j=0;;$j++){
                $datalis .= $data[$sp_no]['select_process'];
                $sps[$i][$j] =  $data[$sp_no]['select_process'];
                if(array_key_exists($sp_no+1,$data) && $status == $data[$sp_no+1]['td_status']){
                    $sp_no++;
                    $datalis .= ' + ';
                }else{
                    $sp_no++;
                    $datalis .= '</p></div>';
                    break;
                }
            }

            for($s=0;; $s++){
                    $datalis .= '<div>
                                    <p class="p-info">'. $sps[$i][$s] .'：</p>';
                    
                    $datalis .= '<p class="p-view">'.
                                $test_data[$test_data_no]    .'</p></div>';
                if(array_key_exists($test_data_no+1,$data) && $status == $data[$test_data_no+1]['td_status']){
                    $test_data_no++;
                }else{
                    $test_data_no++;
                    $status++;
                    $datalis .= '</div>';
                    break;
                }

            }
                            
        }
        echo $datalis;
    }
?>