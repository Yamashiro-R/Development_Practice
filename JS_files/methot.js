
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
    let documents_checkbox = document.querySelectorAll("input[type='checkbox']");
    let savebtn = formElements.elements[15]; 
    let submitbtn = formElements.elements[16]; 
  
    
    //エラー出力先を配列で取得
    let denger = formElements.getElementsByClassName('denger_field');
    
    
    //其々の入力が正常化判断する為の boolean値を格納する為の変数
    let activecompany;
    let activeaddress;
    let activemethot;
    let activedocument_radio;
    let activejob;
    let activenumber;
    let activedocuments_checkbox;
    
    //チェックボックス用の配列とカウント
    let array_checkbox = Array(documents_checkbox.length);
    let checkbox_cnt = 0;
    
    //其々のパラグラフをcreate!!この中にエラー文の文章を格納する。
    let companypara = document.createElement('p');
    let addresspara = document.createElement('p');
    let methotpara = document.createElement('p');
    let jobpara = document.createElement('p');
    let numberpara = document.createElement('p');
    let checkboxpara = document.createElement('p');


    //探索用のカウント
    let cnt = 0;
    //入力値の県名を格納
    let prefecture;


    //保存ボタンをデフォルトで無効化
    savebtn.disabled = true; 
    //一次→ボタンをデフォルトで無効化
    submitbtn.disabled = true;

    console.log( formElements);
    //保存ボタンと一次→ボタンの有効化条件
    
    formElements.addEventListener('input',()=>{
        if(activecompany && activeaddress && activemethot  &&
            activedocument_radio && activejob && activenumber  &&
            activedocuments_checkbox){
                savebtn.disabled = false;
                submitbtn.disabled = false;
            }else{
                savebtn.disabled = true;
                submitbtn.disabled = true;
            }
    });

    formElements.addEventListener('change',()=>{
        if(activecompany == true && activeaddress == true && activemethot == true &&
            activedocument_radio == true && activejob && activenumber == true &&
            activedocuments_checkbox){
                savebtn.disabled = false;
                submitbtn.disabled = false;
            }else{
                savebtn.disabled = true;
                submitbtn.disabled = true;
            }
    });    
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
        

    });
    //応募方法入力欄
    methot.addEventListener("input",()=>{
        switch (methot.value){
            case "0":  //未選択の時
                console.log("テスト");
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
        
    });
    //書類選考の有無チェック欄
    document_radio.addEventListener("change",()=>{
        activedocument_radio = true;
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
            console.log("テスト");
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
    });

    //提出書類チェック欄
    for(let i=0;i<documents_checkbox.length;i++){
        //for文でcheckbox文にそれぞれイベントを追加。
        documents_checkbox[i].addEventListener("change",()=>{
        
            if(documents_checkbox[i].checked){
                //どれかにチェックが入った時
                activedocuments_checkbox = true;
                console.log("チェックが入りました。");
                checkboxpara.textContent = "";
                checkboxpara.id = "row_1_para";
                denger[6].appendChild(checkboxpara);
                activedocuments_checkbox = true;
            }else{
                //配列にチェックボックスそれぞれの状態を格納
                for(let j=0;j<documents_checkbox.length;j++){
                    array_checkbox[j] = documents_checkbox[j].checked;
                }
                //配列のどれかにチェックが入っていたらブレイクその位置を特定するためにcheckbox_cntでカウント
                for(let tmp=0;tmp<array_checkbox.length;tmp++,checkbox_cnt++){
                    if(array_checkbox[tmp]){break;}
                }
                //最後まで到達した時 == 全てfalseの時
                if(checkbox_cnt == documents_checkbox.length){
                    // console.log("テスト：全てのチェックボックスが空");
                    checkboxpara.textContent = "どれかにチェックを入れてください。";
                    checkboxpara.id = "row_1_para";
                    denger[6].appendChild(checkboxpara);
                    activedocuments_checkbox = false;
                    checkbox_cnt = 0;
                }else{
                    // console.log("テスト：どれかにチェックが入っている");
                    checkboxpara.textContent = "";
                    checkboxpara.id = "row_1_para";
                    denger[6].appendChild(checkboxpara);
                    activedocuments_checkbox = true;
                    checkbox_cnt = 0;
                }    
            }
        });

    
    }
} 


/*Input_Form_1バリデーションチェック ここまで*/

/*Input_Form_2_1 ～ 3の色々ここから*/

function Input_Form_2_monitoring(sp_no,text_data){
    
    const checkbox_data = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    let btn = document.querySelector('input[type=submit]:last-child');

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
    console.log("初期値のボタンイベント");
    btn.disabled = flagCnt == array_flag.length ? false : true;



    //どれかに変更が起きたらflagの状態をチェックしてボタンの状態を遷移させる。
    let formElements = document.forms[0];
    console.log(formElements);
   
    formElements.addEventListener('input',()=>{
        array_flag = flag_confirmation();
        flagCnt = 0;
        for( ; flagCnt < array_flag.length ; flagCnt++){
            if(!array_flag[flagCnt]){
                //falseならループを抜ける。
                break
            }
        }
        btn.disabled = flagCnt == array_flag.length ? false : true;
        
    });
    

    if(sp_no.length == 0){
        for(let cnt=0;cnt<checkbox_data.length;cnt++){
            exam_check(cnt);
        }
    }else{
        for(let i in sp_no){
            for(let cnt=0;cnt<checkbox_data.length;cnt++){
                if(( sp_no[i] -1 ) == cnt){
                    console.log("チェックボックスのイベント作らない");
                    continue;
                }else{
                    console.log("チェックボックスのイベント作る");
                    exam_check(cnt);
                }
            }
        }
    }
}


