<?php

// ユーザーによる投稿の反映方法

require_once(__DIR__ . '/../config/config.php');

$app = new MyApp\Controller\Select_user_reflect();
$app->run();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Select user reflect</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- logoutのフォーム -->
    <form action="logout.php" method="post" id="logout"> <!-- actionが跳び先のファイル -->
        <?= h($app->me()->email); ?><input type="submit" value="Log Out" onclick="return confirm('ログアウトします。本当によろしいですか？')">
        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
    </form>
    <div id="container">
        <h1 id="text">ユーザー一覧(1:投稿後すぐ反映)</h1>
            <ul>
                <?php 
                    $i = 0;
                    foreach($app->getValues()->users as $user):
                        $name = "form".$i;
                        $path="javascript:form".$i.".submit()"
                ?>
                <form action="" method="post" id="select_user_reflect" name="<?= h($name); ?>">
                    <li>
                        <p class="fs12" id="left"><a href="<?= h($path); ?>"><?= h($user->nickname); ?></a> <?= h($user->flag_reflect); ?></p>
                        <input type="hidden" name="email" value="<?= h($user->email); ?>">
                        <input type="hidden" name="flag_reflect" value="<?= ($user->flag_reflect); ?>">
                        <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                    </li>
                    <?php $i += 1;?>
                </form>
                <?php endforeach; ?>
            </ul>
        
        <p class="err"><?= h($app->getErrors('update')); ?></p>
        <p class="fs12" id="text"><a href="/select_reflect.php">スレッド・投稿の反映方法</a></p>
    </div>
</body>
</html>
