<?php
// define variables and set to empty values
$sircle =  "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  // if (empty($_POST["circle"])) {
  //   $sircleErr = "Sircle is required";
  // } else {
  //   $circle = test_input($_POST["circle"]);
  // }


  if (empty($_POST["block_type"])) {
    $block_type_Err = "block is required";
  } else {
    $block_type = test_input($_POST["block_type"]);
  }

  if (empty($_POST["type"])) {
    $type_Err = "block is required";
  } else {
    $type = test_input($_POST["type"]);
  }

    if (empty($_POST["amount"])) {
    $amount_Err = "block is required";
  } else {
    $amount = test_input($_POST["amount"]);
  }

  if (empty($_POST["disposition"])) {
    $disposition_Err = "block is required";
  } else {
    $disposition = test_input($_POST["disposition"]);
  }
  if (empty($_POST["size"])) {
    $size_Err = "block is required";
  } else {
    $size = test_input($_POST["size"]);
  }

  if (empty($_POST["background"])) {
    $background_Err = "block is required";
  } else {
    $background = test_input($_POST["background"]);
  }

}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

Какой тип блока:
<input type="radio" name="block_type" value="background_wave" <?php if (isset($block_type) && $block_type=="background_wave") echo "checked";?>>Волна
<input type="radio" name="block_type" value="background_slan" <?php if (isset($block_type) && $block_type=="background_slan") echo "checked";?>>Косая
<input type="radio" name="block_type" value="background_empty" <?php if (isset($block_type) && $block_type=="background_empty") echo "checked";?>>Пустой
<input type="radio" name="block_type" value="background_block" <?php if (isset($block_type) && $block_type=="background_block") echo "checked";?>>Бекграунд
<span class="error">* <?php echo $block_type_Err;?></span>
<br>
<br>

1-й обьект
<select name="type" id="">
    <option value="circle">circle</option>
    <option value="rectangle">rectangle</option>
    <option value="video">video</option>
    <option value="title">title</option>
</select>
<span class="error">* <?php echo $type_Err;?></span>



<select name="amount" id="">
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
</select>
<span class="error">* <?php echo $amount_Err;?></span>


<select name="disposition" id="">
    <option value="top">top</option>
    <option value="left">left</option>
</select>
<span class="error">* <?php echo $disposition_Err;?></span>

<select name="size" id="">
    <option value="70x70">70x70</option>
    <option value="170x120">170x120</option>
    <option value="170x170">170x170</option>
    <option value="270x190">270x190</option>
    <option value="270x270">270x270</option>
    <option value="370x260">370x260</option>
    <option value="370x480">370x480</option>
    <option value="570x400">570x400</option>
    <option value="570x570">570x570</option>
    <option value="770x460">770x460</option>
</select>
<span class="error">* <?php echo $size_Err;?></span>
<select name="background" id="">
    <option value="oll">Сплошной</option>
    <option value="kont-bg">Контент с бг</option>
    <option value="text-bg">Текс с бг</option>
    <option value="no-bg">Без бг</option>
</select>
<span class="error">* <?php echo $background_Err;?></span>
<?php if (false) {
    # code...
 ?>
 Сколько кружков будет:
<input type="radio" name="sircle" value="sircle_75_1" <?php if (isset($sircle) && $sircle=="sircle_75_1") echo "checked";?>>1
<input type="radio" name="sircle" value="sircle_75_2" <?php if (isset($sircle) && $sircle=="sircle_75_2") echo "checked";?>>2
<input type="radio" name="sircle" value="sircle_75_3" <?php if (isset($sircle) && $sircle=="sircle_75_3") echo "checked";?>>3
<input type="radio" name="sircle" value="sircle_75_4" <?php if (isset($sircle) && $sircle=="sircle_75_4") echo "checked";?>>4

<span class="error">* <?php echo $sircleErr;?></span> 

<?php } ?>
<br><br>

<button type="button">добавить еще обьект</button>
<input type="submit" name="submit" value="Закончить блок"> 
<br>
</form>

<?php
fopen("html/index.html", "w");


function writeToFile($arr, $file_write ='html/index.html'){
    $count = count($arr);
//    $file_write ='index.html';
    for ($i = 0; $i < $count; $i++){
        $fp = fopen($arr[$i], 'r');
        $fw = fopen($file_write, 'a');

        if ($fp&&$fw)
        {
            while (!feof($fp))
            {
                $mytext = fgets($fp, 999); // считиваем построчно с файла
                fwrite($fw, $mytext); // Запись в файл

            }
            fwrite($fw,"\r\n");
        }
        else echo "Ошибка при открытии или записи файла";
        fclose($fw);
    }
}
function writeToFileByComment($arr, $file_write ='html/index.html', $file_read = "html/view-3.html"){
    $count = count($arr[0]);
    $doc = new DOMDocument();
    $doc->loadHTMLFile($file_read);
    $text = $doc->saveHTML();
    $fw = fopen($file_write, 'a');
    $need_head = giveHtmlByComment($text, '<!--'.$arr[1][0].'_begin-->');
    fwrite($fw, $need_head."\n"); // Запись в файл

    for ($i = 0; $i < $count; $i++){
        
        $need_html = giveHtmlByComment($text, '<!--'.$arr[0][$i].'-->');
        

        fwrite($fw, $need_html. "\n"); // Запись в файл



    }
    $need_foot = giveHtmlByComment($text, '<!--'.$arr[1][0].'_end-->');
    fwrite($fw, $need_foot. "\n"); // Запись в файл


    fclose($fw);
}

function giveHtmlByComment($text, $comment){
    $len = strlen($comment);
    $after_html = stristr($text,$comment);
    $after_html_min = substr($after_html,$len);
    return stristr($after_html_min,$comment,true);
}

if (isset($_REQUEST['submit'])) {

$content = $type.'_'.$amount.'_'.$disposition.'_'.$size.'_'.$background;
echo $content;
writeToFile(['html\head.html']);
writeToFileByComment([[$content,$content], [$block_type]]);
writeToFile(['html\foot.html']);
}




?>
</body>
</html>