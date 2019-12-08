<div class="alert-green">
    <div class="alert-green-dentro">
        <button type="button" class="fechar-green" aria-hidden="true">×</button>
        <span class="fa fa-check-circle erro-x-green"></span>
        <p></p>
    </div>
</div> 
<script>
    var alert_green = document.querySelector('.alert-green-dentro');
    function msg_sucesso(msg){
        document.querySelector('.alert-green-dentro p').innerHTML = msg;
        alert_green.style.display = 'block';
        setTimeout(function(){ alert_green.style.display = 'none'; }, 5000);
    }
    $(document).ready(function(){
        $(".fechar-green").click(function(){
            alert_green.style.display = 'none';
        });
    });
</script>