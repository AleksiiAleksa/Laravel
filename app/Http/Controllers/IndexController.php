<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use App\Medicine;
use App\Maker;
use App\Category;
use App\Cart;
use App\Medicinebooking;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use \Datetime;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function Search(Request $request)
    {
        $s = $request->s;
        $medicines = Medicine::select()->where('title', 'LIKE', "%{$s}%")->orderBy('title')->get();
        $categories = Category::select()->get();
        return view("index")->with(["medicines" => $medicines, "categories" => $categories]);
    }

    public function Search2(Request $request, $number)
    {
        $s = $request->s;
        $categories = Category::select()->get();
        $medicines = Medicine::select()->where([
            ['title', 'LIKE', "%{$s}%"],
            ['category_id', '=', $number],
        ])->orderBy('title')->get();
        return view("category")->with(["medicines" => $medicines, "categories" => $categories]);
    }

    public function Index()
    {
        $medicines = Medicine::select()->get();
        $categories = Category::select()->get();

        $date = new DateTime();
        $date->modify('-1 day');
        $date = date_format($date, 'Y-m-d');

        $client = new Client();

        $response = $client->request('GET', 'https://covid-19-statistics.p.rapidapi.com/reports', [
            'headers' => [
                'x-rapidapi-host' => 'covid-19-statistics.p.rapidapi.com',
                'x-rapidapi-key' => '43d5cb7798msh933c7753d47baecp1b947djsnf39e7c2f5a7a'
            ],
            'query' => [
                'iso' => 'RUS',
                'region_name' => 'Russia',
                'date' => $date
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        $confirmed_diff = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['confirmed_diff'];
        }, 0);

        $deaths_diff = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['deaths_diff'];
        }, 0);

        $confirmed = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['confirmed'];
        }, 0);

        $deaths = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['deaths'];
        }, 0);

        $covidData = [
            'confirmed_diff' => $confirmed_diff,
            'deaths_diff' => $deaths_diff,
            'confirmed' => $confirmed,
            'deaths' => $deaths
        ];

        return view("index")->with(["medicines" => $medicines,  "categories" => $categories, "covidData" => $covidData]);
    }
    
    public function Buying($auth)
    {
        $cart = Cart::select(['medicine_id', 'user_id', 'amount', 'created_at'])
                 ->where('user_id', '=', $auth)
                 ->get();
        if (!$cart -> isEmpty())
        {
            foreach($cart as $record)
            {
                DB::insert('insert into medicinebooking (medicine_id, user_id, amount, created_at) values (?, ?, ?, ?)', [$record->medicine_id,$record->user_id,$record->amount, $record->created_at] );
            }
        }
        Cart::where('user_id', $auth)->delete();
        return IndexController::ShowCart("in");
    }
    
    public function ChangeCart(Request $request)
    {
        $cart = Cart::select()
                 ->where('medicine_id', '=',$request ->medicine)
                 ->where('user_id', '=', $request ->authen)
                 ->first();
        if ($cart != null) {
             $cart->delete();
        }
        if($request->output != 0)
        {
        $cart = new Cart;
        $cart->medicine_id = $request->medicine;
        $cart->user_id = $request->authen;
        $cart->amount = $request->output;
        $cart->save();
        }
        return IndexController::Description($request ->medicine, $request ->authen);
        
    }
    
    public function ShowCart($auth)
    {
        $cart = Cart::select()->get();
        $supply = DB::table('supply')
                 ->select('medicine_id', DB::raw('sum(amount) as total'))
                 ->groupBy('medicine_id')
                 ->get();
        $order = DB::table('medicinebooking')
                 ->select('medicine_id', DB::raw('sum(amount) as total'))
                 ->groupBy('medicine_id')
                 ->get();
        return view("cart")->with(["auth" => $auth, "cart" => $cart, "supply" => $supply,"order" => $order]);
    }

    public function ChangeCartIn(Request $request)
    {
        $cart = Cart::select()
                 ->where('medicine_id', '=',$request ->medicine)
                 ->where('user_id', '=', $request ->authen)
                 ->first();
        if ($cart != null) {
             $cart->delete();
        }
        if($request->output != 0)
        {
        $cart = new Cart;
        $cart->medicine_id = $request->medicine;
        $cart->user_id = $request->authen;
        $cart->amount = $request->output;
        $cart->save();
        }
        return IndexController::ShowCart("in");
        
    }
    public function ShowCategory($number)
    {
        $medicines = Medicine::select()->where('category_id', $number)->get();
        $categories = Category::select()->get();
        
         $date = new DateTime();
        $date->modify('-1 day');
        $date = date_format($date, 'Y-m-d');

        $client = new Client();

        $response = $client->request('GET', 'https://covid-19-statistics.p.rapidapi.com/reports', [
            'headers' => [
                'x-rapidapi-host' => 'covid-19-statistics.p.rapidapi.com',
                'x-rapidapi-key' => '43d5cb7798msh933c7753d47baecp1b947djsnf39e7c2f5a7a'
            ],
            'query' => [
                'iso' => 'RUS',
                'region_name' => 'Russia',
                'date' => $date
            ]
        ]);

        $response = json_decode($response->getBody()->getContents(), true);

        $confirmed_diff = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['confirmed_diff'];
        }, 0);

        $deaths_diff = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['deaths_diff'];
        }, 0);

        $confirmed = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['confirmed'];
        }, 0);

        $deaths = array_reduce($response['data'], function($sum, $element) {
            return $sum + $element['deaths'];
        }, 0);

        $covidData = [
            'confirmed_diff' => $confirmed_diff,
            'deaths_diff' => $deaths_diff,
            'confirmed' => $confirmed,
            'deaths' => $deaths
        ];

        return view("category")->with(["medicines" => $medicines, "categories" => $categories, "number" => $number, "covidData" => $covidData]);
    }

    public function Description($id, $auth)
    {
        $medicine = Medicine::select()->where('id_medicine', $id)->first();
        $supply = DB::table('supply')
                 ->select('medicine_id', DB::raw('sum(amount) as total'))
                 ->where('medicine_id', $id)
                 ->groupBy('medicine_id')
                 ->first();
        $order = DB::table('medicinebooking')
                 ->select('medicine_id', DB::raw('sum(amount) as total'))
                 ->where('medicine_id', $id)
                 ->groupBy('medicine_id')
                 ->first();
        $cart = DB::table('cart')
                 ->select()
                 ->where('medicine_id',$id)
                 ->where('user_id',$auth)
                 ->first();
        if($cart === null)
        {
            $amount = 0;
        }
        else
        {
            $amount = $cart->amount;
        }
        $categories = Category::select()->get();
        return view("description")->with(["medicine" => $medicine, "categories" => $categories, "supply" => $supply,"order" => $order, "amount" => $amount]);
    }

    public function New()
    {
        return view("add");
    }

    public function AddNews(Request $r)
    {
        $this->validate($r, ['title' => 'required', 'image' => 'required']);
        $data = $r->all();
        $apteka = new Apteka();
        $apteka->fill($data);
        $apteka->save();
        return redirect('/');
    }

    public function DeleteNews($id)
    {
        $id = Apteka::select()->where('id', $id)->first();
        $id->delete();
        return redirect('/');
    }
}
