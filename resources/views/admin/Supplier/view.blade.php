<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
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
                            <th>ID Supplier</th>
                            <th>Name Suppilier</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Add Supplier</th>
                            <th>Update Supplier</th>
                            <th>Delete Supplier</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID Supplier</th>
                            <th>Name Suppilier</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Add Supplier</th>
                            <th>Update Supplier</th>
                            <th>Delete Supplier</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($supplier as $key =>$vi)       
                           <tr>
                              <td>{{$vi->id}}</td>
                              <td>{{$vi->name_supplier}}</td>
                              <td>{{$vi->email}}</td>
                              <td>{{$vi->phone}}</td>
                              <td><a href="{{ route('ad.sup') }}"><i class="fas fa-plus"></i></td>
                              <td><a href="{{ route('ad.supedit',['id'=>$vi->id]) }}">Update</a></td>
                              <td>
                                <form action="{{ route('ad.destroysup',['id'=>$vi->id]) }}" method="POST">
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

