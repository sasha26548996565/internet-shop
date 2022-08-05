<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LikeController extends Controller
{
    public function add(User $user, Product $product): RedirectResponse
    {
        $user->likedProducts()->toggle($product->id);

        return redirect()->back();
    }
}
