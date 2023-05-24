<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家庭方案揪團平台</title>
    <link rel ='icon' href = 'https://github.com/viviii6020/DBMS_final-project/blob/main/DBMS_final%20project%20logo.png?raw=true' type='image/x-icon' />
    <link rel="stylesheet" href="all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="jquery-3.6.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="search.js"></script>   
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
                                    <?php
                                    if (!(isset($_SESSION["dbms_project"]))) {
                                    ?>
                                        <a class="nav-link" href="login.php">註冊/登入帳號</a>
                                    <?php
                                    }else{
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="addindex.php">新增貼文</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="account.html" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                                    <a class="nav-link" href="logout.php">登出</a>
                                    <?php
                                    }
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </div>
            </nav>
        </div>

        <div class="container">
            <div class="main m0-a">
                <div class="row">
                    <div class="col-md-12 ta-c">
                        <h1 class="fz-30 mt-32 mb-32">搜尋全站貼文</h1>
                        <!-- 搜尋按鈕，點擊後跳到searchOutput.php -->
                        <form action="search.php" method="post" role="search" enctype="multipart/form-data">
                        <!-- 搜尋欄模式 -->
                        <!-- 搜尋欄位 -->
                        <div class="search-container ta-c m0-a">
                            <h2>選取條件並輸入關鍵字</h2>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_username" value="option1">
                                <label class="form-check-label" for="username">會員名稱</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_pName" value="option2">
                                <label class="form-check-label" for="pName">貼文名稱</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_cost" value="option3">
                                <label class="form-check-label" for="cost">價格上限</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_collect" value="option4">
                                <label class="form-check-label" for="collect">貼文收藏數</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radio_join" value="option5">
                                <label class="form-check-label" for="join">目前可參加貼文</label>
                                <span class="fz-8">(直接搜尋)</span>
                            </div>

 
                            <!-- 如果條件選擇會員名稱就出現搜尋框 -->
                            <input class="form-control me-2 mt-16" type="text" name="mem_search" id="mem_search" placeholder="會員名稱搜尋" aria-label="Search">
                                                            
                            <!-- 如果條件選擇貼文名稱出現搜尋框 -->
                            <input class="form-control me-2 mt-16" type="text" name="pos_search" id="pos_search" placeholder="貼文名稱搜尋" aria-label="Search">
                        
                            <!-- 如果選價格 -->
                            <div class="slidecontainer mt-32 ta-c costBar">

                                <!-- value為起始值，step為間隔值 -->
                                <input type="range" min="10" max="2000" value="100" class="slider" step="10" id="costBar" name="cos_search">
                                <span>價格上限：</span>
                                <span id="costRange"></span>

                            </div>

                            <!-- 如果選貼文收藏數 -->
                            <div class="slidecontainer mt-32 ta-c collectBar">
                                
                                <input type="range" min="10" max="100" value="0" class="slider" step="1" id="collectBar" name="col_search">
                                <span>貼文收藏數：</span>
                                <span id="collectRange"></span>
                                
                            </div>

                            <!-- 目前可參加貼文不會挑搜尋框，條件點擊後要按旁邊搜尋按鈕 -->

                            <!-- 搜尋按鈕 -->
                            <button class="btn srh-btn mt-32 m0-a" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <sapn>立刻搜尋</span>
                            </button>
                       
                        </div>
                    </div>
                </div>
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

    <script src="searchpage.js"></script>

</body>
</html>