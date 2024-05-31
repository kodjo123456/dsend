<?php
if (!isset($_COOKIE['id'])) {
    header('Location: ../');
    exit();
}

require_once ('../config/database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>D-Send</title>
</head>

<body>
    <?php require_once ('../includes/appbar.php') ?>
    <?php require_once ('../includes/users.php') ?>

    <?php if (isset($_GET['id'])) {
        $userStatement = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $userStatement->execute([
            'id' => $_GET['id']
        ]);
        $users = $userStatement->fetchAll();

        foreach ($users as $user) {
            ?>
            <div class="selected-user">
            
                <div class="user-avatar <?= $user['color'] ?>"><?= strtoupper(substr($user['email'], 0, 1)) ?></div> 
            
                <div class="user-email"><small><?= $user['email'] ?></small></div>
            </div>
            <?php
        }
        ?>

        <input type="hidden" id="user_id" value=" <?= $_GET['id'] ?>">

        <div class="wrap-content">

        </div>

        <div class="message-form">
            <form method="get" id="message_form">
                <table width="100%">
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" placeholder="Saisir un message ici ..." id="message_text">
                            </td>
                            <td width="50">
                                <button type="submit" class="bout" 
                                    style="background-color: transparent; border: none; outline: none; width: 100%; font-family: roboto-black; cursor: pointer;">
                                    Envoyer
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>

        </div>

    <?php } ?>

</body>

<script src="../assets/js/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#message_form').submit(function (e) {
            let messageText = $('#message_text').val().trim()
            e.preventDefault()
            if (messageText) {
                $.ajax({
                    url: "/dsend/processing/texting.php",
                    data: {
                        id: $('#user_id').val(),
                        text: messageText
                    },
                    success: function (result) {
                        $('#message_text').val('')
                    },
                });
            }
        })
        setInterval(() => {
            window.scrollTo(0, window.innerHeight)
            $.ajax({
                url: "/dsend/processing/messages.php",
                data: {
                    id: $('#user_id').val(),
                },
                success: function (result) {
                        $('.wrap-content').html(result);

                    }   
            });
        }, 1000)
    })
</script>

</html>