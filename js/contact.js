// Contact Form
// AcroReach.co.jp 金全凱　2021-09-26
function validateForm() {
  //お問合せ内容
  var subject = document.forms["myForm"]["subject"].value;
  //会社名
  var companyNm = document.forms["myForm"]["companyNm"].value;
  //会社名フリガナ
  var companyKanaNm = document.forms["myForm"]["companyKanaNm"].value;
  //住　所
  var address = document.forms["myForm"]["address"].value;
  //電話番号(ハイフンなし) 
  var telno = document.forms["myForm"]["telno"].value;
  //メールアドレス
  var email = document.forms["myForm"]["email"].value;
  //担当名
  var contactor = document.forms["myForm"]["contactor"].value;
  //ホームページもしくはネットショップリング
  var hpLink = document.forms["myForm"]["hpLink"].value;
  //ご要望
  var message = document.forms["myForm"]["message"].value;
  document.getElementById("error-msg").style.opacity = 0;
  document.getElementById('error-msg').innerHTML = "";
  if (subject == "" || subject == null) {
    showErrorMsg("問い合わせ内容を選択してください。");
    return false;
  }
  if (companyNm == "" || companyNm == null) {
    showErrorMsg("会社名を入力してください。");
    return false;
  }
  if (companyKanaNm == "" || companyKanaNm == null) {
    showErrorMsg("フリガナを入力してください。");
    return false;
  }
  if (address == "" || address == null) {
    showErrorMsg("住所を入力してください。");
    return false;
  }
  if (telno == "" || telno == null) {
    showErrorMsg("電話番号を入力してください。");
    return false;
  }
  if (email == "" || email == null) {
    showErrorMsg("メールアドレスを入力してください。");
    return false;
  }
  if (contactor == "" || contactor == null) {
    showErrorMsg("担当名を入力してください。");
    return false;
  }
  if (hpLink == "" || hpLink == null) {
    showErrorMsg("ホームページもしくはネットショップリングを入力してください。");
    return false;
  }
  if (message == "" || message == null) {
    showErrorMsg("ご要望を入力してください。");
    return false;
  }
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("simple-msg").innerHTML = this.responseText;
      // document.forms["myForm"]["subject"].value = "";
      // document.forms["myForm"]["companyNm"].value = "";
      // document.forms["myForm"]["companyKanaNm"].value = "";
      // document.forms["myForm"]["address"].value = "";
      // document.forms["myForm"]["telno"].value = "";
      // document.forms["myForm"]["email"].value = "";
      // document.forms["myForm"]["contactor"].value = "";
      // document.forms["myForm"]["hpLink"].value = "";
      // document.forms["myForm"]["message"].message = "";
    }
  };
  xhttp.open("POST", "php/contact.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("subject=" + subject + "&companyNm=" + companyNm + 
  "&companyKanaNm=" + companyKanaNm + "&address=" + address + 
  "&telno=" + telno + "&email=" + email + 
  "&contactor=" + contactor + "&hpLink=" + hpLink + "&message=" + message);
  return false;
}

function showErrorMsg(msg){
  document.getElementById('error-msg').innerHTML = "<div class='alert alert-warning error_message'>*" + msg +  "*</div>";
  fadeIn();
}

function fadeIn() {
  var fade = document.getElementById("error-msg");
  var opacity = 0;
  var intervalID = setInterval(function () {
    if (opacity < 1) {
      opacity = opacity + 0.5
      fade.style.opacity = opacity;
    } else {
      clearInterval(intervalID);
    }
  }, 200);
}