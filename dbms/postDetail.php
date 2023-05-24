<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>家庭方案揪團平台</title>
    <link rel ='icon' href = 'https://github.com/viviii6020/DBMS_final-project/blob/main/DBMS_final%20project%20logo.png?raw=true' type='image/x-icon' />
    <link rel="stylesheet" href="all.css">
    <script src="jquery-3.6.1.js"></script>
    <script src="check.js"></script>
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
                    <?php
                        $db = new PDO("mysql:dbname=dbms_project;host=localhost", "root", "");
                        if (!isset($_GET['pId']) || empty($_GET['pId'])) {
                            die('帖子ID不存在');
                        }
                        
                        $pId = $_GET['pId'];
                        $sql = $db->query("SELECT * FROM `addpost` JOIN `member` ON addpost.creater_mId = member.mId WHERE addpost.pId=" . $pId);
                        foreach ($sql as $row) {
                        $count= $db->query(" SELECT COUNT(*) AS participant_count
                        FROM participate
                        WHERE pId = $pId");
                        $count = $count->fetch(PDO::FETCH_ASSOC)['participant_count'];
                        if($count>=$row['groupsize']){
                        $usernameExists = true;
                        }else{
                        $usernameExists = false;
                        }    
                    ?>

    <div class="container">
        <div class="main m0-a">
            <div class="row">
                <div class="col-md-12 detail-wrap">
                    <h1 class="fz-30 ta-c mt-32 mb-32 title"><?=$row['project']?></h1>
                    <div class="detail-container ta-c">
                        <img src="<?=$row['picture']?>" alt="<?=$row['project']?>">      
                    </div>
                    <!-- 收藏按鈕 -->
                    <form method="post" id="favorite" action="favorite.php" >
                    <button type="submit" class="btn btn-outline-danger collect-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                    </button>
                    <input type="hidden" name="postId" value="<?php echo $pId ?>">
                    </form>                        
                    <ul class="detail-content text-left fz-24">
                        <li class="owner">發文者：<?=$row['username']?></li>
                        <li class="paymentMethod">付款方式：<?=$row['payment']?></li>
                        <li class="groupSize">需求人數：<?=$row['groupsize']?></li>
                        <li class="cost">每人須分攤金額：<?=$row['cost']?></li>
                        <ul class="context">
                            <?php
                            $about = explode("\n", $row['about']);
                            foreach ($about as $line) {
                            echo "<li>" . $line . "</li>";
                            }
                            ?>
                        </ul>
                    </ul>
                </div>
                <ul class='field half1 mt-16 d-flex jc-fe'>
                    <!-- 彈跳訊息窗 -->
                    <li class="pr-16">
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">私訊揪團者</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">私訊揪團者</h5>
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

                        
                    </li>
                    <li class="pr-16">
                        <?php 
                        if(!$usernameExists){
                        ?>
                        <form method="post" id="join" action="join.php" onsubmit="return check(this)">
                            <input type="hidden" name="postId" value="<?php echo $pId ?>">
                            <button type="submit" class="btn btn-outline-danger">參加</button>
                        </form>
                        <?php
                        }
                        ?>
                    </li>
                    
                </ul>
      
            </div>
        </div>
    </div>
</div>
                    <?php
                    }
                    ?>
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