<!-- BEGIN: main -->
<div class="messages">
    <div class="messages__button" onclick="handleNotice(this)"><i class="fa fa-envelope"></i><span class="notice_dot"></span></div>
    <div class="messages__content">
        <!-- BEGIN: loop -->
        <div class="message">
            <h3>{MESSAGE.sender}</h3>
            <span>{MESSAGE.created_at}</span>
            <p>{MESSAGE.message}</p>
        </div>
        <!-- END: loop -->
    </div>
</div>
<script>
    let messagesButton = document.querySelector('.messages__button');
    let messagesContent = document.querySelector('.messages__content');
        let dotActive = document.querySelector('.notice_dot');

    function handleNotice(e){
        messagesButton.classList.toggle("open");
        dotActive.classList.remove("active");
        event.stopPropagation();

    }
    $(window).click(function() {
        if(messagesButton.classList['value'].includes("open"))
            messagesButton.classList.toggle("open");
    });

</script>
<!-- END: main -->