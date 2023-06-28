<div class="container-fluid">
  @if (session('success'))
      <div class="alert alert-dismissible alert-success">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <h4 class="alert-heading">Success!!</h4>
        <p class="mb-0">New products was addded success</p>
      </div>
  @endif
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
              <th>ID Product</th>
              <th>Name Product</th>
              <th>Serie</th>
              <th>Old Price</th>
              <th>Price Product</th>
              <th>Quantity</th>
              <th>Description</th>
              <th>Main Picture Product</th>
              <th>More Picture Product</th>
              <th>Name Suppilier</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Name Producttype</th>
              <th colspan="2">Settings</th>

            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID Product</th>
              <th>Name Product</th>
              <th>Serie</th>
              <th>Old Price</th>
              <th>Price Product</th>
              <th>Quantity</th>
              <th>Description</th>
              <th>Main Picture Product</th>
              <th>More Picture Product</th>
              <th>Name Suppilier</th>
              <th>Email</th>
              <th>Phone Number</th>
              <th>Name Producttype</th>
              <th colspan="2">Settings</th>
            </tr>
          </tfoot>
          <tbody>
            @forelse ($admin as $key =>$item)

            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name_product}}</td>
              <td>{{$item->serie}}</td>
              <td>{{$item->old_price}}</td>
              <td>{{ number_format($item->price_product, 0, ',', '.') }} VND</td>
              <td>{{$item->amount}}</td>
              <td>{{$item->depscribe}}</td>
              <td>
                <!-- Button trigger modal -->
                <a href="{{ asset('/storage/'.$item->img_product) }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$item->id}}" style="background-color: white;border-color:white;">
                  <img src="{{ asset('/storage/'.$item->img_product) }}" style="width: 300px">
                </a>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop{{$item->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog" style="max-width: 700px">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Pictures of {{$item->name_product}}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <img src="{{ asset('/storage/'.$item->img_product) }}" style="width: 680px">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <!-- Button trigger modal -->
                <a href="{{ route('ad.images',['id'=>$item->id]) }}" class="btn btn-outline-dark">View</a>
              </td>
              <td>{{$item->name_supplier}}</td>
              <td>{{$item->email}}</td>
              <td>{{$item->phone}}</td>
              <td>{{$item->name_producttype}}</td>
              <td>
                add product
                <a href="{{ route('ad.add') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z" />
                  </svg>
                </a><br>
                fix product
                <a href="{{ route('ad.edit',['id'=>$item->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" class="bi bi-gear-wide" viewBox="0 0 16 16">
                    <path
                      d="M8.932.727c-.243-.97-1.62-.97-1.864 0l-.071.286a.96.96 0 0 1-1.622.434l-.205-.211c-.695-.719-1.888-.03-1.613.931l.08.284a.96.96 0 0 1-1.186 1.187l-.284-.081c-.96-.275-1.65.918-.931 1.613l.211.205a.96.96 0 0 1-.434 1.622l-.286.071c-.97.243-.97 1.62 0 1.864l.286.071a.96.96 0 0 1 .434 1.622l-.211.205c-.719.695-.03 1.888.931 1.613l.284-.08a.96.96 0 0 1 1.187 1.187l-.081.283c-.275.96.918 1.65 1.613.931l.205-.211a.96.96 0 0 1 1.622.434l.071.286c.243.97 1.62.97 1.864 0l.071-.286a.96.96 0 0 1 1.622-.434l.205.211c.695.719 1.888.03 1.613-.931l-.08-.284a.96.96 0 0 1 1.187-1.187l.283.081c.96.275 1.65-.918.931-1.613l-.211-.205a.96.96 0 0 1 .434-1.622l.286-.071c.97-.243.97-1.62 0-1.864l-.286-.071a.96.96 0 0 1-.434-1.622l.211-.205c.719-.695.03-1.888-.931-1.613l-.284.08a.96.96 0 0 1-1.187-1.186l.081-.284c.275-.96-.918-1.65-1.613-.931l-.205.211a.96.96 0 0 1-1.622-.434L8.932.727zM8 12.997a4.998 4.998 0 1 1 0-9.995 4.998 4.998 0 0 1 0 9.996z" />
                  </svg>
                </a>
              </td>
              <td>
                <form action="{{ route('ad.destroy',['id'=>$item->id]) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-trash-fill" viewBox="0 0 16 16">
                      <path
                        d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                    </svg></button>
                </form>
              </td>
            </tr>
            @empty
              <tr>
                <td colspan="11" class="text-center">No products yet!</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
{{ $admin->links() }}