@extends('layouts.layout')
@section('user')
    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
@endsection
@section('header')

    Transactions

@endsection
@section('page')
    Transactions
@endsection
@section('content')

  @if (\Session::has('error'))
    <div class="col-md-12">
        <div class="alert bg-danger" role="alert"><em class="fas fa-lg fa-exclamation-triangle">
            &nbsp;</em> {!! \Session::get('error') !!} <a href="#" class="pull-right"><em class="fa fa-lg fa-close"></em></a>
        </div>
    </div>
    @endif
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
                        New Transaction
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                       <form action="{{ route('admin.addTransaction') }}" method="POST" id="form">
                         @csrf
                            <input type="password" class="form-control" name="qr_input" id="input-form" onblur="(this).focus()" autofocus="on">
                       </form>
                       <br><br>



                </div>
               </div>
			</div><!--/.col-->

            <!-- search -->
            <div class="col-md-12">
				<div class="panel panel-default articles">
					<div class="panel-heading">
                        Transactions
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fas fa-caret-down"></em></span></div>
					<div class="panel-body articles-container">
                      
                       <br>
                       <table id="booksTable" class="table">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Book Borrowed</th>
                            <th>Date Borrowed</th>
                            <th>Date Returned</th>
                            <th>Penalties</th>
                        </tr> 
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->user->first_name }} {{ $transaction->user->middle_name }} {{ $transaction->user->last_name }} {{ $transaction->user->extension }}</td>
                            <td>{{ $transaction->user->email }}</td>
                            <td>{{ $transaction->book->book_title }}</td>
                            <td>{{ $transaction->date_borrowed }}</td>
                            <td>{{ $transaction->date_returned }}</td>       
                            <td>0</td>                 
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