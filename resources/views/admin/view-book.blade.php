@extends('layouts.layout')
@section('user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@endsection
@section('header')
    Book Information
@endsection
@section('page')
    Inventory 
@endsection
@section('liSection')
    <li class="active">View Book</li>
@endsection
@section('content')
@if (\Session::has('success'))
    <div class="col-md-12">
        <div class="alert bg-success" role="alert"><em class="far fa-lg fa-check-square">
            &nbsp;</em> {!! \Session::get('success') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
			<div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
						{{ $book->book_title }} - {{ $book->author }}
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                        <div class="row">
							<div class="col-md-6">
								<form action="{{ route('admin.updateBook', $book->id) }}" method="POST">
									@csrf
									@method('PATCH')
									<label for="name">Book Title</label>
									<input type="text" name="name" value="{{ $book->book_title }}" class="form-control">
									<label for="author">Author</label>
									<input type="text" name="author" value="{{ $book->author}}" class="form-control">
									<label for="quantity">Quantity</label>
									<input type="text" name="quantity" value="{{ $book->stocks }}" class="form-control">
									<label for="shelf">Shelf Number</label>
									<input type="text" name="shelf"value="{{ $book->shelf_number }}" class="form-control">
									<br><br>
									<button class="btn btn-success form-control">Update</button>
									
								</form>

							</div>
							<div class="col-md-6">
								<div class="row">
									<div class=" col-lg-1 col-md-1 col-sm-2 col-xs-1"></div>
									<div class="col-lg-1 col-md-6 col-sm-6 col-xs-6">
											<form action="{{ route('admin.pdf') }}" method="POST">
												@csrf
												<input type="hidden" name="book" value="{{$book->book_number}}">
												<button class="btn btn-success ">Print QR Code</button>
											</form>
										<h3><p><strong>#{{ $book->book_number }}</strong></p></h3>
											
									</div>
								</div>
									
									{!! QrCode::size(300)->generate($book->book_number); !!}
							</div>
						</div>
						<hr>
						<h3>Status- Reserved: {{ count($reservation) }} Unreturned: {{ count($transaction) }} Available: {{ $count }}</h3>
						<table id="booksTable">
							<thead>
								<tr>
									<th>Client</th>
									<th>Date Borrowed</th>
									<th>Status</th>
									<th>Todo</th>

								</tr>
							</thead>
							<tbody>
								@foreach($allTransaction as $a)
									<tr>
										<td>{{ $a->user->first_name }} {{ $a->user->middle_name }} {{ $a->user->last_name }}</td>
										<td>{{ $a->date_borrowed }}</td>
										@if($a->return_date == NULL)
											<td><p class="text-danger">Unreturned</p></td>
											<td>
											<form action="{{ route('admin.return', $a->id) }}" method="POST">
												@csrf
												<button class="btn btn-danger form-control">Return</button>

											</form>
										</td>
										@else
											<td>Returned ({{ $a->return_date }})</td>
											<td><button class="btn btn-default disabled form-control">Returned</button></td>		
										@endif
										
									</tr>
								@endforeach
								@foreach($allReservation as $a)
									<tr>
										<td>{{ $a->user->first_name }} {{ $a->user->middle_name }} {{ $a->user->last_name }}</td>
										<td>Didn't borrowed yet</td>
										<td>Didn't borrowed yet</td>
										<td>
											<form action="{{ route('admin.borrow') }}" method="POST">
												@csrf
												<input type="hidden" name="book_id" value="{{ $a->book_id }}">
												<input type="hidden" name="user_id" value="{{ $a->user_id }}">
												<button class="btn btn-success form-control">Borrow</button>
											</form>
											
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