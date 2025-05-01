<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

// ... existing code ...

// Homepage Route
Volt::route('/', 'livewire.homepage')
    ->name('home'); // Optional: name the route 'home'

// ... existing code ... 