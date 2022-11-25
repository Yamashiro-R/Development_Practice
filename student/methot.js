

function setting_detail(){
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='test_type']`);
    
    for(let i=0;i<first_exam.length;i++){
        exam_check(i);
    }
}


function exam_check(cnt){
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='test_type']`);
    const div_class = document.getElementsByClassName('exam_test');
    //詳細欄出力場所
    const l1 = document.getElementById('text_info');
    //消去注意文
    const result = "記入内容はすべて削除されます。よろしいですか？";
    const exam_type = div_class[cnt].textContent +"詳細内容";
    
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


    
    place.addEventListener('input',()=>{
        if(place.checked){
            //チェックが入ったら
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
      


//Input_Form_2_1バリデーションチェック用↓
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
    let savebtn = formElements.elements[16]; 
    let submitbtn = formElements.elements[17]; 
    
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

    //保存ボタンと一次→ボタンの有効化条件
    formElements.addEventListener('input',()=>{
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
        xhr.open('POST', 'includes/rog_out.php', true);
        xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded;charset=UTF-8');
        xhr.send(1);
    }
}

/*ログアウト処理　　↑*/
