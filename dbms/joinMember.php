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
    <script src="jquery-3.6.1.js"></script>
    <script src="realy.js"></script>
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

                            <!-- 搜尋按鈕和瀏覽人數 -->
                            <div class="d-flex">
                                <a href="searchpage.php"><button action="search.php" class="btn btn-outline-success" type="button">搜尋貼文</button></a>           
                                <p class="browse">瀏覽人數：</p>
                            </div>
                            
                        </div>
                    </div>
            </nav>
        </div>
        
        <div class="container container-jonimember-only">
            <div class="main m0-a">
                <div class="row"> 
                    <div class="col-md-12 ta-c">
                        <!-- 這邊要抓一下貼文標題 -->
                        <h1 class="fz-30 mt-32 mb-32">參加者名單</h1>
                    </div>
                </div>
                <?php
                        $db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");                       
                        $pId = $_GET['pId'];
                        $sql = $db->query("SELECT a.project, m.username, m.email, m.phone, m.mId
                        FROM addpost a
                        JOIN participate p ON a.pId = p.pId
                        JOIN member m ON p.mId = m.mId
                        WHERE p.pId = $pId");
                        $row = $sql->fetch(PDO::FETCH_ASSOC);
                 ?>
                <div class="row"> 
                    <div class="col-md-12 ml-16 ta-c">
                        <!-- 這邊要抓一下貼文標題 -->
                        <h2 class="fz-24 mb-32 join-member-postname">-<?=$row['project']?>-</h2>
                    </div>
                </div>

                <ul class="row join-member">
                <?php
                foreach ($sql as $row) {
                ?>
                    <li class="d-flex jc-sb join-member-list ai-c">
                        
                        <div class="d-flex">
                            <a href="#">
                                <div class="d-flex join-member-container jc-sb ai-c">
                                    <!--參加者資訊，用php抓-->
                                    <!-- 參加者暱稱 -->
                                    <p class="join-member-name fz-20 pl-16"><?=$row['username']?></p>
                                    <p >信箱：<?=$row['email']?></p> 
                                    <p >電話：<?=$row['phone']?></p>
                                </div>     
                            </a>
                        </div>

                        <!-- 刪除、私訊按鈕div開始 -->
                        <div class="join-member-button pr-32 d-flex ai-c">
                            <!-- 彈跳私訊窗 -->
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $row['mId'] ?>" data-bs-whatever="使用者名稱">私訊</button>
                            <div class="modal fade" id="exampleModal<?= $row['mId'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel<?= $row['mId'] ?>">私訊</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="message.php" method="post">
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label" >接收者：</label>
                                                <!-- 這邊要用php直接填入收信者名稱(發文者) -->
                                                <input class="form-control" id='receriver' name='receiver' required type='text' value='<?=$row['username']?>'  readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-title" class="col-form-label">標題：</label>
                                                <textarea class="form-control" id="message-title" name="message-title"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message-text" class="col-form-label">訊息：</label>
                                                <textarea class="form-control" id="message-text" name="message-text"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉視窗</button>
                                                <button type="submit" class="btn btn-primary">傳送</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- 刪除按鈕 -->
                            <form method="post" id="Del" action="deljoin.php" onsubmit="return realy(this)">
                                <input type="hidden" name="postId" value="<?php echo $pId ?>">
                                <input type="hidden" name="postmId" value="<?= $row['mId'] ?>">
                                <button type="submit" class="btn btn-outline-secondary ml-8">剔除</button>
                            </form>

                        </div><!-- 刪除、私訊按鈕div結束 -->                 
                    </li>
                   
                    
                <?php
                            
                }
                ?>
                  
                </ul>

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