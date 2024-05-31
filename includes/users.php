<?php

require_once ('../config/database.php');

$userStatement = $conn->prepare('SELECT * FROM users WHERE id != :id');
$userStatement->execute([
    'id' => $_COOKIE["id"]
]);
$users = $userStatement->fetchAll();

?>

<div class="users-discussions">
    <ul>
        <?php foreach ($users as $user) {
            ?>
            <li>
                <a href="/dsend/pages/discussions.php?id=<?=$user['id'] ?>">
                    <table width="100%">
                        <tbody>
                            <tr>
                                <td width="40" class="user-avatar">
                                    <div class="<?=$user['color'] ?>"><?=strtoupper(substr($user['email'], 0, 1)) ?></div> 
                                </td>
                                <td width="4"></td>
                                <?php  
                                    $messageStatement = $conn->prepare('SELECT * FROM messages WHERE sender_id = :sender_id OR receiver_id = :receiver_id ORDER BY id DESC LIMIT 1');
                                    $messageStatement->execute([
                                        'sender_id' => $_COOKIE['id'],
                                        'receiver_id' => $_COOKIE['id']
                                    ]);
                                    $message = $messageStatement->fetchAll();
                                ?>
                                <td>
                                    <div class="user-fullname"><?=$user['email'] ?></div>
                                    <?=count($message) == 0 ? "<i>Pas de message ...</i>" : (strlen($message[0]['text']) > 20 ? substr($message[0]['text'], O, 20)." ..." : $message[0]['text']) ?>
                                </td>
                                <td width="20">
                                    <small>12:45</small>
                                </td>  
                            </tr>
                            <tr>
                                <td colspan="2"></td>
                                <td colspan="2">
                                  <div class="separator"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>