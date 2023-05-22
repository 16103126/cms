<script>
    
      "use strick";

      $(document).ready(function(){

        $('form').on('submit', function(e){

          e.preventDefault();
          let url = $(this).attr('action');
          let method = $(this).attr('method');
          
          $.ajax({
            url : url,
            type : method,
            data : new FormData(this),
            cache : false,
            processData : false,
            contentType : false,

            success : function(response){
              if (response.errors) {
                
                $('#errorMsg').removeClass('d-none');
                $('#successMsg').addClass('d-none');
                $.each(response.errors, function(index, error){
                  $('#errorText').html(error);
                })
              }else{
                $('#errorMsg').addClass('d-none');
                $('#successMsg').removeClass('d-none');
                $('#successText').html(response);
                window.location.replace(
                  '{{ route("user.login.form") }}'
                );
              }
            }
          });
        });
      });
    </script>