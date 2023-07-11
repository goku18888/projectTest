<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
   <!--  <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
        For more information about DataTables, please visit the <a target="_blank"
            href="https://datatables.net">official DataTables documentation</a>.</p> -->

    <!-- DataTales Example -->
    @if (session()->has("producttype"))
        <div class="alert alert-danger">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session()->get('producttype') }}
        </div>
    @elseif (session()->has("producttype_success"))
        <div class="alert alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ session()->get('producttype_success') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">                             
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Producttype</th>
                            <th>ID Supplier</th>
                            <th>Name Producttype</th>
                            <th>Add product</th>
                            <th>Update product</th>
                            <th>Delete product</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Producttype</th>
                            <th>ID Supplier</th>
                            <th>Name Producttype</th>
                            <th>Add product</th>
                            <th>Update product</th>
                            <th>Delete product</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($admin as $key =>$item)
                            
                           <tr>
                              <td>{{$item->id}}</td>
                              <td>{{$item->supplier_id}}</td>
                              <td>{{$item->name_producttype}}</td>
                              <td><a href="{{ route('ad.type') }}"><i class="fas fa-plus"></i></td>
                              <td><a href="{{ route('ad.edittype',['id'=>$item->id]) }}">Update</a></td>
                              <td>
                                <form action="{{ route('ad.destroytype',['id'=>$item->id]) }}" onclick="return confirm('Bạn có chắc muốn xóa không ?')" method="POST">
                                  @csrf
                                  @method('DELETE')
                                  <button>Delete</button>
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

