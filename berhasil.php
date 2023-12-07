if ($request->has('tambah_jumlah') && is_numeric($request->tambah_jumlah)) {
            $message = 'Halo ' . $student->name . ', jumlah tabungan Anda telah bertambah Rp.' . number_format($request->tambah_jumlah, 0, ',', '.') . '. ';
        } else if ($request->has('kurangi_jumlah') && is_numeric($request->kurangi_jumlah)) {
            $message = 'Halo ' . $student->name . ', jumlah tabungan Anda telah berkurang Rp.' . number_format($request->kurangi_jumlah, 0, ',', '.') . '. ';
        }
        
        $message .= 'Total tabungan Anda sekarang: ' . number_format($student->jumlah, 0, ',', '.') . ', per tanggal : ' . date('d-m-Y', strtotime($student->tanggal));

       
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
                                    "to" => "6289508190767"
                                ],
                                "text" =>  $message
                            ]
                        ]
                    ]
                ]
            );
            
           
            if ($response->getStatusCode() == 200) {
                echo "Pesan berhasil dikirim ke " . substr($student->nomor_telepon, 1);
            } else {
                echo "Pesan gagal dikirim. Status Code: " . substr($student->nomor_telepon, 1);
            }
            
        } catch (Exception $e) {
            echo "Pesan gagal dikirim. Error: " . substr($student->nomor_telepon, 1);
        }