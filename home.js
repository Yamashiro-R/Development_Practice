
function setting(){
    let title = document.querySelectorAll('.new_title > div');
    let body = document.querySelector("prot_body");
    
    let flag = true;
    
    let div_search = document.createElement('div');
    let div_createReport = document.createElement('div');
    let div_saveData = document.createElement('div');

    let search_para = document.createElement('p');
    let create_para = document.createElement('p');
    let save_para = document.createElement('p');

    let searchNode = document.createTextNode("検索");
    let createNode = document.createTextNode("新規作成");
    let saveNode = document.createTextNode("保存済みデータ");

    title[0].addEventListener('click',()=>{
        console.log("テスト");
        if(flag){
            ;
        }else{
            // div_createReport.style.display = "none";
            // div_saveData.style.display = "none";

            // // div_search.innerHTML = "";             //アイコン入力欄
            // search_para.textContent = "検索";  
            // div_search.appendChild(search_para);
            // body.appendChild(div_search);
            // body.style.backgroundColor = "#ffffff";
            // flag = true;   
        }
    });

    title[1].addEventListener('click',()=>{
        console.log("テスト2");
        if(flag){
            
            
            // div_createReport.innerHTML = "";             //アイコン入力欄
            // div_saveData.innerHTML = "";             //アイコン入力欄
           
            create_para.appendChild(createNode);
            div_createReport.appendChild(create_para);

            console.log(create_para);
            console.log(div_createReport);
            console.log(body);
            
            
            body.appendChild(div_createReport); //nullになっている　これを解決する

            /*
            body.appendChild(div_saveData);
            body.style.backgroundColor = "brown";
            flag = false;
           */
        }else{
            ;
        }
                
    });
    // function TOP(){
    //     let body = document.getElementsByClassName("prot_body");
    //     let div = document.createElement('div');
    //     let flag = true;

    //     if(flag){
    //         console.log("ok");
    //     }else{
    //         div.innerHTML = "";             //アイコン入力欄
    //         div.textContent = "検索";  
    //         body.style.backgroundColor = "#ffffff";
    //         flag = true;
    //     }
            
    // }

    // function CreateReport(){
    //     let body = document.getElementsByClassName("prot_body");
    //     let div_1 = document.createElement('div');  //新規作成用のdiv
    //     let div_2 = document.createElement('div');  //保存済みデータ用のdiv
    //     let flag = false;
    //     if(flag){
    //         div_1.innerHTML = "";             //アイコン入力欄
    //         div_1.textContent = "新規作成";

    //         div_2.innerHTML = "";             //アイコン入力欄
    //         div_2.textContent = "保存済みデータ一覧";
    //         body.style.backgroundColor = "brown";
    //         flag = true;
    //     }
        
    // }
}