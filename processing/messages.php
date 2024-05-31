<?php
require_once ('../config/database.php');

$messagesStatement = $conn->prepare('SELECT * FROM messages WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) OR (sender_id = :receiver_id AND receiver_id = :sender_id)');
$messagesStatement->execute([
    'sender_id' => $_COOKIE['id'],
    'receiver_id' => $_GET['id'],
]);
$messages = $messagesStatement->fetchAll();
?>

<table width="100%">
    <tbody>
        <?php foreach ($messages as $message) {
            if ($message['sender_id'] == $_GET['id']) {
                ?>
                <tr>
                    <td width="50%">
                        <div class="n-sender">
                            <?= $message['text'] ?>
                        </div>
                        <small><?= $message['created_at'] ?></small>
                    </td>
                    <td></td>
                </tr>
                
            <?php } else { ?>
                <tr>
                    <td width="50%">
                    </td>
                    <td style="text-alin: right; justify-content: end; display: flex;">
                        <div>
                            <div class="sender">
                                <?= $message['text'] ?>
                            </div>
                            <small><?= $message['created_at'] ?></small>
                        </div>
                    </td>
                </tr>
                <?php
            } 
        }
        ?>
    </tbody>
</table>
<br /><br /><br /><br /><br /><br /><br /><br />