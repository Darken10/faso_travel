<?php

namespace App\Http\Controllers\Chat;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Role;
use App\Models\User;
use App\Models\Compagnie;
use App\Models\Chat\Message;
use Illuminate\Http\Request;
use chillerlan\QRCode\QRCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Chat\MessageFormRequest;
use App\Notifications\MessageRecivedNotification;

class MessageController extends Controller
{


    private function unreadCount(User $user){
        $me = Auth::user()->id;
        $unreadCount = Message::query()->where('to_id',$me)->groupBy('from_id')->selectRaw("from_id, COUNT(id) as count")->whereRaw("read_at IS NULL")->get()->pluck('count','from_id');
        if( isset($unreadCount[$user->id])){
            Message::query()->where('from_id',$user->id)->where('to_id',$me)->update(['read_at'=>Carbon::now()]);
            unset($unreadCount[$user->id]);
        }
    }

    function index() {

        //$users = User::all()->where('id','!=',Auth::user()->id) ;
        $compagnies = Compagnie::all();

        return view('chat.index',[
            'compagnies'=> $compagnies,
        ]);
    }

    function show(User $user) {
        $to = $user->id;
        $me = Auth::user()->id;
        $users = User::all()->where('id','!=',$me) ;
        $messages = Message::query()->whereRaw("((from_id = $me and to_id = $to) or (from_id = $to and to_id = $me)) ")->orderBy('created_at','DESC')->get()->reverse();
               
        $unreadCount = $this->unreadCount($user);

        return view('chat.show',[
            'user'=>$user,
            'users'=> $users,
            'messages'=>$messages,
            'unreadCount' => $unreadCount,
        ]);
    }

    function store(MessageFormRequest $request,User $user) {
        $data = $request->validated();
        $data['from_id'] = Auth::user()->id;
        $data['to_id'] = $user->id;
        $message = Message::create($data);
        
        //$user->notify(new MessageRecivedNotification($message));

        return back();
    }


    function compagnieShow(Compagnie $compagnie) {
        
        $admin = $compagnie->admins->pluck('id');
        $l = "(";
        foreach($admin as $a){
            $l = $l.$a.',';
        }
        $l = $l.'0 )';
        $user = $compagnie?->admins[0];

        $to = $user->id;
        $me = Auth::user()->id;
        //$users = User::all()->where('id','!=',$me) ;
        //$messages = Message::query()->whereRaw("((from_id = $me and to_id = $to) or (from_id = $to and to_id = $me)) ")->orderBy('created_at','DESC')->get()->reverse();
        
        $messages = Message::query()->whereRaw("((from_id = $me and to_id in $l) or (from_id IN $l and to_id = $me)) ")->orderBy('created_at','DESC')->get()->reverse();
               
        $unreadCount = $this->unreadCount($user);

        $compagnies = Compagnie::all();

        return view('chat.compagnieShow',[
            'user'=>$user,
            'compagnies'=> $compagnies,
            'messages'=>$messages,
            'unreadCount' => $unreadCount,
        ]);

    }


    function compagnieStore(MessageFormRequest $request,Compagnie $compagnie) {
        $data = $request->validated();
        $data['from_id'] = Auth::user()->id;
        $data['to_id'] = $compagnie?->admins[0]?->id;
        $message = Message::create($data);
        
        //$user->notify(new MessageRecivedNotification($message));

        return back();
    }
}
