<!DOCTYPE html>
<html lang="en">
    <head>
        <title>DNS Page</title>
    </head>
<body>
<a href="/"> HOME </a> &nbsp;|&nbsp; <a href="/view/"> VIEW </a>

<?php
if(isset($_GET['domain'])){
    ?>
    <table>
    <tr>
        <td style="min-width: 200px;">NS Records</td><td style="min-width: 200px;">MX Records</td><td style="min-width: 200px;">A Records</td>
    </tr>
    <?php
    $adata = json_decode(file_get_contents($_GET['domain'] . ".json"));
    $ns = implode("<br />",$adata->ns);
    $mx = implode("<br />",$adata->mx);
    $a = implode("<br />",$adata->a);
    echo '<tr>';
    echo "<td>$ns</td><td>$mx</td><td>$a</td>"; 
    echo '</tr>';
}else{
    echo "<br /><br />No DNS File Selected";
    header('Location: /view/');
}

?>
</table>

</body>
</html>