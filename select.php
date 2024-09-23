<?php
session_start();
include("func.php");
sschk();

//以下SQL
$pdo = db_conn();

$sql = "SELECT * FROM survey";
$stmt = $pdo ->prepare($sql);
$status = $stmt ->execute();

$values = "";
if ($status == false) {
    sql_error($stmt);
}

$values = $stmt->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($values, JSON_UNESCAPED_UNICODE);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="./css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="importmap">
      {
        "imports": {
          "@material/web/": "https://esm.run/@material/web/"
        }
      }
    </script>
    <script type="module">
      import '@material/web/all.js';
      import {styles as typescaleStyles} from '@material/web/typography/md-typescale-styles.js';
  
      document.adoptedStyleSheets.push(typescaleStyles.styleSheet);
    </script>
    <title>アンケート</title>
</head>
<body>
    <div class="window">
        <div class="banner" style="box-sizing: border-box;">
            <div class="banner_name" style="flex-grow:1;">
                <h1 class="poppins-medium">
                        
                        G's Anquête 
                </h1>
            </div>

            <div class="banner_button">
                <md-icon-button href="./write.php" target="_self">
                <md-icon>edit_note</md-icon>
                </md-icon-button>
            </div>
            <div class="banner_button">
                <md-icon-button href="./read.php" target="_self">
                <md-icon>monitoring</md-icon>
                </md-icon-button>
            </div>

            <?php if($_SESSION["kanri_flg"] =="1" ){ ?>
                <div class="banner_button">
                <md-icon-button href="./user.php" target="_self">
                <md-icon>person_add</md-icon>
                </md-icon-button>
                </div>
             <?php }?>
            <div class="banner_button">
                <md-icon-button href="./logout.php" target="_self">
                <md-icon>logout</md-icon>
                </md-icon-button>
            </div>
        </div>

        <div class="content">
            <div class="div-material-out" style="flex-grow:3;">
                <div class="div-material" style="flex-direction: column;">
                    <h1 class="md-typescale-headline-medium">
                       ドローンデモ会 参加アンケート アンケート結果
                    </h1>
                    <md-list style="">
                    <?php foreach($values as $v){ ?>
                        
                        <md-list-item>
                            <div slot="start"><?=h($v["id"])?></div>
                            <div slot="headline"><?=h($v["name"])?></div>
                            <div slot="supporting-text"><?=h($v["email"])?></div>
                            <md-icon-button slot="end" href="check.php?id=<?=h($v["id"])?>">
                            <md-icon >visibility</md-icon>
                            </md-icon-button>
                            <md-icon-button slot="end" href="detail.php?id=<?=h($v["id"])?>">
                            <md-icon >edit</md-icon>
                            </md-icon-button>
                            <md-icon-button slot="end" href="delete.php?id=<?=h($v["id"])?>">
                            <md-icon >delete</md-icon>
                            </md-icon-button>
                        </md-list-item>
                        <md-divider></md-divider>
                    <?php } ?>
                    
                    </md-list>

                </div>
            </div>

        </div>
    </div>
    
</body>

</html>