<!-- Bootstrap core JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
  integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js"
  integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Core plugin JavaScript-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
  integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
<!-- Page level plugins -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"
  integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- chart board --}}
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
@push('script')
<script type="text/javascript"
  src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/b-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.3/r-2.3.0/rg-1.2.0/sc-2.0.6/sb-1.3.3/sl-1.4.0/datatables.min.js">
</script>
@endpush
<script>
  $('.dropdown-item-thread').click(function () {
      $(this).find('.status-indicator').removeClass('bg-success').addClass('status-indicator')
      const id = $(this).find('.status-indicator').data('id')
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route("ad.updateStatus") }}',
          type: 'POST',
          data: {
              id
          }
      }).done(function() {
          $( this ).addClass( "done" );
      });
  })
</script>
<script>
  $('.dropdown-item-bill').click(function () {
      $(this).find('.status-indicators').removeClass('bg-success').addClass('status-indicator')
      const id = $(this).find('.status-indicator').data('id')
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: '{{ route("ad.updateBillV") }}',
          type: 'POST',
          data: {
              id
          }
      }).done(function() {
          $( this ).addClass( "done" );
      });
  })
</script>
<script>
  $('#keywords').keyup(function(){
    var query=$(this).val();
      if (query!='') {
        var _token=$('input[name="_token"]').val();
        $.ajax({
          url:"{{ url('/admin/autocomplete-ajax-topbar') }}",
          type:"POST",
          data:{query:query,_token:_token},
          success:function(data){
            $('#search_ajax_topbar').fadeIn();
            $('#search_ajax_topbar').html(data);
          }
        });
      }else{
        $('#search_ajax_topbar').fadeOut();
      }
  });
  $(document).on('click','.li_search_ajax_topbar',function(){
    $('#keywords').val($(this).text());
    $('#search_ajax_topbar').fadeOut();
  });
</script>
<script>
  $('#keywordss').keyup(function(){
    var query=$(this).val();
      if (query!='') {
        var _token=$('input[name="_token"]').val();
        $.ajax({
          url:"{{ url('/admin/autocomplete-ajax-viewuser') }}",
          type:"POST",
          data:{query:query,_token:_token},
          success:function(data){
            $('#search_ajax_viewuser').fadeIn();
            $('#search_ajax_viewuser').html(data);
          }
        });
      }else{
        $('#search_ajax_viewuser').fadeOut();
      }
  });
  $(document).on('click','.li_search_ajax_viewuser',function(){
    $('#keywordss').val($(this).text());
    $('#search_ajax_viewuser').fadeOut();
  });
</script>
<script>
  $(document).ready(function(){
    //hien bang feeship
    fetch_delivery();
    function fetch_delivery(){
      var _token=$('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/admin/select-feeship') }}",
        method:"POST",
        data:{_token:_token},
        success:function(data){
          $('#load_delivery').html(data);
        }
      });
    }
    //update tien trong bang
    $(document).on('blur','.fee_ship_edit',function(){
      var feeship_id=$(this).data('feeship_id');
      var fee_value=$(this).text();
      var _token=$('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/admin/update-delivery') }}",
        method:"POST",
        data:{fee_value:fee_value,feeship_id:feeship_id,_token:_token},
        success:function(data){
          fetch_delivery();
        }
      });
    });
    // them tinh thanh pho
    $('.add_delivery').click(function(){
      var city=$('.city').val();
      var province=$('.province').val();
      var wards=$('.wards').val();
      var fee_ship=$('.fee_ship').val();
      var _token=$('input[name="_token"]').val();
      $.ajax({
        url:"{{url('/admin/insert-delivery') }}",
        method:"POST",
        data:{city:city,province:province,wards:wards,fee_ship:fee_ship,_token:_token},
        success:function(data){
          alert('Them Phi Van Chuyen Thanh Cong');
        }
      });
    });
    // chon tinh thanh pho
    $('.choose').on('change',function(){
      var action=$(this).attr('id');
      var ma_id=$(this).val();
      var _token=$('input[name="_token"]').val();
      var result='';
      if(action=='city'){
        result='province';
      }else{
        result='wards';
      }
      $.ajax({
        url:"{{url('/admin/select-delivery') }}",
        method:"POST",
        data:{action:action,ma_id:ma_id,_token:_token},
        success:function(data){
          $('#' + result).html(data);
        }
      });
    });
  })
</script>