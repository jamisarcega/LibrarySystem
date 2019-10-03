<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;
use Carbon\Carbon;
use App\Transaction;
use App\Reservation;
use Auth;
use Hash;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('user.books');
    }
    public function books()
    {

        $books = Book::all();

        return view('books', compact('books'));
    }
    public function userUpdate(Request $request)
    {
        $find = User::where('id' , Auth::user()->id)->first();
           if($request->new == NULL){
                $find->first_name = $request->name;
                $find->middle_name = $request->middle_name;
                $find->last_name = $request->last_name;
                $find->extension = $request->extension;
           }
            else if($request->retype == $request->new){
                if(Hash::check($request->current, Auth::user()->password)){
                    $find->password = Hash::make($request->new);
                    return redirect()->back()->with('success', 'Password updated!');
                 }
                 else{
                     return redirect()->back()->with('error', 'Current Password did not match.');
                 }


            }
            else{
                $find->first_name = $request->name;
                $find->middle_name = $request->middle_name;
                $find->last_name = $request->last_name;
                $find->extension = $request->extension;
                if(Hash::check($request->current, Auth::user()->password)){
                    $find->password = Hash::make($request->new);
                    return redirect()->back()->with('success', 'Password updated!');
                 }
                 else{
                     return redirect()->back()->with('error', 'Current Password did not match.');
                 }

            }
            $find->save();

            return redirect()->back()->with('success', 'Profile updated!');
            
       
    }
    public function viewBook(Request $request)
    {
        $book = Book::where('id',$request->book_id)->first();
        $reservation = Reservation::where('book_id', $request->book_id)->where('user_id', Auth::user()->id)->first();

        return view('view-book',compact('book','reservation'));
    }
    public function reserve(Request $request)
    {
        $reservation = new Reservation;
        $reservation->book_id = $request->book_id;
        $reservation->user_id = Auth::user()->id;
        $reservation->upto = Carbon::now()->addDays(3);
        $reservation->save();


        return redirect()->back();
    }
    public function deleteReservation($id)
    {
        $reservation = Reservation::find($id);
        $reservation->delete();


        return redirect()->back();
    }
    public function borrowHistory(Request $request)
    {
        $books = Transaction::where('user_id',Auth::user()->id)->get();

        $now = Carbon::now()->format('Y-m-d');
     
        
        return view('history',compact('books','now'));
    }
}
