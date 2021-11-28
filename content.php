<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8;">
    <link rel="stylesheet" href="style.css">
<body>
<div>
    <header class="header">
        <img src="svg\logo.svg" class="logo"/>
        <div class="Columns_count">Количество столбцов: <!--реализовать систему поиска кол-ва столбцов--></div>
        <div class="Cards_count">Количество карточек: <!--реализовать систему поиска кол-ва карточек--></div>
    </header>
</div>
<div>
    <aside class="list">
        <div class="search">
            <form method="post">
                <input type="text" placeholder="Название команды" list="teams">
                <!--реализовать систему поиска команды-->
                <select name="team_id" id="teams">
                    <?php foreach ($teams as $team): ?>
                    <option value=<?=$team['id']?>><?=$team['name']?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit">
            </form>
        </div>
        <?=$team_info['name'] ?>
        <br>
        <?=$team_info['topic'] ?>
        <br>
        <?=$team_info['url'] ?>
        <br>
        <br>
        <?php foreach ($members as $member): ?>
            <?="{$member['first_name']} {$member['last_name']}: {$member['role']}"?>
            <br>
        <?php endforeach; ?>
    </aside>
</div>
<!--реализовать таблицу/сетку с графиками-->
<div>
    <table>
        <tr>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
            </td>
        </tr>
    </table>
</div>
</body>
</head>
</html>