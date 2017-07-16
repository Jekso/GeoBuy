<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;
use Auth;
use Socialite;
use Validator;

class AppController extends Controller
{



    // get login page
    public function getLogin()
    {
        return view('login');
    }



    // fb_redirect route
    public function redirect()
    {
        return Socialite::driver('facebook')->scopes(['email'])->redirect();
    }



    // fb_callback route
    public function callback()
    {
        $callback_user_info = Socialite::driver('facebook')->user();
        $user = User::where('user_id', $callback_user_info->id)->first();
        if(!$user)
        {
            $user = new User;
            $user->add_new_user($callback_user_info);
        }
        Auth::login($user);
        return redirect()->route('payment');
    }




    // logout from system
    public function getLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }




    // get user product payment form
    public function getPaymentForm()
    {
        $orders = Auth::user()->orders;
        return view('payment_view', compact('orders'));
    }





    // submit payment
    public function postPaymentWithStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone'         => 'required',
            'full_addr'     => 'required',
            'location'      => 'required',
            'qty'           => 'required',
            'card_no'       => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear'  => 'required',
            'cvvNumber'     => 'required',
        ]);

        $input = $request->all();
        if ($validator->passes())
        {
            $input = array_except($input,array('_token'));
            $stripe = Stripe::make('sk_test_fMT36ye9erELBy0b7EtJIbgl');
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number'    => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year'  => $request->get('ccExpiryYear'),
                        'cvc'       => $request->get('cvvNumber'),
                    ],
                ]);
                if (!isset($token['id']))
                    return redirect()->route('payment')->with('error','The Stripe Token was not generated correctly');

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount'   => $request->qty*50,
                    'description' => 'Test Product',
                ]);

                if($charge['status'] == 'succeeded')
                {
                    $request->user()->save_order($request);
                    return redirect()->route('payment')->with('success','You have successffuly Bought our Product.');
                }
                else
                    return redirect()->route('payment')->with('error','Money not add in wallet!!');
            }
            catch (Exception $e)
            {
                return redirect()->route('payment')->with('error',$e->getMessage());
            }
            catch(\Cartalyst\Stripe\Exception\CardErrorException $e)
            {
                return redirect()->route('payment')->with('error',$e->getMessage());
            }
            catch(\Cartalyst\Stripe\Exception\MissingParameterException $e)
            {
                return redirect()->route('payment')->with('error',$e->getMessage());
            }
        }
        return redirect()->back()->with('error','All fields are required!!');
    }


}
