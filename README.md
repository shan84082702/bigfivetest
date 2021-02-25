## 社群網站上的人格與情緒展現相關性研究

### 問卷

1.bigfivetest_login.html：透過Facebook API進行登入

2.使用者第一次使用該系統(資料庫中沒有其問卷資料)，則連結至bigfivetest1.php開始進行個人資訊的填寫和人格分析測驗，最後顯示人格分析的結果，並將所有填寫的資料儲存至資料庫中

3.若使用者填寫過問卷，則會搜尋資料庫中該使用者的最新貼文，根據該貼文的情緒，推薦對應的食物(例.若判定情緒為joy，系統會推薦馬卡龍、蛋塔等食物)；若無使用者的貼文資料或是貼文沒有明顯的情緒，則一律判定為anticipation

### 貼文上傳

由於後期Facebook API的修改以及審核無法通過，我們無法直接抓取志願者的貼文資料，需由志願者操作Graph API，取得近期100篇貼文的json檔案，再透過updata.html上傳，經過分析後，我們會將需要的資料欄位儲存至我們的資料庫中

### 文章、圖片分析

抓取資料表中未分析的的貼文資料，對文字進行斷詞，統計各情緒詞彙出現的次數，將結果儲存至另一個資料表中

(圖片分析由另一位夥伴撰寫，故未將程式碼呈現在此)

### 資料統計

將他系研究生所要求的統計資料，透過MySQL篩選出來、統計後，製作成EXCEL檔案進行輸出，方便研究生使用



