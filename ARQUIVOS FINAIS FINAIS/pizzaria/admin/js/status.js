$(document).ready(function(){
    
    var tabela_pedidos = $("#tabela_pedidos");
    var bt_status = tabela_pedidos.find($("#bt_status"));
    var update = tabela_pedidos.find($("#update"));
    var bt_deletar = tabela_pedidos.find($("#bt_deletar"));
    var deletar = tabela_pedidos.find($("#deletar"));
    var url = $(location).attr('href');
    var urlStatus = url.split("#");
    
    
    $("a#bt_status") .on('click', bt_status,function(){
        var idPedido = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        var dataPedido = $(this).attr('data-pedido');
       
        $.ajax({
            url : '../inc/alterar/status_pedido.php',
            type: 'POST',
            data: 'id='+idPedido+'&status='+status+"&data="+dataPedido,
            success: function(data){
                update.html(data);    
                
               
                var intervalo = setInterval(function(){
                    window.location.href = urlStatus[0];
                }, 200);
              
                if(update.html() == ""){
                    clearInterval(intervalo);
                }
            }
        
        });
    });
 
    $("a#bt_deletar") .on('click', bt_deletar,function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url : '../inc/deletar/pedido.php',
            type: 'POST',
            data: 'id='+id,
            success: function(data){
                deletar.html(data);    
                           
                var intervalo = setInterval(function(){
                    window.location.href = urlStatus[0];
                }, 200);
              
                if(update.html() == ""){
                    clearInterval(intervalo);
                }
            }
        
        });
    });
    
    
});