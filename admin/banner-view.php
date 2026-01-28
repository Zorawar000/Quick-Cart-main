<?php
if (
    empty($_GET['bid']) ||
    empty($_GET['img'])
) {
    die("Invalid banner link");
}

$img = basename($_GET['img']); // security
$imagePath = "../uploads/".$img;

if (!file_exists($imagePath)) {
    die("Banner image not found");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Banner Preview</title>
    <style>
        body{
            margin:0;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            background:#f5f5f5;
        }
        img{
            max-width:90%;
            max-height:90%;
            box-shadow:0 0 15px rgba(0,0,0,.3);
            border-radius:8px;
            background:#fff;
        }
    </style>
</head>
<body>

<img src="<?= $imagePath ?>" alt="Banner Image">

</body>
</html>
