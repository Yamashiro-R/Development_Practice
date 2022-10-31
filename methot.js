/*
var s2_1 = document.getElementById('wri_test');
var s2_2 = document.getElementById('wri_test2');
var s2_3 = document.getElementById('apt_test');
*/
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







/*

s2_1.addEventListener('click',function(){
if (this.checked) {
    l1.innerHTML = '<p class="p-info">筆記(専門)<br>内容詳細：</span></p><textarea id="once_starge_exam_detail" class=" Input_Form_2_1_input-view"></textarea>';
} else {
    l1.innerHTML = '';
}},false);

var l2 = document.getElementById('text_info2');
s2_2.addEventListener('click',function(){
    if (this.checked) {
        l2.innerHTML = '筆記(一般常識)内容詳細：<textarea id="once_starge_exam_detail" class=" Input_Form_2_1_input-view test-a"></textarea>';
    } else {
        l2.innerHTML = '';
    }},false);


var l3 = document.getElementById('text_info3');
s2_3.addEventListener('click',function(){
    if (this.checked) {
        l3.innerHTML = '適性検査(専門)内容詳細：<textarea id="once_starge_exam_detail" class=" Input_Form_2_1_input-view"></textarea>';
    } else {
        l3.innerHTML = '';
    }},false);
    
    */