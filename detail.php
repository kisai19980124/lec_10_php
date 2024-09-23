<?php
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("func.php");
$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM survey WHERE id=:id";//バインド変数
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
$json = json_encode($values,JSON_UNESCAPED_UNICODE);
$v = $values[0];

$name = $v["name"];
$email = $v["email"];
$postcode = $v["postcode"];
$address = $v["address"];
$occupation = $v["occupation"];
$exp = $v["experience"];
$info = $v["information"];
$comments = $v["comment"];
$purpose = $v["purpose"];
$field = $v["field"];
$interest = $v["interest"]; 

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Sawarabi+Mincho&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    
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
        </div>

        <div class="content">
            <div class="div-material-out" style="flex-grow:3;">
                <div class="div-material">
                    <div style="display:flex;">
                        <div style="display:flex;align-items: center">
                            <md-icon-button href="select.php">
                                <md-icon>arrow_back</md-icon>
                            </md-icon-button>
                        </div>
                        <h1 class="md-typescale-headline-medium">
                        回答編集
                        </h1></div>
                    <form action="update.php" method="post" id="survey">
                        <input type="hidden" name="id" value="<?=$v["id"]?>">
                        <p>
                        
                        </p>
                        <p>1. ご氏名を教えてください*</p>
                        <md-filled-text-field label="ご氏名" required  name="name" value = "<?= h($name) ?>" ></md-filled-text-field>
                        
                        <p>2. ご連絡先メールアドレスを教えてください。*</p>
                        <md-filled-text-field label="メールアドレス" required name="email" placeholder="email@domain.com" pattern="[\w\d-]+"  value = "<?= h($email) ?>" ></md-filled-text-field>
                        <p>3. ご住所を教えてください。*</p>
                        <md-filled-text-field label="郵便番号" required prefix-text="〒" name="postcode" maxlength="7" supporting-text="ハイフン (-)なしの7桁の郵便番号をご入力ください。"  value = "<?= h($postcode) ?>" ></md-filled-text-field>
                        <br>
                        <md-filled-text-field label="ご住所" required name="address" type="textarea" style="width=400px;resize: none;" rows="3" cols="50"  value= "<?= h($address) ?>" ></md-filled-text-field>
                        <p>4. 現在の職業を教えてください。*</p>
                        
                        <md-filled-select label="職業" required name="occupation" value="<?= h($occupation) ?>">
                            <md-select-option value="経営者">
                                <div slot="headline">経営者</div>
                            </md-select-option>
                            <md-select-option value="会社員">
                                <div slot="headline">会社員</div>
                            </md-select-option>
                            <md-select-option value="パート・アルバイト">
                                <div slot="headline">パート・アルバイト</div>
                            </md-select-option>
                            <md-select-option value="公務員">
                                <div slot="headline">公務員</div>
                            </md-select-option>
                            <md-select-option value="教職員">
                                <div slot="headline">教職員</div>
                            </md-select-option>
                            <md-select-option value="自営業・自由業">
                                <div slot="headline">自営業・自由業</div>
                            </md-select-option>
                            <md-select-option value="定年退職">
                                <div slot="headline">定年退職</div>
                            </md-select-option>
                            <md-select-option value="その他">
                                <div slot="headline">その他</div>
                            </md-select-option>
                        </md-filled-select>

                        <p>5. ドローンの操作経験はありますか？*</p>
                        <?php
                        $exp_options = [
                            ['id' => 'no', 'value' => 'ない', 'label' => 'ない'],
                            ['id' => 'little', 'value' => '少しある', 'label' => '少しある'],
                            ['id' => 'lot', 'value' => 'かなりある', 'label' => 'かなりある']
                        ];
                        foreach ($exp_options as $option) {
                            $checked =  h($exp) == $option['value'] ?  'checked' : ''; //三項演算子っていうらしい．trueならば : の前の式
                            echo '<p>';
                            echo '<md-radio id="' . $option['id'] . '" name="exp" value="' . $option['value'] . '" required  ' . $checked . '></md-radio>';
                            echo '<label for="' . $option['id'] . '">' . $option['label'] . '</label>';
                            echo '</p>';

                        }
                        ?>

                        <p>6. デモ会に参加する目的を教えてください。（複数選択可）</p>
                        <?php
                        $checkboxOptions = [
                            ['id' => 'sousa', 'value' => 'ドローンの操作を学びたい', 'label' => 'ドローンの操作を学びたい'],
                            ['id' => 'gijutsu', 'value' => '最新の技術を体験したい', 'label' => '最新の技術を体験したい'],
                            ['id' => 'kouryu', 'value' => '同業者との交流を深めたい', 'label' => '同業者との交流を深めたい'],
                            ['id' => 'others', 'value' => 'その他', 'label' => 'その他']
                        ];
                        foreach ($checkboxOptions as $option) {
                            // Check if h($purpose) contains the value
                            $checked = (strpos(h($purpose), $option['value']) !== false) ? 'checked' : '';
                            echo '<p>';
                            echo '<md-checkbox id="' . $option['id'] . '" touch-target="wrapper" name="purpose[]" value="' . $option['value'] . '"  ' . $checked . '></md-checkbox>';
                            echo '<label for="' . $option['id'] . '">' . $option['label'] . '</label>';
                            echo '</p>';
                        }
                        ?>


                        <p>7. どのような分野でドローンを活用していますか？または、活用したいと考えていますか？</p>
                        <?php
                            $checkboxFields = [
                                ['id' => '建設業', 'value' => '建設業', 'label' => '建設業'],
                                ['id' => '農業', 'value' => '農業', 'label' => '農業'],
                                ['id' => '映像制作', 'value' => '映像制作', 'label' => '映像制作'],
                                ['id' => '調査・点検', 'value' => '調査・点検', 'label' => '調査・点検'],
                                ['id' => '趣味', 'value' => '趣味', 'label' => '趣味']
                            ];

                            foreach ($checkboxFields as $fields) {
                                // Check if h($field) contains the value
                                $checked = (strpos(h($field), $fields['value']) !== false) ? 'checked' : '';
                                echo '<p>';
                                echo '<md-checkbox id="' . $fields['id'] . '" touch-target="wrapper" name="field[]" value="' . $fields['value'] . '"  ' . $checked . '></md-checkbox>';
                                echo '<label for="' . $fields['id'] . '">' . $fields['label'] . '</label>';
                                echo '</p>';
                            }
                            ?>


                        <p>8. デモ会で特に興味があるプログラムを教えてください。（複数選択可）</p>
                        
                        <?php
                            $checkboxInterests = [
                                ['id' => '操作体験コーナー', 'value' => '操作体験コーナー', 'label' => '操作体験コーナー'],
                                ['id' => '技術説明セミナー', 'value' => '技術説明セミナー', 'label' => '技術説明セミナー'],
                                ['id' => '最新機種の展示', 'value' => '最新機種の展示', 'label' => '最新機種の展示'],
                                ['id' => '質疑応答・ディスカッション', 'value' => '質疑応答・ディスカッション', 'label' => '質疑応答・ディスカッション']
                            ];

                            foreach ($checkboxInterests as $interests) {
                                // Check if h($interest) contains the value
                                $checked = (strpos(h($interest), $interests['value']) !== false) ? 'checked' : '';
                                echo '<p>';
                                echo '<md-checkbox id="' . $interests['id'] . '" touch-target="wrapper" name="interest[]" value="' . $interests['value'] . '"  ' . $checked . '></md-checkbox>';
                                echo '<label for="' . $interests['id'] . '">' . $interests['label'] . '</label>';
                                echo '</p>';
                            }
                            ?>

                        <p>9. ドローンに関する今後のイベントやセミナーの情報を受け取りたいですか？*</p>
                        <?php
                            $infoOptions = [
                                ['id' => '受け取る', 'value' => '受け取る', 'label' => '受け取る'],
                                ['id' => '受け取らない', 'value' => '受け取らない', 'label' => '受け取らない']
                            ];
                            foreach ($infoOptions as $option) {
                                // Check if h($info) equals the value
                                $checked = (h($info) === $option['value']) ? 'checked' : '';
                                echo '<p>';
                                echo '<md-radio id="' . $option['id'] . '" name="info" value="' . $option['value'] . '" required ' . $checked . '></md-radio>';
                                echo '<label for="' . $option['id'] . '">' . $option['label'] . '</label>';
                                echo '</p>';
                            }
                        ?>



                        <p>10. 何かご意見やご要望があれば教えてください。</p>
                        <md-filled-text-field label="ご意見・ご要望"  name="comments" type="textarea" style="resize: none;" rows="6" cols="100" value= "<?= h($comments) ?>" ></md-filled-text-field>
                        
                        <p>
                            
                            <md-filled-tonal-button form="survey" value="save" type="submit">                                
                            送信
                            <svg slot="icon" viewBox="0 0 48 48"><path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z"/></svg>
                            </md-filled-tonal-button>
                            <md-text-button value="reset" type="reset">リセット</md-text-button>
                        </p>
                        <br>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
<!--
お名前：<?= h($name) ?><br>
<?= h($email) ?><br>
<?= h($postcode) ?><br>
<?= h($address) ?><br>
<?= h($occupation)?><br>
<?= h($exp)?><br>
<?= h($info)?><br>
<?= h($comments)?><br>
<?= h($purpose)?><br>
<?= h($field)?><br>
<?= h($interest)?>
    -->

</body>
</html>