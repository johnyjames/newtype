<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    //

    public function welcome()
    {
        return view('welcome');
    }


    public function generate(Request $request)
    {

        //find if link is already created
        $link =Link::where('vader',$request->vader)->where('luke',$request->luke)->first();
        if(!$link)
        {
            if($request->getMethod()=='POST')
            {
                //generate unique short urls
                $request->merge(['link'=>base_convert(rand(10000,99999), 10, 36)]);
                //create record in db
                $this->validate($request, [
                    'vader' => 'required'
                ],[
                    'vader.required' => 'First part is required.',
                ]);

                $link =Link::create($request->all());
            }

        }

        return view('welcome')->with('link',$link);
    }


    public function preview($slug)
    {
        $link= Link::where('link',$slug)->first();
        return view('preview')->with('link',$link);
    }

    public function recording($slug)
    {
        $link= Link::where('link',$slug)->first();
        if($link)
            return view('recording')->with('link',$link);

        return "Not found!";
    }

    public function playback()
    {
        return view('playback');
    }

}
