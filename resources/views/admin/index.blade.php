@extends('layouts.layout')
@section('user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@endsection
@section('header')
    Inventory
@endsection
@section('page')
    Inventory
@endsection
@section('content')
@if (\Session::has('error'))
    <div class="col-md-12">
        <div class="alert bg-danger" role="alert"><em class="fas fa-lg fa-exclamation-triangle">
            &nbsp;</em> {!! \Session::get('error') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						List of Books
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-cogs"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
                                            <li>
                                                    <a href="" data-toggle="modal" data-target="#addModal">
                                                        <em class="fas fa-file-download"></em> Add a Book
                                                    </a>
                                                  
                                            </li>
                                            <li class="divider"></li>
                                            <li>
                                                    <a href="" data-toggle="modal" data-target="#scanBook">
                                                        <em class="fas fa-file-download"></em> Scan Book
                                                    </a>
                                                  
                                            </li>
                                            <li class="divider"></li>
											<li>
                                                <form action="{{ route('downloadBookCsv') }}" method="POST" id="downloadCsv">
                                                    @csrf
                                                    <a href="javascript:{}" onclick="document.getElementById('downloadCsv').submit();">
                                                        <em class="fas fa-file-download"></em> Download CSV
                                                    </a>
                                                </form>    
                                            </li>
											<li class="divider"></li>
											<li>
                                            <form action="" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <a href="#" data-toggle="modal" data-target="#uploadModal">
												    <em class="fas fa-file-upload"></em> Upload CSV
											    </a>    
                                            </form> 
                                                                                 
                                            </li>
														
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                        <table class="table" id="booksTable">
                            <thead>
                                <tr>
                                    <th>Shelf Number</th>
                                    <th>Book Title</th>
                                    <th>Author</th>
                                    <th>Book Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book -> shelf_number }}</td>
                                        <td>{{ $book -> book_title }}</td>
                                        <td>{{ $book -> author }}</td>
                                        <td>{{ $book -> book_number }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    To do<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('viewBook') }}" method="GET" id="viewBook{{$book->id}}" style="margin-left: 3%;">
                                                             @csrf
                                                            <input type="hidden" value="{{ $book->id }}" name="book_id">
                                                            <i class="fas fa-search"></i><a href="javascript:{}" onclick="document.getElementById('viewBook{{$book->id}}').submit();" style="color: black;"> &nbspView</a>
                                                        </form>  
                                                    </li>
                                                    <li> 
                                                        <form action="{{ route('admin.deleteBook', $book->id) }}" method="POST" id="delete{{$book->id}}" style="margin-left: 3%;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" value="{{ $book->id }}" name="book_id">
                                                                <i class="fas fa-trash"></i><a href="javascript:{}" class="delete" onclick="document.getElementById('delete{{$book->id}}').submit();" style="color: black;"> &nbsp Delete</a>
                                                            
                                                            </form>  
                                                        </li>
                                                       
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>                     
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
			</div><!--/.col-->
			
	<!-- Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload a File</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('uploadBookCsv') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="importCsv">Select CSV File to Import</label><br>
                <input type="file" name="importCsv" id="importCsv" classs="form-control">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit"><i class="fa fa-upload"></i>
                    Import
                
                </button>
            </div>
        </form> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a Book</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.addBook') }}" method="POST">
            @csrf
            <label for="name">Book Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
            <label for="author">Author</label>
            <input type="text" name="author" id="author" class="form-control" required>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
            <label for="shelf_number">Shelf Number</label>
            <input type="text" name="shelf_number" id="shelf_number" class="form-control" required>
            <br><br>
            <button class="btn btn-success form-control">Save</button>
        </form> 
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="scanBook" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add a Book</h4>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.scanBook') }}" method="GET">
            @csrf
            <label for="book_number">Scan QR / Input Book Number</label>
            <input type="number" name="book_number" id="book_number" class="form-control" required>
        </form> 
      </div>
    </div>
  </div>
</div>


@endsection

@section('customScript')
<script>
    $(document).ready( function () {
        $('#booksTable').DataTable();
        $('.delete').on('click', function () {
        return confirm('Are you sure you want to delete this book?');
    });
    } );
    $('#myModal').on('shown.bs.modal', function () {
     $('#myInput').focus()
    });
 
</script>

@endsection