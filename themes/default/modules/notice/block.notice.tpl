<!-- BEGIN: main -->
<marquee id="notice_news" style="color: red; font-weight:bold;" direction="left"  width="100%" ></marquee>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
 var pusher = new Pusher('4e75e6169027e6b46053', {
      cluster: 'ap1'
    });

 let convertCurrentDate = ()=>{
     var timestamp = 1293683278;
    var date = new Date(timestamp * 1000);

    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    var day = date.getDate();
    var hours = date.getHours();
    var minutes = date.getMinutes();
    var seconds = date.getSeconds();
    return year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;
 }
 var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        let margee = document.getElementById("notice_news");
        let dotActive = document.querySelector('.notice_dot');
        let messagesContent = document.querySelector('.messages__content')

        if(margee){
            let {fullName, messages } = data;
            margee.height ="40"; 
            margee.innerText ="Tin nhắn từ " + fullName +" (Admin) : "+ messages;
            messagesContent.innerHTML += `
             <div class="message">
            <h3>${fullName}</h3>
            <span>${convertCurrentDate}</span>
            <p>${messages}</p>
        </div>`;
            dotActive.classList.toggle("active");
        }
    });
</script>
<!-- END: main -->