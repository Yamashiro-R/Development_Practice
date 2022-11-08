var l1 = document.getElementById('text_info');
var fen = document.getElementsByClassName('first-exam_test');

let first_exam = document.querySelectorAll(`input[type='checkbox'][name='First-stage exam']`);

for (let i = 0; i < first_exam.length;i++) {
    exam_detail(first_exam,i);
}

function exam_detail(first_exam,i){

    first_exam[i].addEventListener('click',function(){
        if (this.checked) {
            l1.innerHTML += '<div id="new'+ i +'" class="testsAll"><p class="title-tests">' + fen[i].textContent + '内容詳細：</p><textarea  class="text-tests" name="details"></textarea></div>';
            check[i] = document.getElementById(ii).textContent;

        } else {
            var ii = 'new' + i;
            var c_name = document.getElementById(ii).lastElementChild.value;
            if(c_name == ""){
                document.getElementById(ii).remove();
            }else{
                var result = window.confirm("記入内容はすべて削除されます。よろしいですか？");

                if(result){
                    document.getElementById(ii).remove();
                }else{
                    first_exam[i].checked = true;
                }
            }
        }},false);
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