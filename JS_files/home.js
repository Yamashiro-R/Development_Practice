    //ホームでタブTOPが押された時
    //TOPを表示して、報告書作成を非表示にする
    function TOP(){
        let TOP_body = document.querySelector(".prot_body1");
        let CreateReport_body = document.querySelector(".prot_body2");
        let TOP_title = document.querySelectorAll(".title");
        console.log(TOP_title);
        
        TOP_body.style.display = "block";
        CreateReport_body.style.display = "none";

        TOP_title[0].style.boxShadow = "2px 0 2px";
        TOP_title[1].style.boxShadow = "none";
        
    }
    //ホームで報告書作成が押された時
    //報告書作成を表示して、TOPを非表示にする
    function CreateReport(){
        let TOP_body = document.querySelector(".prot_body1");
        let CreateReport_body = document.querySelector(".prot_body2");
        let TOP_title = document.querySelectorAll(".title");
        
        console.log(TOP_title);
        
        TOP_body.style.display = "none";
        CreateReport_body.style.display = "block";

        
        TOP_title[0].style.boxShadow = "none";
        TOP_title[1].style.boxShadow = "2px 0 2px";
        
    }

    
