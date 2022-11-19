
function setting(){


    
    // let title = document.querySelectorAll('.new_title > div');
    // let body = document.querySelector(".prot_body");
    
    // let flag = true;
    
    // let div_search = document.createElement('div');
    // let div_createReport = document.createElement('div');
    // let div_saveData = document.createElement('div');

    // let search_para = document.createElement('p');
    // let create_para = document.createElement('p');
    // let save_para = document.createElement('p');

    // let searchNode = document.createTextNode("検索");
    // let createNode = document.createTextNode("新規作成");
    // let saveNode = document.createTextNode("保存済みデータ");

    // search_para.classList.add("body_p");
    // create_para.classList.add("body_p");
    // save_para.classList.add("body_p");

    // title[0].addEventListener('click',()=>{
    //     console.log("テスト");
    //     if(flag){
    //         ;
    //     }else{
    //         div_createReport.style.display = "none";
    //         div_saveData.style.display = "none";

    //         // div_search.innerHTML = "";             //アイコン入力欄
    //         search_para.appendChild(searchNode);  
    //         div_search.appendChild(search_para);
    //         body.appendChild(div_search);
    //         body.style.backgroundColor = "#ffffff";
    //         flag = true;   
    //     }
    // });

    // title[1].addEventListener('click',()=>{
    //     console.log("テスト2");
    //     if(flag){
    //         div_search.style.display = "none";
    //         // div_createReport.innerHTML = "";             //アイコン入力欄
    //         // div_saveData.innerHTML = "";             //アイコン入力欄
           
    //         create_para.appendChild(createNode);
    //         save_para.append(saveNode);
    //         div_createReport.appendChild(create_para);
    //         div_saveData.appendChild(save_para);
            
    //         body.appendChild(div_createReport); 
    //         body.appendChild(div_saveData);
    //         body.style.backgroundColor = "brown";
    //         flag = false;
           
    //     }else{
    //         ;
    //     }
                
    //});
}

    function TOP(){
        let TOP_body = document.querySelector(".prot_body1");
        let CreateReport_body = document.querySelector(".prot_body2");
        TOP_body.style.display = "block";
        CreateReport_body.style.display = "none";
        
            
    }

    function CreateReport(){
        let TOP_body = document.querySelector(".prot_body1");
        let CreateReport_body = document.querySelector(".prot_body2");
        TOP_body.style.display = "none";
        CreateReport_body.style.display = "block";
        
        
    }