//Input_Form_2
//DBでsp_number(チェックボックス欄)がチェック済みのところをHTMLに反映する。操作用
function fetch_sp_number(sp_no,text_data) {
    
    const checkboxs = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    for(let dbCnt = 0; dbCnt < sp_no.length; dbCnt++){
        for(let cnt = 0; cnt < checkboxs.length; cnt++ ){
            if(sp_no[dbCnt] == cnt){
                //値が一緒の場所にチェックを入れる。
                //jsのinputは0スタート、DBは1スタート
                checkboxs[cnt-1].checked = true;
                initial_value_Text(cnt,text_data[dbCnt]);
                //チェックボックスクリエイトして初期値テキスト代入。
                break;
            }
        }
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
        console.log("初期化" + array_flag[i]);
    }
    //array_flagに 日付,開始日時,終了日時,チェックボックス,テキストエリア の順番でflagの状態を格納。
    

        
    if( date_data.value != null ){
        //初期値を確認するよう。
        //date_dataがある時
        array_flag[0] = true;
    }
    console.log("date_dataのフラグ" + array_flag[0]);
    
    for(let tmp = 0;tmp < time_data.length;tmp++){
        if(time_data[tmp].value != null){ 
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
    console.log("first_timeのフラグ" + array_flag[1]);
    console.log("end_timeのフラグ" + array_flag[2]);
    console.log("array_flagのフラグ数" + array_flag.length);

    //チェックがtrueの数をカウント
    let checkCnt = check_checkboxs(checkbox_data);
    
    console.log("テストレングス" + checkCnt);

    if( checkCnt > 0 ){
        array_flag[3] = true;

        let area = document.querySelectorAll('textarea');
        
        //チェックボックスのチェック数とテキストエリアの数が合って入ればflagをtrueにする。
        //テキストエリアがある == 何かしらの値がセットされている。

        let areaCnt = new Array(checkCnt);

        //作られたテキストエリアの状態を配列areaCntに格納する。
       
        for(let i = 0; i < area.length ; i++){
            if( area[i].value == "" ){
                areaCnt[i] = false;
            }else{
                areaCnt[i] = true;
            }
        }

        console.log(area.length + "エリアlength");
        for(let i =0 ; i < area.length; i++){
            console.log(i + "番目" + areaCnt[i]);
        }
        
        
        
        array_flag[4] = array_boolean(areaCnt);
    }else{
      array_flag[3] = false;  
    } 
    
    return array_flag;
}


function initial_value_Text(checkNo,text){
    console.log("チェックボックス初期値イベント");
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='test_type[]']`);
    

    const div_class = document.getElementsByClassName('exam_test');
    //詳細欄出力場所
    const l1 = document.getElementById('text_info');
    
    //消去注意文
    const result = "記入内容はすべて削除されます。よろしいですか？";

    const exam_type = div_class[checkNo-1].textContent +"詳細内容";
    const textarea_name = "textarea[]";
    //チェックの場所を格納(DBと値を合せるため-1)
    let place = first_exam[checkNo-1];
    

    //タグをそれぞれクリエイト
    let div = document.createElement('div');
    let para = document.createElement('p');
    let area = document.createElement('textarea');
    
    //選択されたチェック欄の題名を出力
    para.textContent = exam_type;
    area.textContent = text;

    //cssの為にclassをそれぞれ追加
    div.classList.add('testsAll');
    para.classList.add('title-tests');
    area.classList.add('text-tests');
    area.name = 'details';

        
    //チェックが入ったら
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
                div.remove();
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
    });
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
    const textarea_name = "textarea[]";
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
    area.name = 'details';

    place.addEventListener('change',()=>{
        
        if(place.checked){
            //チェックが入ったら
            area.name = textarea_name;
            div.appendChild(para);
            div.appendChild(area);            
            
            l1.appendChild(div); 

            area.focus();
        }else{
            //textareaに入力が無い時
            if( area.value == ""){
                div.remove();
                
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
    });

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
//
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
// なんかエラー
// let navToggle = document.querySelector(".nav__toggle");
// let navWrapper = document.querySelector(".nav__wrapper");

// navToggle.addEventListener("click", function () {
// if (navWrapper.classList.contains("active")) {
//     this.setAttribute("aria-expanded", "false");
//     this.setAttribute("aria-label", "menu");
//     navWrapper.classList.remove("active");
// } else {
//     navWrapper.classList.add("active");
//     this.setAttribute("aria-label", "close menu");
//     this.setAttribute("aria-expanded", "true");
// }
// });

/*teach_reqのグローバルメニュー↑*/

/*ハンバーガーメニューが押されたときの処理*/ 
// function hamb_mn() {
//     $checked = document.getElementById('menu-btn-check').checked

//     if($checked){
//     alert('true');
//         document.getElementsByClassName('req_form').style.pointerEvents.value = 'none';
//     }
// } 



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

