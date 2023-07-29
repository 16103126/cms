<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorVarificationMail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'age',
        'gender',
        'nid',
        'about',
        'address',
        'image',
        'email',
        'phone_number',
        'phone_code',
        'password',
        'google_id',
        'facebook_id',
        'twofa_code',
        'isTwoFa',
        'sending_type',
        'isDeactivate',
        'isOnline',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendCode()
    {
        $user = Auth::guard('user')->user();
        $code = rand(1000, 9999);
        $user->twofa_code = $code;
        $user->update();

        if($user->sending_type == 0)              
        {
            // Mail::to($user->email)->send(new TwoFactorVarificationMail($user));
            return response()->json(['send' => 'Code send to your gamil.']);
        }

        $receiverNumber = $user->phone_number;
        $message = '2FA login code is '. $code;

        try {

            $account_sid = 'AC09d9953ba1841481d5f38484b35ca745';
            $auth_token = '00061f5dcca77499eee606af74f164a2';
            $twilio_number = '8801724938906';
            // dd($auth_token);
    
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
    
        } catch (Exception $e) {
            info("Error: ". $e->getMessage());
        }
        
        return redirect()->route('user.twofa.form');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id', 'id');
    }
}
