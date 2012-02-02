<?php
require 'start.php';

$messages = $db->query("SELECT * FROM message ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>logmail</h1>
    <?php if (empty($messages)): ?>
    <p>No messages sent yet</p>
    <?php else: ?>
    <?php foreach ($messages as $i => $email): ?>
    <div class="message<?php echo $i == 0 ? ' latest' : ''; ?>">
        <h2>message #<?= $email->id; ?></h2>
<pre class="content"><?php
    try {
		require 'message-template.php';
    } catch (Exception $e) {
		echo "Failed parsing message, outputing as raw:<br />";
        echo htmlentities($email->message);
    }
?></pre>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>