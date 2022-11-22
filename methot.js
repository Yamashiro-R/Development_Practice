
var s2_1 = document.getElementById('wri_test');
var s2_2 = document.getElementById('wri_test2');
var s2_3 = document.getElementById('apt_test');


var l1 = document.getElementById('text_info');
var fen = document.getElementsByClassName('first-exam_test');

let first_exam = document.querySelectorAll(`input[type='checkbox'][name='First-stage exam']`);
/*
for (let i = 0; i < first_exam.length;i++) {
    exam_detail(first_exam,i);
}*/

//Input_2_2～3のチェックボタンに応じてtextareaが出力される処理。


function exam_detail(first_exam,i){



    first_exam[i].addEventListener('click',function(){


        if (this.checked) {
                divs[i] = document.createElement('div');
                paras[i] = document.createElement('p');
                textareas[i] = document.createElement('textarea');

                divs[i].id = 'div_' + i;
                divs[i].classList.add('testsAll');

                paras[i].classList.add('title-tests');

                textareas[i].classList.add('text-tests');
                textareas[i].name = 'details';
            
                paras[i].textContent = fen[i].textContent +"詳細内容";

                divs[i].appendChild(paras[i]);
                divs[i].appendChild(textareas[i]);      
                l1.appendChild(divs[i]);
        
            /*check[i] = document.getElementById(ii).textContent;*/

        } else {
            var di = 'div_' + i;
            var c_name = document.getElementById(di).lastElementChild.value;
            if(c_name == ""){
                document.getElementById(di).remove();
            }else{
                var result = window.confirm("記入内容はすべて削除されます。よろしいですか？");

                if(result){
                    document.getElementById(di).remove();
                }else{
                    first_exam[i].checked = true;
                }
            }
            divs[i].getElementsByClassName('text-tests').value = "";

        }
    },false);
}

