<?php
    include 'includes/login.php';
?>

<!DOCTYPE html>
    <html lang="ja">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="cssfiles/style.css">
            <link rel="stylesheet" href="cssfiles/style_dv_dvS.css">
            <title>就職活動データ検索</title>
        </head>
        <body>
            <div>
                <div class="return">
                    <a href="./houkoku.html"><img src="images/innu.jpeg"></a>
                </div>
                <div id="main_title"> 
                    <h1>就職活動<br class="br-sp">データ検索</h1>
                </div>

                <div>
                    <form class="dvSform" action="">
                        <!-- <div class="dvStop">
                            <div class="dvSname"> -->
                        <div>
                             <p>
                                <label>企業名で検索<br><input type="text" name="comp_name"></label>
                            </p>
                            <p>
                                <label>所在地<br><span class="small">※市町村で記入<br>(県外の場合は県名で記入)</span><br><input type="text" name="comp_address"> </label>
                            </p>
                            <p>
                                <label>職種で検索<br><input type="text" name="job"> </label>
                                <div class="button"><input type="submit" value="🔍検索"></div> 
                            </p>
                        </div>
                    </form>
                            <!-- </div>
                            <div class="dvSivf">
                                <p>面接形式：</p>
                                <p>
                                    <select name="ivformat">
                                        <option>個別面接</option>
                                        <option>集団面接</option>
                                        <option>ディスカッション等</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                        <div class="dvScheck">
                            <p>選考方法：</p>
                            <p class="dvscheck_p">
                                <label><input type="checkbox" name="slctmth" value="1">筆記(専門)</label>
                                <label><input type="checkbox" name="slctmth" value="2">筆記(一般常識)</label>
                                <br class="br-spr"> 
                                <label><input type="checkbox" name="slctmth" value="3">適性検査(専門)</label>
                                <label><input type="checkbox" name="slctmth" value="4">適性検査(一般常識)</label>
                                <br class="br-spr"> 
                                <label><input type="checkbox" name="slctmth" value="5">面接(個別)</label>
                                <label><input type="checkbox" name="slctmth" value="6">面接(集団)</label>
                                <label><input type="checkbox" name="slctmth" value="7">面接(ディスカッション等)</label>
                                <label><input type="checkbox" name="slctmth" value="8">実技</label>
                                <label><input type="checkbox" name="slctmth" value="9">作文(論文)</label>
                                <label><input type="checkbox" name="slctmth" value="10">その他</label>
                                <br class="br-sp">
                            </p> --> 
                        <!-- </div> -->
                </div>
                <div>
                    <table class="dvtable">
                        <thead>
                            <tr>
                                <th scope="col">最終更新日</th>
                                <th scope="col">企業名</th>
                                <th scope="col">所在地</th>
                                <th scope="col">職種</th>
                                <th scope="col">申請状況</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="row1">
                                <td class="day">2022/5/4</td>
                                <td class="comp-name">○○○○株式会社<button class="dvtable-view">詳細閲覧</button></td>
                                <td class="address">那覇市</td>
                                <td class="job">SE</td>
                                <td class="satus">未申請</td>
                            </tr>
                            <tr class="row2">
                                <td class="day"></td>
                                <td class="comp-name"></td>
                                <td class="address"></td>
                                <td class="job"></td>
                                <td class="satus"></td>
                            </tr>
                            <tr class="row3">
                                <td class="day"></td>
                                <td class="comp-name"></td>
                                <td class="address"></td>
                                <td class="job"></td>
                                <td class="satus"></td>
                            </tr>
                            <tr class="row4">
                                <td class="day"></td>
                                <td class="comp-name"></td>
                                <td class="address"></td>
                                <td class="job"></td>
                                <td class="satus"></td>
                            </tr>
                            <tr class="row5">
                                <td class="day"></td>
                                <td class="comp-name"></td>
                                <td class="address"></td>
                                <td class="job"></td>
                                <td class="satus"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <footer>
                    <div class="change">
                           <button onclick="location.href='#!'">← 前</button>  <!-- <span class="dvspan">1</span>-->  <button onclick="location.href='#!'">次 →</button> 
                    </div>
                </footer>

            </div>

        </body>
    
    </html>


</html>