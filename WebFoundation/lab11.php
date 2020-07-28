<html>
<head>
<title>LRC 歌词编辑器</title>
<style>
    nav ul {
        position: fixed;
        z-index: 99;
        right: 5%;
        border: 1px solid darkgray;
        border-radius: 5px;
        list-style:none;
        padding: 0;
    }

    .tab {
        padding: 1em;
        display: block;
    }

    .tab:hover {
        cursor: pointer;
        background-color: lightgray !important;
    }

    td {
        padding:0.2em;
    }

    textarea[name="edit_lyric"] {
        width: 100%;
        height: 50em;
    }

    input[type="button"] {
        width: 100%;
        height: 100%;
    }

    input[type="submit"] {
        width: 100%;
        height: 100%;
    }

    #td_submit {
        text-align: center;
    }

    select {
        display: block;
    }

    #lyric {
        width: 35%;
        height: 60%;
        border: 0;
        resize: none;
        font-size: large;
        line-height: 2em;
        text-align: center;
    }
</style>
</head>
<body>
    <nav><ul>
        <li id="d_edit" class="tab">Edit Lyric</li>
        <li id="d_show" class="tab">Show Lyric</li>
    </ul></nav>

<!--歌词编辑部分-->
<section id="s_edit" class="content">
<form id="f_upload" enctype="multipart/form-data">
    <p>请上传音乐文件</p>

    <!--TODO: 在这里补充 html 元素，使 file_upload 上传后若为音乐文件，则可以直接播放-->

    <audio src="" controls id = "audio_up">//file_upload change ,the src will change

    </audio>
    <input type="file" name="file_upload">
    <table>
        <tr><td>Title: <input type="text"></td><td>Artist: <input type="text"></td></tr>
        <tr><td colspan="2"><textarea name="edit_lyric" id="edit_lyric"></textarea></td></tr>
        <tr><td><input type="button" value="插入时间标签"></td><td><input type="button" value="替换时间标签"></td></tr>
        <tr><td colspan="2" id="td_submit"><input type="submit" value="Submit"></td></tr>
    </table>
</form>
</section>

<!--歌词展示部分-->
<section id="s_show" class="content">
    <select>
    <!--TODO: 在这里补充 html 元素，使点开 #d_show 之后这里实时加载服务器中已有的歌名-->
    <?php

        $handle = opendir("./"); //当前目录
        while (false !== ($file = readdir($handle))) { //遍历该php文件所在目录
          list($filesname,$kzm)=explode(".",$file);//获取扩展名
            if($kzm=="mp3") { //文件过滤

                echo "<option value=\"$filesname\">$filesname</option>";
              }
        }


     ?>

    </select>

    <textarea id="lyric" readonly="true">
    </textarea>

    <!--TODO: 在这里补充 html 元素，使选择了歌曲之后这里展示歌曲进度条，并且支持上下首切换-->
    <audio controls id="progress" style="display:none"></audio>
</section>
</body>
<script>

// 界面部分
document.getElementById("d_edit").onclick = function () {click_tab("edit");};
document.getElementById("d_show").onclick = function () {click_tab("show");};

document.getElementById("d_show").click();

function click_tab(tag) {
    for (let i = 0; i < document.getElementsByClassName("tab").length; i++) document.getElementsByClassName("tab")[i].style.backgroundColor = "transparent";
    for (let i = 0; i < document.getElementsByClassName("content").length; i++) document.getElementsByClassName("content")[i].style.display = "none";

    document.getElementById("s_" + tag).style.display = "block";
    document.getElementById("d_" + tag).style.backgroundColor = "darkgray";
}

// Edit 部分
var edit_lyric_pos = 0;
document.getElementById("edit_lyric").onmouseleave = function () {
    edit_lyric_pos = document.getElementById("edit_lyric").selectionStart;
};

// 获取所在行的初始位置。
function get_target_pos() {
    return get_target_pos(edit_lyric_pos);
}

function get_target_pos(n_pos) {
    let value = document.getElementById("edit_lyric").value;
    let pos = 0;
    for (let i = n_pos; i >= 0; i--) {
        if (value.charAt(i) === '\n') {
            pos = i + 1;
            break;
        }
    }
    return pos;
}

