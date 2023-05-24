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

        <div class="container">
            <div class="main m0-a">
                <div class="row">
                    <div class="col-md-12 ta-c">
                        <h1 class="fz-30 mt-32 mb-32">收件匣</h1>
                    </div>
                </div>
                
                <ul class="row private-message d-flex">
                    <?php
                        $db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
                        $username = $_SESSION['dbms_project'];
                        $sql = $db->query("SELECT * FROM `chat` WHERE rece_username = '$username' ORDER BY send_time DESC");
                        $num = $sql->rowCount();
                        $time = 1;
                        foreach ($sql as $row) {
                    ?>
                        <li class="mb-16 private-message-list">
                            
                            <!--發信人資訊，用php抓-->
                            <!-- Modal -->
                           
                                
                                <div class="jc-sb d-flex sender-container">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop<?= $row['message_id'] ?>">
                                        <div class="pl-8">
                                            <!-- 發信人暱稱 -->
                                            <p class="sender-name fz-24"><?=$row['send_username']?></p> 

                                            <!-- 信件標題 -->
                                            <p class="message-title fz-20 mt-8"><?=$row['title']?></p>

                                        </div>
                                        <!-- 彈跳詳細的訊息 -->
                                        <div class="modal fade" id="staticBackdrop<?= $row['message_id'] ?>" tabindex="-1" aria-labelledby="staticBackdropLabel<?= $row['message_id'] ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <!-- 信件標題 -->
                                                        <h5 class="modal-title" id="staticBackdropLabel<?= $row['message_id'] ?>"><?= $row['title'] ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <!-- 信件詳細內文 -->
                                                    <div class="modal-body"> 
                                                        <p><?=$row['content']?></p>
                                                    </div>

                                                    <!-- 彈跳詳細的訊息的按鈕div -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉視窗</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- 彈跳詳細的訊息div結束 -->
                                    </a>    
                                    <div class="ta-r">
                                        <!-- 傳送時間 -->
                                        <p class="send-time"><?=$row['send_time']?></p>
                                        <div class="mt-32">
                                            <!-- 回覆信件的彈跳窗 -->
                                            <!-- 這邊data-bs-whatever抓來信的使用者名稱  -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="使用者名稱">回覆信件</button>
                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">回覆信件</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="message.php" method="post">
                                                            <div class="mb-3 ta-l">
                                                                <!-- 收件者抓來信的使用者名稱  -->  
                                                                <label for="recipient-name" class="col-form-label">收件者:</label>
                                                                <input type="text" class="form-control" id="recipient-name" name='receiver' required type='text'>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-title" class="col-form-label">標題：</label>
                                                                <textarea class="form-control" id="message-title" name="message-title"></textarea>
                                                            </div>
                                                            <div class="mb-3 ta-l">
                                                                <label for="message-text" class="col-form-label">訊息:</label>
                                                                <textarea class="form-control" id="message-text" name="message-text"></textarea>
                                                            </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉視窗</button>
                                                            <button type="submit" class="btn btn-danger">送出訊息</button>
                                                        </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div><!-- 回覆信件的彈跳窗結束 -->
                                            
                                        </div>
                                    </div>   
                                </div>
                            
                        </li>
                        <?php
                            $time++;
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