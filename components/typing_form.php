
<!--Скрипт основного фукнционала-->
<script src="/script.js" defer></script>


<div class="container">

<!--    Текст из API-->
    <div class="quote-display" id="quoteDisplay" onCopy="return false"></div>

<!--    Автор (для английского языка) и длинна-->
    <div class="author-display" >
        <?php if($_SESSION['language'] == 'eng') { ?>
            <span id="authorDisplay">...... .....</span>
            <span>, </span>
        <?php } ?>
        <span id="lengthDisplay">...</span>
        <span> symbols</span>
    </div>

<!--    Место ввода-->
    <textarea id="quoteInput" class="quote-input" autofocus onCopy="return false" onDrag="return false" onDrop="return false" onPaste="return false" autocomplete=off></textarea>


    <div class="author-display" style="margin-bottom: 0">
        Press Tab to reset
    </div>

</div>