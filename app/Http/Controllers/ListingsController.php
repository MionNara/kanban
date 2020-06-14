<?php

namespace App\Http\Controllers;

use App\Listing;
use Auth;
use Validator;

use Illuminate\Http\Request;

class ListingsController extends Controller
{
    //コンストラクタ（このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //Listingモデルを介してlistingテーブルからデータを取得
        //条件：user_idが現在ログインしているユーザーIDと一致している
        //並べ替え：作成日の昇順
        $listings = Listing::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'asc')
            ->get();
            
        //テンプレート「Listing/index.blade.php」を表示
        //モデルを介してデータベースからデータを取得した痕、bladeにその値を渡している。view関数の第二引数を使用
        return view('listing/index', ['listing' => $listings]);
    }
    
    public function new()
    {
        return view('listing/new');
    }
    
    public function store(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all() , ['list_name' => 'required|max:255' , ]);
        
        //バリデーションの結果がエラーの場合
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        //Listingモデル作成
        $listings = new Listing;
        $listings->title = $request->list_name;
        $listings->user_id =Auth::user()->id;
        
        $listings->save();
        //「/」ルートにリダイレクト
        return redirect('/');
    }
    
    public function edit($listing_id)
    {
        $listing = Listing::find($listing_id);
        //テンプレート「listing/edit.blade.php」を表示します。
        return view('listing/edit' , ['listing' => $listing]);
    }
    
    
    public function update(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all() , ['list_name' => 'required|max:255', ]);

        //バリデーションの結果がエラーの場合
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }
        
        $listing = Listing::find($request->id);
        $listing->title = $request->list_name;
        $listing->save();
        return redirect('/');
    }

    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return redirect('/');
    }
}
