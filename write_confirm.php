<?php
include("func.php");
ini_set("display_errors",1);


$name = $_POST["name"];
$email = $_POST["email"];
$postcode = $_POST["postcode"];
$address = $_POST["address"];
$occupation = $_POST["occupation"];
$exp = $_POST["exp"];
$info = $_POST["info"];
$comments = $_POST["comments"];
$purpose = "";
$field = "";
$interest = ""; 
if (isset($_POST['purpose']) && is_array($_POST['purpose'])) {
    $purpose = implode("|", $_POST["purpose"]);
}
if (isset($_POST['field']) && is_array($_POST['field'])) {
    $field = implode("|", $_POST["field"]);
}
if (isset($_POST['interest']) && is_array($_POST['interest'])) {
    $interest = implode("|", $_POST["interest"]);
}

$pdo = db_conn();

$sql = "INSERT INTO survey(name,email,postcode,address,occupation,experience,information,comment,purpose,field,interest)VALUES(:name,:email,:postcode,:address,:occupation,:exp,:info,:comments,:purpose,:field,:interest)";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':name',$name, PDO::PARAM_STR);
$stmt->bindValue(':email',$email, PDO::PARAM_STR);
$stmt->bindValue(':postcode',$postcode, PDO::PARAM_STR);
$stmt->bindValue(':occupation',$occupation, PDO::PARAM_STR);
$stmt->bindValue(':exp',$exp, PDO::PARAM_STR);
$stmt->bindValue(':info',$info, PDO::PARAM_STR);
$stmt->bindValue(':comments',$comments, PDO::PARAM_STR);
$stmt->bindValue(':purpose',$purpose, PDO::PARAM_STR);
$stmt->bindValue(':field',$field, PDO::PARAM_STR);
$stmt->bindValue(':interest',$interest, PDO::PARAM_STR);
$stmt->bindValue(':address',$address, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status === false) {
    sql_error($stmt);
}else{

}

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
                <md-icon-button href="./login.php" target="_self">
                <md-icon>login</md-icon>
                </md-icon-button>
            </div>
        </div>

        <div class="content">
            <div class="div-material-out" style="flex-grow:3;">
                <div class="div-material">
                    <form action="write_confirm.php" method="post" id="survey">
                        <h1 class="md-typescale-headline-medium">
                        アンケート回答は送信されました。
                        </h1>
                        <p>
                        
                        </p>
                        <p>1. ご氏名を教えてください*</p>
                        <md-filled-text-field label="ご氏名" required readonly name="name" value = "<?= h($name) ?>" ></md-filled-text-field>
                        
                        <p>2. ご連絡先メールアドレスを教えてください。*</p>
                        <md-filled-text-field label="メールアドレス" required name="email" placeholder="email@domain.com" pattern="[\w\d-]+" readonly value = "<?= h($email) ?>" ></md-filled-text-field>
                        <p>3. ご住所を教えてください。*</p>
                        <md-filled-text-field label="郵便番号" required prefix-text="〒" name="postcode" maxlength="7" supporting-text="ハイフン (-)なしの7桁の郵便番号をご入力ください。" readonly value = "<?= h($postcode) ?>" ></md-filled-text-field>
                        <br>
                        <md-filled-text-field label="ご住所" required name="address" type="textarea" style="width=400px;resize: none;" rows="3" cols="50" readonly value= "<?= h($address) ?>" ></md-filled-text-field>
                        <p>4. 現在の職業を教えてください。*</p>
                        
                        <md-filled-select label="職業" required name="occupation" disabled value="<?= h($occupation) ?>">
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
                            echo '<md-radio id="' . $option['id'] . '" name="exp" value="' . $option['value'] . '" required disabled ' . $checked . '></md-radio>';
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
                            echo '<md-checkbox id="' . $option['id'] . '" touch-target="wrapper" name="purpose[]" value="' . $option['value'] . '" disabled ' . $checked . '></md-checkbox>';
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
                                echo '<md-checkbox id="' . $fields['id'] . '" touch-target="wrapper" name="field[]" value="' . $fields['value'] . '" disabled ' . $checked . '></md-checkbox>';
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
                                echo '<md-checkbox id="' . $interests['id'] . '" touch-target="wrapper" name="interest[]" value="' . $interests['value'] . '" disabled ' . $checked . '></md-checkbox>';
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
                                echo '<md-radio id="' . $option['id'] . '" name="info" value="' . $option['value'] . '" required disabled ' . $checked . '></md-radio>';
                                echo '<label for="' . $option['id'] . '">' . $option['label'] . '</label>';
                                echo '</p>';
                            }
                        ?>



                        <p>10. 何かご意見やご要望があれば教えてください。</p>
                        <md-filled-text-field label="ご意見・ご要望"  name="address" type="textarea" style="resize: none;" rows="6" cols="100" value= "<?= h($comments) ?>" readonly></md-filled-text-field>
                        <br><br>
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