<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BookRentController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
        $books = Book::all();
        return view ('book-rent', ['users' => $users, 'books' => $books]);
    }

    public function store(Request $request)
    {
        $request['rent_date'] = Carbon::now()->toDateString();
        $request['return_date'] = Carbon::now()->addDay(3)->toDateString(); 
        

        $book = Book::findOrFail($request->book_id)->only('status');

        if($book['status'] != 'in stock') {
            Session::flash('message', 'Cannot rent, the book is not available'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('book-rent');
        }

        else {
            $count = RentLogs::where('user_id', $request->user_id)->where('actual_return_date', null)->count();

            if ($count >= 3) {
                Session::flash('message', "Can't rent, user has reach limit of books");
                Session::flash('alert-class', "alert-danger");
                return redirect('book-rent');
                
        } 
        else {
            try {
                // Database Transaction karena lebih dari 1 proses
                DB::beginTransaction();

                // process insert to rent_logs table
                RentLogs::create($request->all());

                // process update book table
                $book = Book::findOrFail($request->book_id);
                $book->status = 'not available';
                $book->save();
                DB::commit();

                Session::flash('message', "Rent Book Success");
                Session::flash('alert-class', "alert-success");
                return redirect('book-rent');
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        }
    }
    if ($request->has('tambah_jumlah') && is_numeric($request->book_id)) {
        $message = 'Halo ' . $users->name . ', berhasi meminjam buku.' . $books($request->book_id, 0, ',', '.') . '. ';
    
    }
    
    $message .= 'Total tabungan Anda sekarang: ' . number_format($users->jumlah, 0, ',', '.') . ', per tanggal : ' . date('d-m-Y', strtotime($student->tanggal));

   
    require '../vendor/autoload.php';

   
    $client = new Client([
        'base_uri' => "https://gg64k8.api.infobip.com/",
        'headers' => [
            'Authorization' => "App f9f7f9aaa9883691ac0edd251a3a8224-60e5f59e-7786-4608-9556-ee0a526af169",
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ]
    ]); 
      
    try {
        
        $response = $client->post(
            '/sms/2/text/advanced',
            [
                RequestOptions::JSON => [
                    "messages" => [
                        [
                            "from" => " ER PE EL",
                            "destinations" => [
                                "to" => "$users"
                            ],
                            "text" =>  $message
                        ]
                    ]
                ]
            ]
        );
        
       
        if ($response->getStatusCode() == 200) {
            echo "Pesan berhasil dikirim ke " . substr($users->book_id, 1);
        } else {
            echo "Pesan gagal dikirim. Status Code: " . substr($users->book_id, 1);
        }
        
    } catch (Exception $e) {
        echo "Pesan gagal dikirim. Error: " . substr($user->book_id, 1);
    }
}

        public function returnBook()
        {
            $users = User::where('id', '!=', 1)->where('status', '!=', 'inactive')->get();
            $books = Book::all();
            return view('return-book', ['users' => $users, 'books' => $books]);
        }

        public function saveReturnBook(Request $request)
        {
            $rent = RentLogs::where('user_id', $request->user_id)->where('book_id', $request->book_id)->where('actual_return_date', null);
            $rentData = $rent->first();
            $countData = $rent->count();
            

            if($countData == 1) {
                $rentData->actual_return_date = Carbon::now()->toDateString();
                $rentData->save(); 

                Session::flash('message', "Book returned is successfully");
                Session::flash('alert-class', "alert-success");
                return redirect('return-book');
            }
            else {
                Session::flash('message', "There error in this process");
                Session::flash('alert-class', "alert-danger");
                return redirect('return-book');
            }
            
        }

}
