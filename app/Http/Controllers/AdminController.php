<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Transaction;
use App\Token;
use App\Reservation;
use Carbon\Carbon;
use Hash;
use PDF;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $books = Book::all();
         return view('admin.index',compact('books'));
    }
    public function userRegistration()
    {
        $books = Book::all();
         return view('admin.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function downloadPDF(Request $request){
        $book = $request->book;
        $pdf = PDF::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>A</h1>');
        return $pdf->stream();
        // $pdf = PDF::loadView('pdf');
        // return $pdf->download($request->book.'.pdf');
 
      }
    public function scanBook(Request $request)
    {
        $book = Book::where('book_number' , $request->book_number)->first();
        if(!$book){
            return redirect()->back()->with('error', 'Book Not Found');
        }
        $reservation = Reservation::where('book_id', $book->id)->get();
        $transaction = Transaction::where('book_id', $book->id)->where('return_date', NULL)->get();
        $count = count($reservation);
        $count += count($transaction);
        $count = $book->stocks - $count;

        $allReservation = Reservation::where('book_id', $book->id)->get();
        $allTransaction = Transaction::where('book_id', $book->id)->get();


        return view('admin.view-book',compact('book', 'count','reservation','transaction','allReservation','allTransaction'));
    }
    public function viewBook(Request $request)
    {
        $book = Book::where('id' , $request->book_id)->first();
        $reservation = Reservation::where('book_id', $request->book_id)->get();
        $transaction = Transaction::where('book_id', $request->book_id)->where('return_date', NULL)->get();
        $count = count($reservation);
        $count += count($transaction);
        $count = $book->stocks - $count;

        $allReservation = Reservation::where('book_id', $request->book_id)->get();
        $allTransaction = Transaction::where('book_id', $request->book_id)->get();


        return view('admin.view-book',compact('book', 'count','reservation','transaction','allReservation','allTransaction'));
        
    }
    public function csvBookDownload()
    {
        $books = Book::all(); 
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($books, ['book_title','author','shelf_number','stocks'])
        ->download('books.csv');
    }
    public function tokens(Request $request)
    {
       
       $iteration = $request->tokens;
       $count = 1;
       while($count <= $iteration){
            $token = new Token;
            $token->token = strtoupper(str_random(4));
            $token->save();

            $count++;
       }
       return redirect()->back();

    }
    public function addUser(Request $request)
    {
        $user = new User; 
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        if($request->extension != NULL){
            $user->last_name = $request->last_name;
        }
        $user->email = $request->email;
        $user->password = Hash::make(strtolower($request->first_name.$request->last_name));
        $user->save();

        return redirect()->back()->with('success', 'New User Added!');
        


        
    }
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        $reserve = Reservation::where('user_id', $id)->get();
        $transaction = Transaction::where('user_id', $id)->get();

        foreach($reserve as $r){
            $r->delete();
        }
        foreach($transaction as $t){
            $t->delete();
        }

        return redirect()->back()->with('success', ' User Deleted!');
    }
    public function deleteBook($id)
    {
        $book = Book::find($id);
        $book->delete();

        $reserve = Reservation::where('book_id', $id)->get();
        $transaction = Transaction::where('book_id', $id)->get();

        foreach($reserve as $r){
            $r->delete();
        }
        foreach($transaction as $t){
            $t->delete();
        }

        return redirect()->back()->with('success', ' Book Deleted!');
    }
    public function csvBookUpload(Request $request)
    {
        $file = $request->file('importCsv');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        foreach($rows as $row){
            if(count($row) != count($header)){
                return redirect()->back();
            }
                $row = array_combine($header , $row);
                $book = Book::where('book_title' , $row['book_title'])->get();
                if(count($book) == 0){
                    Book::create([
                                'book_title' => $row['book_title'],
                                'author' => $row['author'],
                                'shelf_number' => $row['shelf_number'],
                                'stocks' => $row['stocks'],
                                'book_number' => mt_rand( 10000000, 99999999),
                            ]);
                }   
            }
            return redirect()->back();
     
    }
    // user
    public function image(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        return $imageName;
        $image->move(public_path('images'),$imageName);
        
        $imageUpload = new ImageUpload();
        $imageUpload->filename = $imageName;
        $imageUpload->save();
        return response()->json(['success'=>$imageName]);
    }
    public function getUsers()
    {
        $users = User::all();
        
        return view('admin.user',compact('users'));
    }
    public function updateUser($id, Request $request)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->middle_name = $request->middle_name;
        if($request->extension != NULL){
            $user->extension = $request->extension;
        }
        $user->save();

        return redirect()->back();
    }
    public function resetPassword($id, Request $request)
    {
        $user = User::find($id);
        $user->password = Hash::make(strtolower($user->first_name.$user->last_name));
        $user->save();

       
        return redirect()->back();
    }
    public function viewUser(Request $request)
    {
        $user = User::find($request->user_id);

        
        return view('admin.view-user',compact('user'));
    }
    public function updateBook(Request $request, $id)
    {
        $book = Book::find($id);
        $book->book_title = strtoupper($request->name);
        $book->stocks = $request->quantity;
        $book->author = $request->author;
        $book->shelf_number = $request->shelf;
        $book->save();

        
        return redirect()->back();
    }
    public function addBook(Request $request)
    {
        $book = new Book;
        $book->book_title = strtoupper($request->name);
        $book->author = strtoupper($request->author);
        $book->stocks = $request->quantity;
        $number = mt_rand( 10000000, 99999999);
        $find = Book::where('book_number' , $number)->get();
        if(count($find) == 1){
            while(count($find) == 1){
                $number = mt_rand( 10000000, 99999999);
                $find = Book::where('book_number' , $number)->first();
            }
        }
        $book->book_number = $number;
        $book->shelf_number = $request->shelf_number;
        $book->save();

        return redirect()->back();



    }
    public function csvUserDownload()
    {
        $users = User::all(); 
        $csvExporter = new \Laracsv\Export();
        $csvExporter->build($users, ['first_name','last_name','middle_name','extension','email'])
        ->download('users.csv');
    }
    public function csvUserUpload(Request $request)
    {
        $file = $request->file('importCsv');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        foreach($rows as $row){
            if(count($row) != count($header)){
                return redirect()->back();
            }
                $row = array_combine($header , $row);
                $user = User::where('email' , $row['email'])->get();
                if(count($user) == 0){
                    User::create([
                                'first_name' => $row['first_name'],
                                'last_name' => $row['last_name'],
                                'middle_name' => $row['middle_name'],
                                'extension' => $row['extension'],
                                'email' => $row['email'],
                                'password' => Hash::make(strtolower($row['first_name'] . $row['last_name'])),
                            ]);
                }   
            }
            return redirect()->back();
     
    }

    // transactions

    public function transactions()
    {
       $transactions = Transaction::all();
        
        return view('admin.transactions',compact('transactions'));
    }
    public function borrow(Request $request)
    {
        $reservation = Reservation::where('user_id', $request->user_id)->where('book_id', $request->book_id)->first();
        $reservation->delete();

        $transaction = new Transaction;
        $transaction->user_id = $request->user_id;
        $transaction->book_id = $request->book_id;
        $transaction->date_borrowed = Carbon::now()->format('Y-m-d');
        $transaction->save();
        
        return redirect()->back()->with('success', 'Transaction successful!');
    }
    public function return($id)
    {
     

        $transaction = Transaction::find($id);
        $transaction->return_date = Carbon::now()->format('Y-m-d');
        $transaction->save();

        $countDays = Carbon::parse($transaction->date_borrowed)->diffInDays();

        $penalty= ($countDays - 3)*5;
        if($penalty < 0){
            $penalty = 0;
        }
        
        
        return redirect()->back()->with('success', 'Book Returned! Total Penalty: Php '.$penalty.'.00');
    }
    public function addTransaction(Request $request)
    {

        // explode values to have the id of book[0] and user[1]
        $filter = explode(',' , $request->qr_input);
        $reserve = Reservation::where('user_id', $filter[1])->where('book_id', $filter[0])->first();
        if(!$reserve){

        }
        else{
            $reserve->delete();
        }
        // check if he has 3 or less books
        $count = Transaction::where('user_id',$filter[1])->get();
        if(count($count) < 3){
             // add transaction
            $new = new Transaction;
            $new->user_id = $filter[1];
            $new->book_id = $filter[0];
            $new->date_borrowed = Carbon::now()->format('Y-m-d');
            $new->save();
        }
        else{
            return redirect()->back()->with('error', 'This user already has the maximum number book borrowed at a time (3). '); 
        }
   
        
        return redirect()->back()->with('success', 'Transaction Successful! ');
    }
    

}
