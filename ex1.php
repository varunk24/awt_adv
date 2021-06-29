<?php
$myfile = fopen("textFile.txt", "r");
$fileContent= fread($myfile,filesize("textFile.txt"));
function count_Vowels($string)
{
    preg_match_all('/[aeiou]/i', $string, $matches);
    return count($matches[0]);
}
function isConsonant($ch)
{
    $ch = strtoupper($ch);
  
    return !($ch == 'A' || $ch == 'E' ||
            $ch == 'I' || $ch == 'O' ||
            $ch == 'U') && ord($ch) >= 65 && ord($ch) <= 90;
}
function totalConsonants($str)
{
    $count = 0;
    for ($i = 0; $i < strlen($str); $i++)
        if (isConsonant($str[$i]))
            ++$count;
        
    return $count;
}

function no_digits($str)
{
    $digits=0;
    for ($i = 0; $i < strlen($str); $i++)
    {
        if(ctype_digit($str[$i]))
        {
            $digits+=1;
        }
    }
    return $digits;
}

function count_spcl($string)
{
    preg_match_all('/[!@#$%^&*()_+-={}|\:]/', $string, $matches);
    return count($matches[0]);
}

$chars = strlen($fileContent);
$vowels = count_Vowels($fileContent);
$words = str_word_count($fileContent);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>program1</title>
</head>
<body>
    <h1>Program 1</h1>
    <h5><?php echo $words ?> Words </h5>
    <h5><?php echo $chars ?> Characters </h5>
    <h5><?php echo $vowels ?> Vowels </h5>
    <h5><?php echo totalConsonants($fileContent) ?> Consonants </h5>
    <h5><?php echo no_digits($fileContent) ?> Digits </h5>
    <h5><?php echo count_spcl($fileContent) ?> Special Characters </h5>
    <h5><?php echo filesize("textFile.txt") ?> bytes is File size </h5>
    <br><br>
    <h3>File contents </h3>
    <h5><?php echo $fileContent ; ?></h5>
</body>
</html>
<?php
fclose($myfile);
?>