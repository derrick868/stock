<script type="text/javascript">
  $(document).ready(function(){

    function load_unseen_notification(view = '')
    {
      $.ajax({
        url:"fetch.php",
        method :"POST",
        data:{view:view},
        dataType:"json",
        success:function(data)
        {
          $('#not1').html(data.notification);

          if(data.unseen_notification > 0){
            $('.count').html(data.unseen_notification);
          }
        }
      });
    }
    load_unseen_notification();

    $(document).on('click', '#notification',function(){
      
      $('.count').html('');
      load_unseen_notification('yes');
    });
    setInterval(function(){
      load_unseen_notification();
    },5000);
  });
</script>