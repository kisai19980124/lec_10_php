<?php
session_start();
//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "func.php";
sschk();
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
    <title>ユーザー登録</title>
</head>
<body>

<!-- Head[Start] -->
<div class="window">
        <div class="banner" style="box-sizing: border-box;">
            <div class="banner_name" style="flex-grow:1;">
                <h1 class="poppins-medium">
                        
                        G's Anquête 
                </h1>
            </div>
            <div class="banner_button">
                <md-icon-button href="./select.php" target="_self">
                <md-icon>view_list</md-icon>
                </md-icon-button>
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
            <div class="banner_button">
                <md-icon-button href="./logout.php" target="_self">
                <md-icon>logout</md-icon>
                </md-icon-button>
            </div>

        </div>

        <div class="content">
            <div class="div-material-out" style="flex-grow:3;">
                <div class="div-material" style="flex-direction: column;">
                    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
                    <h1 class="md-typescale-headline-medium">ユーザー登録</h1>

                    <form name="form1" action="user_insert.php" method="post">
                        <p><md-filled-text-field label="名前" required name="name" ></md-filled-text-field></p>
                        <p><md-filled-text-field label="ID" required name="lid" ></md-filled-text-field></p>
                        <p><md-filled-text-field label="PW" required name="lpw" type="password"></md-filled-text-field></p>
                        <p>管理FLG：</p>
                        <p><md-radio id="normal" name="kanri_flg" value="0" required></md-radio>
                        <label for="normal">一般</label></p>
                        <p><md-radio id="admin" name="kanri_flg" value="1" required></md-radio>
                        <label for="admin">管理者</label></p>
                    
                        <md-filled-button type="submit">登録</md-filled-button>
                    
                    </form>
                </div>
            </div>
        </div>
</div>



</body>
</html>