// 选中所在行。
function get_target_line(n_pos) {
    let value = document.getElementById("edit_lyric").value;
    let f_pos = get_target_pos(n_pos);
    let l_pos = 0;

    for (let i = f_pos;; i++) {
        if (value.charAt(i) === '\n') {
            l_pos = i + 1;
            break;
        }
    }
    return [f_pos, l_pos];
}


  var file = document.getElementsByName('file_upload')[0];
  var au1 = document.getElementById('audio_up');
  var au2 = document.getElementById('progress');
  var form = document.getElementById('f_upload');



  file.onchange = function a() {

    var filePath  = file.files[0];
    var title = document.getElementsByTagName('input')[1];

    title.value=(filePath.name.split(".")[0]);
    document.getElementById('audio_up').src = URL.createObjectURL(filePath);

  }

  document.getElementsByTagName('select')[0].onchange = function() {
    var pro = document.getElementById('progress');
    pro.style.display = "block";
    pro.src=document.getElementsByTagName('select')[0].value+".mp3";
  }


/* HINT:
 * 已经帮你写好了寻找每行开头的位置，可以使用 get_target_pos()
 * 来获取第一个位置，从而插入相应的歌词时间。
 * 在 textarea 中，可以通过这个 DOM 节点的 selectionStart 和
 * selectionEnd 获取相对应的位置。
 *
 * TODO: 请实现你的歌词时间标签插入效果。
 */
 document.getElementsByTagName('input')[3].onclick = function() {

   let value = document.getElementById("edit_lyric").value;
   var position =get_target_pos(edit_lyric_pos);

   var str1 = value.substr(0,position);

   var str2 = value.substr(position);

   var t1 = parseInt(au1.currentTime);

   var t2 = parseInt(t1/60-t1/3600);

   var t3 = parseInt(t1/3600);

   var t4 = parseInt(t1)-(t1/60)*60;

   var newStr = str1+"["+t3+":"+t2+":"+t1+"]"+str2;
   document.getElementById("edit_lyric").value = newStr;

 }
/* TODO: 请实现你的上传功能，需包含一个音乐文件和你写好的歌词文本。
 */
 form.onsubmit = function upload() {

   var filePath  = file.files[0];
   let value = document.getElementById("edit_lyric").value;

   xmlhttp.open("post","lab11Up.php",true);
   xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");

   xmlhttp.send("file="+filePath+"&lyric="+value);//将歌与歌词文件发出



 }
