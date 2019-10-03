@extends('layouts.user-layout')
@section('user')
    Hello, {{ Auth::user()->first_name }}
@endsection
@section('header')
    Library
@endsection
@section('page')
   Library
@endsection
@section('content')


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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{ $book -> shelf_number }}</td>
                                        <td>{{ $book -> book_title }}</td>
                                        <td>{{ $book -> author }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    To do<span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <form action="{{ route('user.viewBook') }}" method="GET" id="viewBook{{$book->id}}" style="margin-left: 3%;">
                                                             @csrf
                                                            <input type="hidden" value="{{ $book->id }}" name="book_id">
                                                            <i class="fas fa-search"></i><a href="javascript:{}" onclick="document.getElementById('viewBook{{$book->id}}').submit();" style="color: black;"> &nbspView</a>
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
@endsection



@section('customScript')
<script>
    $(document).ready( function () {
        $('#booksTable').DataTable();
    } );
    $('#myModal').on('shown.bs.modal', function () {
     $('#myInput').focus()
    });
 
</script>

@endsection