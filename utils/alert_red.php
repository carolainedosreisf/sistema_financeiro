<div class="alert-red">
    <div class="alert-red-dentro">
        <button type="button" class="fechar-red" aria-hidden="true">×</button>
        <span class="fa fa-times-circle erro-x-red"></span>
        <p></p>
    </div>
</div>

<script>
    var alert_red = document.querySelector('.alert-red-dentro');
    function msg_erro(msg){
        document.querySelector('.alert-red-dentro p').innerHTML = msg;
        alert_red.style.display = 'block';
        setTimeout(function(){ alert_red.style.display = 'none'; }, 5000);
    }
    $(document).ready(function(){
        $(".fechar-red").click(function(){
            alert_red.style.display = 'none';
        });
    });

    
</script>