/* HINT:
 * 实现歌词和时间的匹配的时候推荐使用 Map class，ES6 自带。
 * 在 Map 中，key 的值必须是字符串，但是可以通过字符串直接比较。
 * 每一行行高可粗略估计为 40，根据电脑差异或许会有不同。
 * 当前歌词请以粗体显示。
 * 从第八行开始，当歌曲转至下一行的时候，需要调整滚动条，使得当前歌
 * 词保持在正中。
 *
 * TODO: 请实现你的歌词滚动效果。
 */




 au2.ontimeupdate = function upDate() {

   var lyricTotalAr=[
       '[00:00.00] 夜曲',
       '[00:04.73]',
       '[00:06.01]词：方文山   曲：周杰伦',
       '[00:09.79]演唱：周杰伦',
       '[00:13.64]',
       '[00:25.09]一群嗜血的蚂蚁 被腐肉所吸引',
       '[00:28.12]我面无表情 看孤独的风景',
       '[00:31.23]失去你 爱恨开始分明',
       '[00:33.66]失去你 还有什么事好关心',
       '[00:36.69]当鸽子不再象征和平',
       '[00:38.61]我终于被提醒 广场上喂食的是秃鹰',
       '[00:42.28]我用漂亮的押韵 形容被掠夺一空的爱情',
       '[00:46.25]',
       '[00:47.26]啊 乌云开始遮蔽 夜色不干净',
       '[00:49.90]公园裡 葬礼的回音 在漫天飞行',
       '[00:52.79]送你的 白色玫瑰 在纯黑的环境凋零',
       '[00:55.97]乌鸦在树枝上诡异的很安静',
       '[00:58.12]静静听 我黑色的大衣',
       '[01:00.62]想溫暖你 日渐冰冷的回忆',
       '[01:02.76]走过的 走过的生命',
       '[01:04.07]啊 四周弥漫雾气 啊 我在空旷的墓地',
       '[01:06.87]老去后还爱你',
       '[01:08.85]',
       '[01:09.46]为你弹奏萧邦的夜曲 纪念我死去的爱情',
       '[01:14.94]跟夜风一样的声音 心碎的很好听',
       '[01:20.49]手在键盘敲很轻 我给的思念很小心',
       '[01:25.94]你埋葬的地方叫幽冥',
       '[01:30.18]',
       '[01:30.60]为你弹奏萧邦的夜曲 纪念我死去的爱情',
       '[01:37.08]而我为你隐姓埋名 在月光下弹琴',
       '[01:42.54]对你心跳的感应 还是如此温热亲近',
       '[01:48.06]怀念你那鲜红的唇印',
       '[01:54.17]',
       '[02:15.47]那些断翅的蜻蜓 散落在这森林',
       '[02:18.43]而我的眼睛 没有丝毫同情',
       '[02:21.55]失去你 泪水混浊不清',
       '[02:23.93]失去你 我连笑容都有阴影',
       '[02:27.02]风在长满青苔的屋顶 嘲笑我的伤心',
       '[02:30.32]像一口没有水的枯井',
       '[02:32.50]我用凄美的字型 描绘后悔莫及的那爱情',
       '[02:36.64]',
       '[02:37.54]为你弹奏萧邦的夜曲 纪念我死去的爱情',
       '[02:43.21]跟夜风一样的声音 心碎的很好听',
       '[02:48.75]手在键盘敲很轻 我给的思念很小心',
       '[02:54.26]你埋葬的地方叫幽冥',
       '[02:58.42]',
       '[02:58.82]为你弹奏萧邦的夜曲 纪念我死去的爱情',
       '[03:05.36]而我为你隐姓埋名 在月光下弹琴',
       '[03:10.85]对你心跳的感应 还是如此温热亲近',
       '[03:16.34]怀念你那鲜红的唇印',
       '[03:21.04]',
       '[03:21.77]一群嗜血的蚂蚁 被腐肉所吸引',
       '[03:24.66]我面无表情 看孤独的风景',
       '[03:27.67]失去你 爱恨开始分明',
       '[03:30.13]失去你 还有什么事好关心',
       '[03:33.07]当鸽子不再象征和平',
       '[03:35.11]我终于被提醒 广场上喂食的是秃鹰',
       '[03:38.74]我用漂亮的押韵 形容被掠夺一空的爱情',
       '[03:43.24]'
   ];
  //歌词
   var timeAr;
   var lyricAr;
   var count = 0;


   function formatTime(time){
       var m = time.split(':')[0];
       var s = time.split(':')[1];
       return Number(m)*60+Number(s);
   };

   for(var i = 0;i<lyricTotalAr.length;i++){
     alert(lyricTotalAr[i]);
      timeAr[i] = formatTime(lyricTotalAr[i].substring(1,5));  //获得时间
      lyricAr[i] = lyricTotalAr[i].substr(9);   //获得歌词
   }

   for(var i=0 ; i<lyricAr.length;i++){   //歌词导入
       var lyricBorder = document.getElementById('lyric');
       var lyricEl = document.createElement('li');
       lyricEl.innerHTML = lyricAr[i];
       lyricBorder.appendChild(lyricEl);
   }

   var testTime = function(time,index){

       if(index<lyricArray.length-1){
           if(time>=timeAr[index-1]&&time<=timeAr[index+1]){//如果在两句之间
               return true;
           }else{
               return false;
           }
       }else{
           if(time<=au2.duration){
               return true;
           }else{
               return false;
           }
       }

   };

   var wordEl = document.getElementById('lyric');
   var marTop = parseInt(wordEl.style.marginTop);


   au2.ontimeupdate = function() {
     var time = audio.currentTime;
     if(!testTime(time,count)) {
         count++;
     }
     wordEl.style.marginTop = (marTop-count*48)+'px';

     var li = wordEl.querySelectorAll('li');
     for(var i = 0 ; i < li.length ; i++){
         li[i].style.fontWeight('normal');
     }
     wordEl.querySelectorAll('li')[count].style.fontWeight('bold');

   }

 }

</script>
</html>
