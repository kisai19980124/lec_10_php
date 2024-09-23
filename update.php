<?php
include("func.php");
ini_set("display_errors",1);

$id = $_POST["id"];
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

$sql = "UPDATE survey
        SET name=:name,
            email=:email,  
            postcode=:postcode,
            address=:address,
            occupation=:occupation,
            experience=:exp,
            information=:info,
            comment=:comments,
            purpose=:purpose,
            field=:field,
            interest=:interest
        WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt -> bindValue(':id',$id, PDO::PARAM_STR);
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
    redirect("select.php");
}

?>