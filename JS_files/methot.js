
function new_login_check() {
        let formElements = document.forms[0];
        for (let con = 0; con < 4; con++) {
            if (formElements.elements[con].value != "" )  {
                if (con == 3) {
                    if(formElements.elements[con].value == "8") {
                        alert("科名を入力してください。");
                    }
                }
            } else {
                alert("入力エラー");
                break;
            }
        }
        if (formElements.elements[1].value == formElements.elements[2].value) {
            ;
        } else {
            alert("パスワードが間違っています。");
            formElements.elements[1].value = null;
            formElements.elements[2].value = null;
        }
}
      

/*Input_Form_1バリデーションチェック ここから*/



const Allprefecture = ["沖縄県","北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県","茨城県","栃木県","群馬県","埼玉県",
"千葉県","東京都","神奈川県","新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県",
"静岡県","愛知県","三重県","滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県","鳥取県","島根県",
"岡山県","広島県","山口県","徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県","熊本県",
"大分県","宮崎県","鹿児島県"];

    
function validation_check(){
    let formElements = document.forms[0];
    
    let company = formElements.elements[0];
    let address = formElements.elements[1];
    let methot = formElements.elements[2];
    let document_radio = document.getElementById("radio");
    let job = formElements.elements[5];
    let number = formElements.elements[6]; 
    let manager = formElements.elements[7];
    let documents_checkbox = document.querySelectorAll("label > input[type='checkbox']"); 
    let savebtn = formElements.elements[16]; 
    let submitbtn = formElements.elements[17]; 
    console.log(submitbtn);
  
    
    //エラー出力先を配列で取得
    let activecompany = true;
    let activeaddress = true;
    let activemethot = true;
    let activedocument_radio = true;
    let activejob = true;
    let activenumber = true;
    let activedocuments_checkbox = true;
    let activemanager = true;

    let denger = formElements.getElementsByClassName('denger_field');
    
    
    //其々の入力が正常化判断する為の boolean値を格納する為の変数
    var forms = document.forms[0];
    if(forms.company_name.value == null || forms.company_name.value == ""){
            activecompany = false;
    }
   
    if(forms.company_address.value == null || forms.company_address.value == ""){
        activeaddress = false;
    }

    if(forms.application_method.value == null || forms.application_method.value == "" || forms.application_method.value == "未選択"){
        activemethot = false;
    }

    if(forms.document_screening.value == null || forms.document_screening.value == ""){
        activedocument_radio = false;
    }

    if(forms.occupation.value == null || forms.occupation.value == ""){
        bool = false;
    }

    if(forms.number_of_applications.value == null || forms.number_of_applications.value == ""){
        activenumber = false;
    }

    if(manager.value == null || manager.value == ""){
        activemanager = false;
    }

    var checkboxs = document.querySelectorAll("input[type='checkbox']");
    var chk;
    for(chk = 0; chk < checkboxs.length; chk++){
        if(checkboxs[chk].checked == true){
            break;
        }
    }
    if(chk >= checkboxs.length){
        activedocuments_checkbox = false;
    }

    
    //チェックボックス用の配列とカウント
    let array_checkbox = Array(documents_checkbox.length);
    
    let checkbox_cnt = 0;
    
    //其々のパラグラフをcreate!!この中にエラー文の文章を格納する。
    let companypara = document.createElement('p');
    let addresspara = document.createElement('p');
    let methotpara = document.createElement('p');
    let jobpara = document.createElement('p');
    let numberpara = document.createElement('p');
    let managerpara = document.createElement('p');
    let checkboxpara = document.createElement('p');



    //探索用のカウント
    let cnt = 0;
    //入力値の県名を格納
    let prefecture;


    
    //一次→ボタンをデフォルトで無効化
    submitbtn.disabled = true;


    //保存ボタンと一次→ボタンの有効化条件
    
    

    
    //企業名入力欄
    company.addEventListener("input",()=>{
        if(company.value === ""){   //入力値がない時
            //入力フォームが空の場合
            companypara.textContent = "表示名を入力してください";
            companypara.id = "row_1_para";
            denger[0].appendChild(companypara);
            activecompany = false;
            
        }else if(company.value.length < 3 ){    //入力値が3文字以下の時
            companypara.textContent = "入力値が違います。";
            companypara.id = "row_1_para";
            denger[0].appendChild(companypara);
            activecompany = false;
        }else if(company.value.length > 30){    //入力値が30文字以上の時
            companypara.textContent = "入力値が多すぎます。";
            companypara.id = "row_1_para";
            denger[0].appendChild(companypara);
            activecompany = false;
        }else{  //バリデーションチェックOKの時
            companypara.textContent = "";
            companypara.id = "row_1_para";
            denger[0].appendChild(companypara);
            activecompany = true;   
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);

        hantei();
    });
    //企業の住所入力欄
    address.addEventListener("input",()=>{
        if(address.value === ""){
            addresspara.textContent = "応募企業の住所を入力してください。";
            addresspara.id = "row_1_para";
            denger[1].appendChild(addresspara);
            activeaddress = false;
            
        }else if( address.value[2] == "県" || address.value[3] == "県" ||
                    address.value[2] == "都" || address.value[2] == "府" || address.value[2] == "道" ){
            if( address.value.search("県") != -1 ){ //県が含まれている。
                switch( address.value.search("県") ){
                    case 2: //3番目に県がくるる時(沖縄県等)
                        prefecture = address.value.substr(0,3);
                        break;
                    case 3: //4番目に県がくる時(神奈川県等)
                        prefecture = address.value.substr(0,4);
                    }
            }else{ prefecture = address.value.substr(0,3); } //"東京都、大阪府、北海道" 
            
            //一致する都道府県を探索＆安策する前に初期化
            cnt = 0; 
            for(let tmp in Allprefecture) {
                if(prefecture != Allprefecture[tmp]){ 
                    cnt++;      
                }else{
                    break;
                }
            }

            

            if(cnt < 47) {  //都道府県名で探索成功の時
                addresspara.textContent = "";
                addresspara.id = "row_1_para";
                denger[1].appendChild(addresspara);
                activeaddress = true;
            } 
        }else{
            addresspara.textContent = "県名/市町村の順に入力してください。"
            addresspara.id = "row_1_para";
            denger[1].appendChild(addresspara);
            activeaddress = false;
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
        
        hantei();

    });
    //応募方法入力欄
    methot.addEventListener("input",()=>{
        switch (methot.value){
            case "0":  //未選択の時
               
                methotpara.textContent = "応募方法を選択してください。";
                methotpara.id = "row_1_para";
                denger[2].appendChild(methotpara);
                activemethot = false;
               
                break;
            default:
                methotpara.textContent = "";
                methotpara.id = "row_1_para";
                denger[2].appendChild(methotpara);
                activemethot = true;
                
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
        hantei();

    });
    //書類選考の有無チェック欄
    document_radio.addEventListener("change",()=>{
        activedocument_radio = true;
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
    });

    //職種入力欄
    job.addEventListener("input",()=>{
        if(job.value === ""){   
            //入力値がない時
            jobpara.textContent = "表示名を入力してください";
            jobpara.id = "row_1_para";
            denger[4].appendChild(jobpara);
            activejob = false;
           
        }else{
            jobpara.textContent = "";
            jobpara.id = "row_1_para";
            denger[4].appendChild(jobpara);
            activejob = true;
           
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
        hantei();

    });
    //応募件数入力欄
    number.addEventListener("input",()=>{
        if(number.value === ""){   
            //入力値がない時
            numberpara.textContent = "件数を入力してください。";
            numberpara.id = "row_1_para";
            denger[5].appendChild(numberpara);
            activenumber = false;
           
        }else if(isNaN(number.value)){ 
            //非数であればtrue
            numberpara.textContent = "数字を入力してください。";
            numberpara.id = "row_1_para";
            denger[5].appendChild(numberpara);
            activenumber = false;
            
        }else if(number.value < 1){
            //マイナス値が入力されている
            numberpara.textContent = "有効な数字を入力してください。";
            numberpara.id = "row_1_para";
            denger[5].appendChild(numberpara);
            activenumber = false;
           
        }else if(number.value > 10){
            //10件以上の時
         
            numberpara.textContent = "10件以上はエラーとみなす。";
            numberpara.id = "row_1_para";
            denger[5].appendChild(numberpara);
            activenumber = false;
            
        }else{
            numberpara.textContent = "";
            numberpara.id = "row_1_para";
            denger[5].appendChild(numberpara);
            activenumber = true;
           
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
        hantei();

    });

    manager.addEventListener("input",()=>{
        if(manager.value == ""){
            managerpara.textContent = "担当者名を入力してください。";
            managerpara.id = "row_1_para";
            denger[6].appendChild(managerpara);
            activemanager = false;
        }else{
            managerpara.textContent = "";
            managerpara.id = "row_1_para";
            denger[6].appendChild(managerpara);
            activemanager = true;
        }
        Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
            activejob,activenumber,activemanager,activedocuments_checkbox);
        

    });


    

    //提出書類チェック欄
    for(let i=0;i<documents_checkbox.length;i++){
        //for文でcheckbox文にそれぞれイベントを追加。
        documents_checkbox[i].addEventListener("change",()=>{
        
            if(documents_checkbox[i].checked){
                //どれかにチェックが入った時
                checkboxpara.textContent = "";
                checkboxpara.id = "row_1_para";
                denger[7].appendChild(checkboxpara);
                activedocuments_checkbox = true;
                console.log("チェックボックスの判定")
                
            }else{
                //配列にチェックボックスそれぞれの状態を格納
                for(let j=0;j<documents_checkbox.length;j++){
                    array_checkbox[j] = documents_checkbox[j].checked;
                }
                console.log(array_checkbox);
                //配列のどれかにチェックが入っていたらブレイクその位置を特定するためにcheckbox_cntでカウント
                for(let tmp=0;tmp<array_checkbox.length;tmp++,checkbox_cnt++){
                    if(array_checkbox[tmp]){break;}
                }
                //最後まで到達した時 == 全てfalseの時
                console.log("チェックカウント →" + checkbox_cnt + "チェックボックスの要素数→" + documents_checkbox.length);
                if(checkbox_cnt == documents_checkbox.length){
                    // console.log("テスト：全てのチェックボックスが空");
                    checkboxpara.textContent = "どれかにチェックを入れてください。";
                    checkboxpara.id = "row_1_para";
                    denger[7].appendChild(checkboxpara);
                    activedocuments_checkbox = false;
                    checkbox_cnt = 0;
                    
                }else{
                    // console.log("テスト：どれかにチェックが入っている");
                    checkboxpara.textContent = "";
                    checkboxpara.id = "row_1_para";
                    denger[7].appendChild(checkboxpara);
                    activedocuments_checkbox = true;
                    checkbox_cnt = 0;
                    
                }    
            }
            Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
                activejob,activenumber,activemanager,activedocuments_checkbox);
            hantei();

        });

    
    }
    //このfunction いる？
    // function hantei(){
    //     if(activecompany && activeaddress && activemethot  &&
    //         activedocument_radio && activejob && activenumber  &&
    //         activedocuments_checkbox){
    //         submitbtn.disabled = false;
    //     }else{
    //         submitbtn.disabled = true;
    //     }
    // }

   
}




function Input_Form_1_judeg_flag(activecompany,activeaddress,activemethot,activedocument_radio,
        activejob,activenumber,activemanager,activedocuments_checkbox){
    let formElements = document.forms[0];

    
    let submitbtn = formElements.elements[17]; 
    console.log(submitbtn);


    if(activecompany && activeaddress && activemethot  &&
        activedocument_radio && activejob && activenumber  &&
        activemanager && activedocuments_checkbox){
            submitbtn.disabled = false;
        }else{
            submitbtn.disabled = true;
        }
    
}


/*Input_Form_1バリデーションチェック ここまで*/


/*Input_Form_2_1 ～ 3の色々ここから*/

var parseJson = function(jsonString) {
    var converted = convertNl(jsonString);
    return JSON.parse(converted);
  };
  
  var convertNl = function(jsonString) {
    return jsonString
      .replace(/(\r\n)/g, '\n')
      .replace(/(\r)/g,   '\n')
      .replace(/(\n)/g,  '\\n');
  };



function Input_Form_2_monitoring(sp_no,text_data){
    
    const checkbox_data = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    let btn = document.querySelectorAll('input[type=submit]');
    let next_btn;
    let step_3_btn;


    if(btn.length < 4){
        next_btn = btn[1];//二次→のボタン
        //step_3→のボタンがあるなら要素入れて無ければnull値を入れる以後それを判定してボタンの数を合わせる。

        step_3_btn = btn[2] == null ? null : btn[2]; 
    }else{
        next_btn = btn[2];//二次→のボタン
        //step_3→のボタンがあるなら要素入れて無ければnull値を入れる以後それを判定してボタンの数を合わせる。

        step_3_btn = btn[3] == null ? null : btn[3]; 
    }
    
    
    fetch_sp_number(sp_no,text_data);

    //初期値のフラッグを格納する。
    let array_flag = flag_confirmation();
    
    flagCnt = 0;

    for( ; flagCnt < array_flag.length ; flagCnt++){
        if(!array_flag[flagCnt]){
            
            //falseならループを抜ける。
            break
        }
        console.log("初期値のフラグ数カウント" + array_flag.length);
        
    }
    //初期値を確認しボタンを有効or無効を判断
    //step_3へのボタンがある時と無い時の分岐判断
    if(step_3_btn == null){
        next_btn.disabled = flagCnt == array_flag.length ? false : true;
    }else{
        next_btn.disabled = flagCnt == array_flag.length ? false : true;
        step_3_btn.disabled = flagCnt == array_flag.length ? false : true;
    }
    
    


    //どれかに変更が起きたらflagの状態をチェックしてボタンの状態を遷移させる。
    let formElements = document.forms[0];
    
    // let details_p = document.querySelector('.divdiv_width_all > p');
    // let details_Input  = document.querySelector('.divdiv_width_all > .Input_Form_2_1_area_div');
    // console.log(details_Input);


    formElements.addEventListener('input',()=>{
        
        array_flag = flag_confirmation();
        console.log("formイベント");
        flagCnt = 0;
        
        
        if(flagCnt == 3){
            details_p
            details_Input
        }
        for( ; flagCnt < array_flag.length ; flagCnt++){
            if(!array_flag[flagCnt]){
                //falseならループを抜ける。
                break
            }
        }
        //イベント毎に確認しボタンを有効or無効を判断
        //step_3へのボタンがある時と無い時の分岐判断
        if(step_3_btn == null){
            next_btn.disabled = flagCnt == array_flag.length ? false : true;
        }else{
            next_btn.disabled = flagCnt == array_flag.length ? false : true;
            step_3_btn.disabled = flagCnt == array_flag.length ? false : true;
        }
        
        
    },false);
    

    if(sp_no.length == 0){
        for(let cnt=0;cnt<checkbox_data.length;cnt++){
            exam_check(cnt);
        }



    }else{
        for(let cnt=0;cnt<checkbox_data.length;cnt++){
            var bool = false;
            for(let i in sp_no){ 
                if(( sp_no[i] -1) == cnt){
                    bool = true;
                }
            }
            if(!bool){
                exam_check(cnt);
            }
        }
    }
}


//Input_Form_2
//DBでsp_number(チェックボックス欄)がチェック済みのところをHTMLに反映する。操作用
function fetch_sp_number(sp_no,text_data) {
    
    const checkboxs = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    for(let dbCnt = 0; dbCnt < sp_no.length; dbCnt++){
                //値が一緒の場所にチェックを入れる。
                //jsのinputは0スタート、DBは1スタート
                checkboxs[ sp_no[dbCnt] -1 ].checked = true;
                initial_value_Text(sp_no[dbCnt] ,text_data[dbCnt]);
                //チェックボックスクリエイトして初期値テキスト代入。
    }
}

//Input_Form_2の初期値を確認しボタンを有効化するかチェック
//その後Monitoringに値を渡しイベントリスナをセット。
//現在のフラグ状況を確認する！
function flag_confirmation(){
    const date_data = document.querySelector(`input[type='date']`);
    const time_data = document.querySelectorAll(`input[type='time']`);
    const checkbox_data = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    

    //flag数だけ作成。
    let array_flag = new Array(5);

    //初期化
    for(let i = 0; i < array_flag.length;i++){
        array_flag[i] = false;
       
    }
    //array_flagに 日付,開始日時,終了日時,チェックボックス,テキストエリア の順番でflagの状態を格納。
    

        
    if( date_data.value != "" ){
        //初期値を確認するよう。
        //date_dataがある時
        array_flag[0] = true;
    }
  
    for(let tmp = 0;tmp < time_data.length;tmp++){
        if(time_data[tmp].value != "" ){ 
            //first_time or end_time がある時
            switch(tmp){
                case 0:
                    array_flag[1] = true;

                    break;
                case 1:
                    array_flag[2] = true;
                    break;
            }
        }
        
    }
    
    //チェックがtrueの数をカウント
    let checkCnt = check_checkboxs(checkbox_data);

    console.log(checkCnt);
    if( checkCnt > 0 ){
        array_flag[3] = true;

        let area = document.querySelectorAll('textarea');
        console.log(area);

        
        //チェックボックスのチェック数とテキストエリアの数が合って入ればflagをtrueにする。
        //テキストエリアがある == 何かしらの値がセットされている。
        console.log("チェックボックスの数" +checkCnt);
        let areaCnt = new Array(checkCnt);

        //作られたテキストエリアの状態を配列areaCntに格納する。
       console.log("テキストエリアの数" + area.length);
        for(let i = 0; i < area.length ; i++){


            if( area[i].value == "" ){
                areaCnt[i] = false;
            }else{
                areaCnt[i] = true;
            }
        }

        console.log("エリアフラグ" + areaCnt);
        array_flag[4] = array_boolean(areaCnt);

        console.log(array_flag);
    }else{
      array_flag[3] = false;  
    } 
    
    return array_flag;
}


function initial_value_Text(checkNo,text){
    //checkNo = DBのsp_no = 試験詳細種別 text = 試験種別に対する詳細情報
    console.log("チェックボックス初期値イベント");
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    

    const div_class = document.getElementsByClassName('exam_test');
    //詳細欄出力場所
    const l1 = document.getElementById('text_info');
    
    //消去注意文
    const result = "記入内容はすべて削除されます。よろしいですか？";

    const exam_type = div_class[checkNo-1].textContent +"詳細内容";

    const textarea_name = checkNo;
    //チェックの場所を格納(DBと値を合せるため-1)
    let place = first_exam[checkNo-1];
    
    

    //タグをそれぞれクリエイト
    let div = document.createElement('div');
    let para = document.createElement('p');
    let area = document.createElement('textarea');
   
    
    //選択されたチェック欄の題名を出力
    para.textContent = exam_type;
    //textにDBの詳細データが入っているのでそれをtextareaに反映
    area.textContent = text;

    //cssの為にclassをそれぞれ追加
    div.classList.add('testsAll');
    para.classList.add('title-tests');
    area.classList.add('text-tests');
  
        
    //初期値
    area.name = textarea_name;
    
    div.appendChild(para);
    div.appendChild(area);            
            
    l1.appendChild(div); 
    
        
    place.addEventListener('change',()=>{

        if(place.checked){
            //チェックが入ったら
            area.name = textarea_name;
            div.appendChild(para);
            div.appendChild(area);            
            l1.appendChild(div); 
            area.focus();
        //textareaに入力が無い時
        }else{
            if( area.value == ""){
                
                //ここでformのイベントを発生させてフラグの判定を消した後に発生させている。
                //タイミングを合せるため。
                let e = new Event('input');
                let formElements = document.forms[0];
                formElements.dispatchEvent(e);

            }else{
                //textareaに入力が有る時
                //windowで　はい(true) or いいえ(false)を保持
                let judge = window.confirm(result);
                if(judge){
                    //はいが押された時
                    div.remove();
                    area.value = "";    
                }else{
                    //いいえが押された時
                    place.checked = true;
                }
            }
        }
    },true);
}

function exam_check(cnt){
    
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    const div_class = document.getElementsByClassName('exam_test');
    //詳細欄出力場所
    const l1 = document.getElementById('text_info');
    //消去注意文
    const result = "記入内容はすべて削除されます。よろしいですか？";
    const exam_type = div_class[cnt].textContent +"詳細内容";
    
    //テキストエリア其々のネーム用DBに併せる為＋１
    //const textarea_name = "textarea_" + (cnt + 1);
    const textarea_name = cnt+1;
    let place = first_exam[cnt];
    

    //タグをそれぞれクリエイト
    let div = document.createElement('div');
    let para = document.createElement('p');
    let area = document.createElement('textarea');

    //選択されたチェック欄の題名を出力
    para.textContent = exam_type;

    //cssの為にclassをそれぞれ追加
    div.classList.add('testsAll');
    para.classList.add('title-tests');
    area.classList.add('text-tests');
    area.name = textarea_name 

    
    
    

    place.addEventListener('change',()=>{
        
        if(place.checked){
           
            div.appendChild(para);
            div.appendChild(area);            
            
            l1.appendChild(div); 

            area.focus();
        }else{
            //textareaに入力が無い時
            if( area.value == ""){
                div.remove();
                //ここでformのイベントを発生させてフラグの判定を消した後に発生させている。
                //タイミングを合せるため。
                let e = new Event('input');
                let formElements = document.forms[0];
                formElements.dispatchEvent(e);

            }else{
                //textareaに入力が有る時
                //windowで　はい(true) or いいえ(false)を保持
                let judge = window.confirm(result);
                if(judge){
                    //はいが押された時
                    div.remove();
                    area.value = "";    
                    
                }else{
                    //いいえが押された時
                    place.checked = true;
                    
                }
            }
        }
    },true);

}


//チェックボックスの状態を配列で貰い全てがチェックが付いているモノをカウントしている。
function check_checkboxs(checkboxs){
    let cnt = 0;
    for(let i in checkboxs){
        if(checkboxs[i].checked){
            cnt++;
        }
    }
    return cnt;
}   

function array_boolean(array){
    let cnt = 0;
    for(let i in array){
        if(array[i]){
            cnt++;
        }
    }
    //arrayの長さとcntが等しい == 全てがtrueなら　　
    return array.length == cnt ? true : false;
}





/*Input_Form_2_1 ～ 3の色々ここまで*/





/*teach_reqのグローバルメニュー↓*/

let navToggle = document.querySelector(".nav__toggle");
let navWrapper = document.querySelector(".nav__wrapper");

navToggle.addEventListener("click", function () {
if (navWrapper.classList.contains("active")) {
    this.setAttribute("aria-expanded", "false");
    this.setAttribute("aria-label", "menu");
    navWrapper.classList.remove("active");
} else {
    navWrapper.classList.add("active");
    this.setAttribute("aria-label", "close menu");
    this.setAttribute("aria-expanded", "true");
}
});

/*teach_reqのグローバルメニュー↑*/

/*ハンバーガーメニューが押されたときの処理*/ 
function hamb_mn() {
    $checked = document.getElementById('menu-btn-check').checked

    if($checked){
    alert('true');
        document.getElementsByClassName('req_form').style.pointerEvents.value = 'none';
    }
} 



/*ログアウト処理　　↓*/
function rog_out_js(){
    if(confirm('ログアウトしてもよろしいですか？')){
        xhr = new XMLHttpRequest();
        xhr.open('POST', '../includes/rog_out.php', true);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
        xhr.send(1);

        window.location.href = '../login.php';
    }
}

/*ログアウト処理　　↑*/


/*データ保存時のalert↓*/

function save_alert() {
    alert('データを保存しました。');
}

/*データ保存時のalert↑*/
