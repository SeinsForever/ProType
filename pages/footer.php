<div class="wrapper">
    <div class="container menu">
        <a class="icons" target="_blank" href="https://vk.com/redra1n">
            <img src="../img/vk.png" alt="vk" class="logo" width="30">
        </a>
        <a class="icons" target="_blank" href="https://discord.gg/xF7spQEc">
            <img src="../img/discord.png" alt="discord" class="logo" width="30">
        </a>
        <a class="icons" target="_blank" href="https://t.me/SeinSForever">
            <img src="../img/telegram.png" alt="telegram" class="logo" width="30">
        </a>
        <a class="icons" target="_blank" href="https://github.com/SeinsForever?tab=repositories">
            <img src="../img/git.png" alt="git" class="logo" width="30">
        </a>
    </div>
    <div class="timer" id="timer" style="">
        <?php
        if(empty($_GET))
        {
            echo('Loading new quote...');
        }
        ?>
    </div>

    <!--Вывод последних результатов-->
    <div class="container quickSettings">
        <span>Time</span>
        <span>Speed</span>
        <span>Errors</span>
        <span  id="lastTime">...</span>
        <span id="typingSpeed">...</span>
        <span id="typingErrors">...</span>
    </div>
</div>