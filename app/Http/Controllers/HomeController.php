<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redmine\Client;

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
        $client = new Client('http://redmine.salesdoubler.net', auth()->user()->redmine_api_token);
        $result = $client->get('/time_entries.json');

        return view('home');
    }

    public function jira()
    {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://varteq.atlassian.net/rest/api/3/issue/FF-174',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic b2xhdnJlY2hrb0B2YXJ0ZXEuY29tOkVMOVM1RzRqRnpiR1prbk9IOU5pQzlFQg==',
                'Cookie: atlassian.xsrf.token=BROP-XBHX-CP0R-MVIF_863bb7954065d5d639210d54a3390eb6ab96414c_lin'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }
}
