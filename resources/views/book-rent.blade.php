@extends('layouts.mainlayout')

@section('title', 'Book Rent')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        <h1 class="mb-5">Book Rent Form</h1>

    <div class="mt-5">
        @if (session('message'))
            <div class="alert {{ session('alert-class') }} mt-5">
                {{ session('message') }}
            </div>
        @endif
    </div>

        <form action="book-rent" method="post">
            @csrf
            <div class="mb-3">
                <label for="user" class="form-label">User</label>
                <select name="user_id" id="user" class="form-control inputbox">
                    <option value="">Select User</option>
                    @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="book" class="form-label">Book</label>
                <select name="book_id" id="book" class="form-control inputbox">
                    <option value="">Select Book</option>               
                @foreach ($books as $item)
                <option value="{{ $item->id }}">{{ $item->title }}</option>
                @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </form>
    </div>
    <div class="mt-5 col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
        
    
    <form method="post" action="">
                <h2>Kirim SMS Peminjaman</h2>
                <hr>
                <table align="center">
                    <tr>
                        <td>No. Tujuan</td>
                        <td><input type="text" name="no_tujuan"></td>
                    </tr>
                    <tr>
                        <td>Isi Pesan</td>
                        <td><textarea name="isi_pesan" ></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" class="btn btn-primary" name="bkirim">kirim</button></td>
                    </tr>
                </table>
            </form>
    </div>

    <?php
    if(isset($_POST['bkirim'])){
        $no_tujuan = $_POST['no_tujuan'];
        $isi_pesan = $_POST['isi_pesan'];

        $sending = sendsms($no_tujuan, $isi_pesan);
        if($sending == "success"){
            echo "Pesan berhasil dikirim";
        }else {
            echo "Pesan gagal dikirim";
        }
    }
        function sendsms($no_tujuan, $pesan)
        {
            $idmesin = "312";
            $pin = "125603";

            $pesan = str_replace("", "20%", $pesan);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, "https://sms.indositus.com/sendsms.php?idmesin=$idmesin&pin&to=$no_tujuan&text=$pesan");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $output = curl_exec($ch);

            $curl_close($ch);

            return $output;
        }
    
    ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
   $(document).ready(function() {
    $('.inputbox').select2();
});
</script>

@endsection