<?php
require_once(__DIR__."/../functions.php");
session_start();
?>
<script>
if (window.opener && window.opener !== window) {
} else if (window.top !== window.self) {
} else {
	<?php define('Permitted', TRUE); ?>
}
</script>
<?php
verify("..");

echo "<link href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css\" rel=\"stylesheet\" type=\"text/css\">";
echo "<link href=\"../styles/style.css\" rel=\"stylesheet\" type=\"text/css\">";
$info = fetch_table_rows("courses", "id=".$_GET['id']);
$row = $info->fetch_assoc();
	echo "
		<div class=\"alert alert-info\">
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                    ?</button>
                <span class=\"glyphicon glyphicon-info-sign\"></span> <strong>".$row['name']."</strong>
                <hr class=\"message-inner-separator\">
                <p>".$row['description']."</p>
        </div>
	";
?>