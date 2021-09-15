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
<br /><br />
<table border="1px">
    <tr>
        <td style="min-width: 100px;">Results</td><td style="min-width: 100px;">Performance</td><td style="min-width: 100px;">Accessibility</td><td style="min-width: 100px;">Best Practices</td><td style="min-width: 100px;">SEO</td><td style="min-width: 100px;">Progressive Web App</td><td style="min-width: 100px;">DNS</td>
    </tr>
<?php 
$files = scandir('./');

foreach ($files as $file){
    if ($file == '.' || $file == ".." || $file == "index.php" || substr($file, -4) == "json"){
        continue;
    }
    $adata = json_decode(file_get_contents(substr($file, 0, -4) . "json"));
    $requested_url = str_replace(["https://", "http://", "/"], "", $adata->requestedUrl);
    $performance = $adata->categories->performance->score*100;
    $accessibility = $adata->categories->accessibility->score*100;
    $best_practices = $adata->categories->{'best-practices'}->score*100;
    $seo = $adata->categories->seo->score*100;
    $pwa = $adata->categories->pwa->score*100;
    echo '<tr>';
    echo "<td><a href=\"./$file\">HTML</a> | <a href=\"./" . substr($file, 0, -4) . "json\">JSON</a></td><td>$performance</td><td>$accessibility</td><td>$best_practices</td><td>$seo</td><td>$pwa</td><td><a href=\"/dns/?domain=$requested_url\">HTML</a> | <a href=\"../dns/$requested_url.json\">JSON</a></td>"; 
    echo '</tr>';
}
?>
</table>

</body>
</html>