function exam_check(cnt){
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='First-stage exam']`);
    const div_class = document.getElementsByClassName('first-exam_test');
    //消去注意文
    const result = "記入内容はすべて削除されます。よろしいですか？";
    
    let exam_type = div_class[cnt].textContent +"詳細内容";
    let place = first_exam[cnt];
    let div = document.createElement('div');
    let para = document.createElement('p');
    let area = document.createElement('textarea');
    
    para.textContent = exam_type;
    
    div.classList.add('testsAll');
    para.classList.add('title-tests');
    area.classList.add('text-tests');
    area.name = 'details';


    
    place.addEventListener('input',()=>{
        if(place.checked){
            div.appendChild(para);
            div.appendChild(area);
            l1.appendChild(div); 
        }else{
            console.log(area.value);
            //textareaに入力が無い時
            if( area.value == ""){
                div.remove();
            }else{
                //textareaに入力が有る時
                let judge = window.confirm(result);
                if(judge){
                    div.remove();
                    area.value = "";    
                }else{
                    place.checked = true;
                }
                
                
            }
        }
    });

}

function setting_detail(){
    const first_exam = document.querySelectorAll(`input[type='checkbox'][name='First-stage exam']`);
    
    for(let i=0;i<first_exam.length;i++){
        exam_check(i);
    }
}

/*
function exam_detail_2(){
    let div_class = document.getElementsByClassName('first-exam_test');

    //筆記(専門)
    let hikki1 = first_exam[0];
    //筆記(一般)
    let hikki2 = first_exam[1];
    //適性(専門)
    let tekisei1 = first_exam[2];
    //適性(一般)
    let tekisei2 = first_exam[3];

    




    
    //div,p,textareaをクリエイト
    let hikki1_div = document.createElement('div');
    let hikki1_para = document.createElement('p');
    let hikki1_area = document.createElement('textarea');
    
    let hikki2_div = document.createElement('div');
    let hikki2_para = document.createElement('p');
    let hikki2_area = document.createElement('textarea');


   

    hikki1_area.id = "test";
    hikki1_para.textContent = div_class[0].textContent +"詳細内容";

    //消去注意文
    let result = "記入内容はすべて削除されます。よろしいですか？";

    //筆記(専門)
    hikki1.addEventListener('input',()=>{
        if(hikki1.checked){
            hikki1_div.appendChild(hikki1_para);
            hikki1_div.appendChild(hikki1_area);
            l1.appendChild(hikki1_div); 
        }else{
            console.log(hikki1_area.value);
            //textareaに入力が無い時
            if( hikki1_area.value == ""){
                hikki1_div.remove();
            }else{
                //textareaに入力が有る時
                window.confirm(result);
                console.log(hikki1_div);
                hikki1_div.remove();
                hikki1_area.value = "";
                
            }
        }
    });

    //筆記(一般)
    hikki2.addEventListener('input',()=>{
        if(hikki2.checked){
            hikki2_div.appendChild(hikki2_para);
            hikki2_div.appendChild(hikki2_area);
            console.log(hikki2_div);
            l1.appendChild(hikki2_div); 
        }else{
            console.log(hikki2_area.value);
            if( hikki2_area.value == ""){
                hikki2_div.remove();
            }else{
                window.confirm(result);
                hikki2_div.remove();
            }
        }
    });



}*/


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
      


/*
バリデーションチェックが完成次第消す予定

function Input_Form_1_check() {
    let formElements = document.forms[0];
    let flag = false;
    let firstflag = true;
    let arraycheck = Array(7);  //チェックぼっくボックスのboolen値を格納する配列
    let i = 0; //チェックボックスの添え字
    
    let checkfalg = false;
    
    

    //-3は不要なボタン数    
    for(let cnt=0; cnt < formElements.elements.length-4;cnt++){
        switch(cnt){
            case 0:
            case 1:
            case 2:
            case 5:
            case 6:
                if(formElements.elements[cnt].value != ""){
                    ;
                }else{
                    alert(cnt + "番目入力無し");
                    firstflag = false;
                }
                break;

            case 3:     //書類の有無チェック
            case 4:
                if(formElements.elements[cnt].checked){
                    flag = true;   
                }
                if( cnt == 4 ){
                    if(flag){
                        alert("ok");
                    }else {
                        alert("チェックが入っていません。");
                    }
                }
                break;
            
            default:
                //どれか一つでもtrueならok
                if(formElements.elements[cnt].checked){
                    checkfalg = true;
                }       
        }
    }
    //チェックボックス欄に一つでもチェックが入っているかの判定
    if(checkfalg){
        ;
    }else{
        alert("チェックボックス確認して");       
    }
    
    if(flag && checkfalg && firstflag ){
        formElements.elements['hantei'].value = true;
    }else{
        formElements.elements['hantei'].value = false;    
    }


    

}
*/

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
    let documents_checkbox = document.getElementById("documents_checkbox");
    let savebtn = formElements.elements[16]; 
    let submitbtn = formElements.elements[17]; 
    
    //エラー出力先を配列で取得
    let denger = formElements.getElementsByClassName('denger_field');
    console.log(denger);
    
    //其々の入力が正常化判断する為の boolean値を格納する為の変数
    let activecompany;
    let activeaddress;
    let activemethot;
    let activedocument_radio;
    let activejob;
    let activenumber;
    let activedocuments_checkbox;
    
    //其々のパラグラフをcreate!!この中にエラー文の文章を格納する。
    let companypara = document.createElement('p');
    let addresspara = document.createElement('p');
    let methotpara = document.createElement('p');
    let jobpara = document.createElement('p');
    let numberpara = document.createElement('p');

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

            console.log("カウントの値：" + cnt);

            if(cnt < 47) {  //都道府県名で探索成功の時
                addresspara.textContent = "";
                addresspara.id = "row_1_para";
                denger[1].appendChild(addresspara);
                activeaddress = true;
                console.log("成功");
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
        console.log("変更ok");
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
    documents_checkbox.addEventListener("change",()=>{
        let div_sele = document.getElementsByClassName('docu_sele');
            console.log(div_sele);
    });




    
}


function parseStrToBoolean(str){
    return (str == true) ? true : false;
}





    
        if (formElements.elements[1].value == formElements.elements[2].value) {
            ;
        } else {
            alert("パスワードが間違っています。");
            formElements.elements[1].value = null;
            formElements.elements[2].value = null;
        }

}