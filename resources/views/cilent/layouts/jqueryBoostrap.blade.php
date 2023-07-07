<!-- jQuery -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<!-- jQuery Easing -->
<script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Carousel -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!-- countTo -->
<script src="{{ asset('js/jquery.countTo.js') }}"></script>
<!-- Flexslider -->
<script src="{{ asset('js/jquery.flexslider-min.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/main.js') }}"></script>
{{-- <!-- Jquery CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"> --}}
<script>
    function remove_background(product_id){
        for (var count = 1; count <= 5; count++) {
            $('#'+product_id+'-'+count).css('color','#ccc');            
        }
    }
    //hover mouse star
    $(document).on('mouseenter','.rating',function(){
        var index=$(this).data("index");
        var product_id=$(this).data('product_id');
        remove_background(product_id);
        for (let count = 1; count <= index; count++) {
            $('#'+product_id+'-'+count).css('color','#ffcc00');
        }
    });
    //move the mouse away
    $(document).on('mouseleave','.rating',function(){
        var index=$(this).data("index");
        var product_id=$(this).data('product_id');
        var rating=$(this).data('rating');
        remove_background(product_id);
        for (var count = 1; count <= rating; count++) {
            $('#'+product_id+'-'+count).css('color','#ffcc00');
        }
    });
    //click star confirm
    $(document).on('click','.rating',function(){
        var index=$(this).data("index");
        var product_id=$(this).data('product_id');
        var _token=$('input[name="_token"]').val();
        $.ajax({
            url:"{{ url('/user/insert-rating') }}",
            method:"POST",
            data:{index:index,product_id:product_id,_token:_token},
            success:function(data){
                if (data=='done') {
                    alert('Bạn đã vote' +index+ 'trên tổng 5 sao');
                } else {
                    alert('Vote bị lỗi');
                }
            }
        });
    });
</script>
{{-- comment --}}
<script>
    $(document).ready(function(){
         load_comment();

        function load_comment(){
            var product_id = $('.product_id').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('/user/load-comment') }}",
                type:"POST",
                data:{product_id:product_id,_token:_token},
                success:function(data){
                    $('#comment_show').html(data);
                }
            });
        }

        $('.send-comment').click(function(){
            var product_id = $('.product_id').val();
            var customer_name = $('.customer_name').val();
            var comment_content = $('.comment_content').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ url('/user/send-comment') }}",
                type:"POST",
                data:{product_id:product_id,customer_name:customer_name,comment_content:comment_content,_token:_token},
                success:function(data){
                    $('#notify_comment').html('<p class="text text-success">Your Comment Have Posted,please wait us to accept your comment :3 </p>');
                    load_comment();
                    $('#notify_comment').fadeOut(9000);
                    $('.customer_name').val('');
                    $('.comment_content').val('');
                }
            });
        });
    });
</script>
<script>
    function addTocart(event){
        event.preventDefault();
        let urlCart=$(this).data('url');
        $.ajax({
            type:"GET",
            url:urlCart,
            dataType:'json',
            success:function(data){
                setTimeout(function() {
                    location.reload();
                }, 600);
                if(data.code == 200){
                    $('#custom-alert').html('<h2 class="text text-success">Hàng bạn chọn đã được thêm vào giỏ</h2>');
                    $('#custom-alertt').html('<h2 class="text text-success">Hàng bạn chọn đã được thêm vào giỏ</h2>');
                }
            },
            error:function(err){
                console.log(err);
            }
        });
    }
    $(function(){
        $('.add_to_cart').on('click',addTocart);
    });
</script>
<script>
    $('#index_user_keywords').keyup(function(){
      var query=$(this).val();
        if (query!='') {
          var _token=$('input[name="_token"]').val();
          $.ajax({
            url:"{{ url('/user/autocomplete-ajax-indexuser') }}",
            type:"POST",
            data:{query:query,_token:_token},
            success:function(data){
              $('#search_ajax_indexuser').fadeIn();
              $('#search_ajax_indexuser').html(data);
            }
          });
        }else{
          $('#search_ajax_indexuser').fadeOut();
        }
    });
    $(document).on('click','.li_search_ajax_indexuser',function(){
      $('#index_user_keywords').val($(this).text());
      $('#search_ajax_indexuser').fadeOut();
    });
</script>