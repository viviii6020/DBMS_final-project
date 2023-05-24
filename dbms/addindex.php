<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge IE=chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>家庭方案揪團平台</title>
  <link rel ='icon' href = 'https://github.com/viviii6020/DBMS_final-project/blob/main/DBMS_final%20project%20logo.png?raw=true' type='image/x-icon' />
  <link rel="stylesheet" href="all.css">
  <link rel="stylesheet" href="addindex.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script> 
 
</head>
<body>
<div class="wrap">
    <div class="header mb-16">
      <nav class="navbar navbar-expand-lg headerBg-w">
              <div class="container-fluid">
                  <img class="logo" src="https://github.com/viviii6020/DBMS_final-project/blob/main/DBMS_final%20project%20logo.png?raw=true" alt="logo">
                <a class="navbar-brand" href="index.php">家庭方案揪團平台</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="index.php">主頁</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="post.php">活動貼文</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addindex.php">新增貼文</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        帳號資訊
                      </a>
                      <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="memberInfo.php">帳號資料</a></li>
                        <li><a class="dropdown-item" href="privateMessage.php">收件匣</a></li>
                        <li><a class="dropdown-item" href="memberpost.php">已發布貼文</a></li>
                        <li><a class="dropdown-item" href="history.php">歷史紀錄</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="collect.php">收藏貼文</a></li>
                      </ul>
                    </li>
                    <li class="nav-item">
                    <?php
                            if (!(isset($_SESSION["dbms_project"]))) {
                            ?>
                                <a class="nav-link" href="login.php">註冊/登入帳號</a>
                            <?php
                            }else{
                            ?>
                            <a class="nav-link" href="logout.php">登出</a>
                            <?php
                            }   
                            ?> 
                    </li>
                  </ul>

                 <!-- 搜尋按鈕和瀏覽人數 -->
                 <div class="d-flex">
                      <a href="searchpage.php"><button action="search.php" class="btn btn-outline-success" type="button">搜尋貼文</button></a>           
                      <p class="browse">瀏覽人數：</p>
                  </div>

                </div>
              </div>
      </nav>
  </div>

  <div class="container">
      <div class="main">
          <h1 class="ta-c fz-30 mt-32 mb-32">新增貼文</h1>
          <form action='./addpost.php' class='form' method="post" id="add_form"  enctype="multipart/form-data">
            <p class='field required half pr-16'>
              <label class='label' for='project'>文章標題</label>
              <input class='text-input' id='project' name='project' required type='text'>
            </p>
            <p class='field half'>
              <label class='label' for='cost'>每人須分攤金額</label>
              <input class='text-input' id='cost' name='cost' type='text'>
            </p>
            <p class='field half required error pr-16'>
              <label class='label' for='groupsize'>需求人數</label>
              <input class='text-input' id='groupsize' name='groupsize' required type='number' >
            </p>
            <p class='field half required'>
              <label class='label' for='platform'>要揪的平台</label>
              <input class='text-input' id='platform' name='platform' required type='text'>
            <div class='field'>
              <label class='label'>付款方式</label>
              <ul class='checkboxes'>
                <li class='checkbox'>
                  <input class='checkbox-input' id='choice-0' name='payment[]' type='checkbox' value='cash'>
                  <label class='checkbox-label' for='choice-0'>現金</label>
                </li>
                <li class='checkbox'>
                  <input class='checkbox-input' id='choice-1' name='payment[]' type='checkbox' value='ATM-transfer'>
                  <label class='checkbox-label' for='choice-1'>ATM轉帳</label>
                </li>
                <li class='checkbox'>
                  <input class='checkbox-input' id='choice-2' name='payment[]' type='checkbox' value='LINE-Pay'>
                  <label class='checkbox-label' for='choice-2'>LINE Pay</label>
                </li>
                <li class='checkbox'>
                  <input class='checkbox-input' id='choice-3' name='payment[]' type='checkbox' value='街口支付'>
                  <label class='checkbox-label' for='choice-3'>街口支付</label>
                </li>
                <li class='checkbox'>
                  <input class='checkbox-input' id='choice-4' name='payment[]' type='checkbox' value='Easy-Pay'>
                  <label class='checkbox-label' for='choice-4'>悠游付</label>
                </li>
              </ul>
            </div>
            
            <p class='field'>
              <label class='label' for='about'>內文</label>
              <textarea class='textarea' cols='50' id='about' name='about' rows='10'></textarea>
            </p>
            <p class='field half'>
              <label class='label' for='start'>開始日期：</label>
              <input type='date' id='start' name='start-time'
                value=''>
            </p>
            <p class='field half'>
              <label class='label' for='end'>截止日期：</label>
              <input type='date' id='end' name='end-time'
                value=''>
            </p>
            <p class='filedhalfrequired'>
              <label for="post_pic" class="form-label label">上傳封面照！</label>
              <input type="file" name="avatar"/>
            </p>
            <p class='field half1'>
              <input type="hidden" value="<?=$type?>" name="type">
              <input class='button mt-16' type='submit' value='送出'>
            </p>
          </form>

      </div>
  </div>
      <div class="footer pt-32">
          <div class="row">
              <div class="col-md-4 ta-c">
                  <img class="logo" src="https://github.com/viviii6020/DBMS_final-project/blob/main/DBMS_final%20project%20logo.png?raw=true" alt="logo">
                  <h4>家庭方案揪團平台</h4>
              </div>
          
              <div class="col-md-4 ta-c">
                  <h4>連結</h4>
                  <ul class="d-flex jc-c">
                      <li><a href="index.php">主頁</a></li>
                      <li><a href="post.php">活動貼文</a></li>
                      <li><a href="#">常見問題</a></li>
                      <li><a href="#">聯絡我們</a></li>
                  </ul>
              </div>
              <div class="col-md-4 ta-c">
                  <h4>聯絡我們</h4>
                  <p>高雄市蓮海路70號<br>
                  E-Mail: <a href="mailto:koparty@gmail.com">dbms@g-mail.nsysu.edu.tw</a></p>
              </div>
          </div>
      </div>
  </div>

</body>
</html>