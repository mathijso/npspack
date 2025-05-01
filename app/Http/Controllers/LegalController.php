<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class LegalController extends Controller
{
    /**
     * Display the privacy policy page.
     */
    public function privacy(Request $request): View
    {
        return view('legal.privacy');
    }

    /**
     * Display the terms of service page.
     */
    public function terms(Request $request): View
    {
        return view('legal.terms');
    }
} 