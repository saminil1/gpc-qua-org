<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form 양식 만들기</title>
    <style>
  @import "reset.css";

.main{
	padding: 5px;
}      
 * {
     margin: 0 auto;
     padding: 0;
 }
        
 html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}

article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}
body {
	line-height: 1;
}
ol, ul {
	list-style: none;
}
blockquote, q {
	quotes: none;
}
blockquote:before, blockquote:after,
q:before, q:after {
	content: '';
	content: none;
}
table {
	border-collapse: collapse;
	border-spacing: 0;
}       
        
        
  
* {
    margin:0;
    padding:0;
}
① ul {
    list-style-type: none;
}
② body {
    font-family:"맑은고딕", "돋움";
    font-size:12px;
    color:444444;
}
#login_box {
    width:220px;
    height:120px;
    border:solid 1px #bbbbbb;
    border-radius:15px;
    margin:10px 0 0 10px;
    padding:10px 0 0 15px;
}
③ h2 {
    font-family:"Arial";
    margin-bottom:10px;
}
④ #login_box input {
    width:100px;
    height:18px;
}
⑤ #id_pass, #login_btn {
    display: inline-block;
    vertical-align: top; 
}
⑥ #id_pass span {
    display: inline-block;
    width:20px;
}
#pass {
    margin-top:3px;
}
⑦ #login_btn button {
    margin-left:5px;
    padding:12px;
    border-radius:5px;
}
⑧ #btns {
    margin:12px 0 0 0;
    text-decoration:underline;    
}
⑨ #btns li {
    margin-left:10px;
    display:inline;
}        
        
        
        
        
        
        
        
① ul {
     list-style-type: none;
 }
 h3 {
     margin: 20px 0 0 50px;
 }
② #mem_form {
     width: 500px;
     margin: 10px 0 0 50px;
     font-family: "돋움";
     font-size: 12px;
     color: #444444;
     padding-top: 5px;
     padding-bottom: 10px;
     border-top: solid 1px #cccccc;
     border-bottom: solid 1px #cccccc;
 }
③ .cols li {
     display: inline-block; 
     margin-top: 5px;
 }
④ .cols li.col1 {
     width: 100px;
     text-align: right;
 }
⑤ .cols li.col2 {
     width: 350px;
 }
⑥ .cols li.col2 input.hp {
     width: 35px;
 }
⑦ #intro {
     vertical-align: top; 
 }
 </style>
</head>
<body>
 <form>
  <div id="login_box">
    <h2>Member Login</h2>
    <ul id="input_button">
      <li id="id_pass">
        <ul>
          <li>
            <span>ID</span>
            <input type="text">
          </li> <!-- id -->
          <li id="pass">    
            <span>PW</span>
            <input type="password">            
          </li> <!-- pass -->
        </ul>
      </li>
      <li id="login_btn">
        <button>로그인</button>
      </li>
    </ul>    
    <ul id="btns">
      <li>회원 가입</li>
      <li>아이디/비밀번호 찾기</li>
    </ul>
  </div> <!-- login_box -->
</form>
 
 
 
 <br><br><br>
 
 
 
 
  <h3>가입 양식</h3>
 <form>
   <ul id="mem_form">
     <li>
       <ul class="cols">
         <li class="col1">아이디 :</li>
         <li class="col2"><input type="text"></li>
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">비밀번호 :</li>
        <li class="col2"><input type="password"></li>
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">비밀번호 확인 :</li>
        <li class="col2"><input type="password"></li>    
       </ul>
     </li>
     <li>
       <ul class="cols">
         <li class="col1">이름 :</li>
         <li class="col2"><input type="text"></li>    
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">성별 :</li>
       <li class="col2"><input type="radio" name="sex" selected> 여성 &nbsp;&nbsp;
        <input type="radio" name="sex"> 남성 </li>    
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">휴대전화 :</li>
        <li class="col2">
          <select>
            <option>010</option>
            <option>011</option>
            <option>017</option>
          </select> - 
        <input class="hp" type="text"> - <input class="hp" type="text"></li>    
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">이메일 :</li>
        <li class="col2"><input id="email1" type="text"> @
          <select id="email2">
            <option>선택</option>
            <option>naver.com</option>
            <option>hanmail.net</option>
            <option>gmail.com</option>
          </select></li>    
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1">취미 :</li>
        <li class="col2">
        <input type="checkbox" name="hobby1"> 음악감상
        <input type="checkbox" name="hobby2"> 독서
       <input type="checkbox" name="hobby3"> 등산</li>    
      </ul>
    </li>
    <li>
      <ul class="cols">
        <li class="col1" id="intro">자기소개 :</li>
         <li class="col2">
         <textarea cols="35" rows="5"></textarea></li>    
        </ul>
      </li>
      <li>
        <ul class="cols">
          <li class="col1">파일 첨부 :</li>
          <li class="col2">
          <input type="file">* 2MB까지 가능</li>    
      </ul>
    </li>
  </ul>
</form>  
</body>
</html>