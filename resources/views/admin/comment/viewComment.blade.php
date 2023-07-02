<!DOCTYPE html>
<html>
@include('admin.style.css')
<body id="page-top">
      <!-- Page Wrapper -->
      <div id="wrapper">
         @include("admin.layouts.sidebar")
         <!-- Content Wrapper -->
         <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include("admin.comment.topbar", ['messages' => $messages])

                <!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">List Comment</h1>
    <div class="notify_comment"></div>
    <!--  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
          For more information about DataTables, please visit the <a target="_blank"
              href="https://datatables.net">official DataTables documentation</a>.</p> -->
  
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Granted</th>
                <th>Customer Name</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Product</th>
                <th>Manage</th>
                <th style="width: 30px"></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>Granted</th>
                <th>Customer Name</th>
                <th>Comment</th>
                <th>Date</th>
                <th>Product</th>
                <th>Manage</th>
                <th style="width: 30px"></th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($comment as $key =>$comm)
  
              <tr>
                <td>
                    @if ($comm->comment_status==1)
                        <input type="button" data-comment_status="0" data-comment_id="{{ $comm->id }}" id="{{ $comm->product_id }}" class="btn btn-primary btn-xs comment_accept_btn" value="accept comment">
                    @else
                        <input type="button" data-comment_status="1" data-comment_id="{{ $comm->id }}" id="{{ $comm->product_id }}" class="btn btn-danger btn-xs comment_accept_btn" value="denies comment">
                    @endif
                </td>
                <td>{{$comm->customer_name}}</td>
                <td>{{$comm->comment}}
                    <style>
                        ul.list_rep li{
                            list-style-type: decimal;
                            color: blue;
                            margin: 5px 40px;
                        }
                    </style>
                    <ul class="list_rep">
                        Reply:
                        @foreach ($comment_rep as $key =>$comm_reply)
                            @if ($comm_reply->comment_parent_comment==$comm->id)
                                <li>{{ $comm_reply->comment }}</li>
                            @endif
                        @endforeach
                    </ul>
                    @if ($comm->comment_status==0)
                        <br><textarea name="" id="" rows="3" class="form-control reply_comment_{{ $comm->id }}"></textarea>
                        <br><button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{ $comm->product_id }}" data-comment_id="{{ $comm->id }}">Reply</button>
                    @endif
                </td>
                <td>{{$comm->created_at}}</td>
                <td><a href="{{ url('/user/detail/'.$comm->product->id) }}" target="_blank">{{$comm->product->name_product}}</a></td>
                <td>
                    {{-- <a href="" class="active styling-edit" ui-toggle-class="">
                        <i class="fa-solid fa-pencil"></i></a> --}}
                    <form action="{{ route('ad.delete_comment',['id'=>$comm->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" onclick="return confirm('Are you sure you want to delete ?')" class="fa-solid fa-x" ui-toggle-class="" value="delete">
                    </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
                  <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->
    
                <!-- Footer -->
               @include("admin.layouts.footer")
                <!-- End of Footer -->
    
            </div>
             <!-- End of Content Wrapper -->
          </div>
          <!-- End of Page Wrapper -->
          <!-- Scroll to Top Button-->
          <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
          </a>
          <!-- Logout Modal-->
          @include('admin.login.logout')
    @include("admin.style.boostrap")
    </body>
    <script>
        $('.comment_accept_btn').click(function(){
            var comment_status = $(this).data('comment_status');
            var comment_id = $(this).data('comment_id');
            var product_id = $(this).attr('id');
            if (comment_status==0) {
                var alert='change to accept success';
            }else{
                var alert='change to denies success';
            }
            $.ajax({
            type:"POST",
            url:"{{ url('/admin/allow-comment') }}",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment_status:comment_status,comment_id:comment_id,product_id:product_id},
                success:function(data){
                    location.reload();
                    $('.notify_comment').html('<span class="text text-alert">'+alert+'</span>');
                },
            });
        });
        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');
            var comment = $('.reply_comment_'+comment_id).val();
            var product_id = $(this).data('product_id');

            $.ajax({
            type:"POST",
            url:"{{ url('/admin/reply-comment') }}",
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment:comment,comment_id:comment_id,product_id:product_id},
                success:function(data){
                    location.reload();
                    $('.reply_comment'+comment_id).val('');
                    $('.notify_comment').html('<span class="text text-alert">Reply comment success</span>');
                },
            });
        });
    </script>
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
    </html>