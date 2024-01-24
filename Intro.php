<?php
echo "Don't be sheep"; 
?><br>

<?php
$deposit = 5000.00;
echo $deposit;
var_dump($deposit);
echo "<br>";
$age = 20;
echo $age;
var_dump($age);
echo "<br>";
$condition = "anchors";
echo $condition;
var_dump($condition)
?><br>

<?php
// Boolean
$isStudent = false;
$isTeacher = false;

if ($isStudent) {
    echo "I am a student";
} elseif ($isTeacher) {
    echo "I am a teacher";
} else {
    echo "Welp! I don't know who I am";
}
?><br>

<?php
// Funtions
$msg = "John, 2347618973, 20";
var_dump($msg);
echo "<br>";
$exploded_msg  = explode(",", $msg);
var_dump($exploded_msg);
?><br>

