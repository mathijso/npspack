<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionController extends Controller
{
    /**
     * Display the subscription selection view.
     *
     * @return \Illuminate\View\View
     */
    public function show(): View
    {
        // Simply return the view we created earlier
        return view('subscribe');
    }
}
