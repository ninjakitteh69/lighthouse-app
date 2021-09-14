<?php
if(isset($_GET['script'])){
    $command = escapeshellcmd("/app/main.py -i /var/www/html/uploads/" . $_GET['script'] . " -o /var/www/html/view/");
    $output = shell_exec($command);
    echo "Script Running...";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>View Page</title>
    </head>
<body>
<a href="/"> HOME </a> &nbsp;|&nbsp; <a href="/view/"> VIEW </a>

<table>
    <tr>
        <td style="min-width: 200px;">Results</td>
    </tr>
<?php 
$files = scandir('./');

foreach ($files as $file){
    if ($file == '.' || $file == ".." || $file == "index.php"){
        continue;
    }
    echo '<tr>';
    echo '<td><a href="./' . $file . '">' . $file . '</a></td>'; 
    echo '</tr>';
}
?>
</table>

</body>
</html>