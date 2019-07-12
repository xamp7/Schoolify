<script src="/assets/js/vendor.js"></script>
<script src="/assets/js/bundle.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script> -->


<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
  <script type="text/javascript" src="/assets/js/fastselect.standalone.js"></script>


<script>
    document.getElementById('loader').className = "fadeOut";
</script>


<script type="text/javascript">
    $(document).ready(function(){
          $("#feedbackCounter").click(function(){
            $(".feedbackCount").html("0");
            $.ajax({
              method: "POST",
              data: { _token: '<?php echo csrf_token() ?>' },
              url: "/update_feedbackCount",
              })
              .done(function( data ) {
                console.log(data);
              });
          });


          $("#notificationCounter").click(function(){
            $(".notificationCount").html("0");
            $.ajax({
              method: "POST",
              data: { _token: '<?php echo csrf_token() ?>' },
              url: "/update_notificationCount",
              })
              .done(function( data ) {
                console.log(data);
              });
          });


    });
</script>
