<?php

// namespace App\Http\Controllers;

// use App\Http\Requests\ProfileUpdateRequest;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Redirect;
// use Illuminate\View\View;

// class ProfileController extends Controller
// {
//   /**
//    * Display the user's profile form.
//    */
//   public function edit(Request $request): View
//   {
//     // dd($request->user());

//     return view('profile.edit', [
//       'user' => $request->user(),
//     ]);
//   }

//   /**
//    * Update the user's profile information.
//    */
//   public function update(ProfileUpdateRequest $request): RedirectResponse
//   {
//     $request->user()->fill($request->validated());

//     if ($request->user()->isDirty('email')) {
//       $request->user()->email_verified_at = null;
//     }

//     $request->user()->save();

//     return Redirect::route('profile.edit')->with('status', 'profile-updated');
//   }

//   /**
//    * Delete the user's account.
//    */
//   public function destroy(Request $request): RedirectResponse
//   {
//     $request->validateWithBag('userDeletion', [
//       'password' => ['required', 'current_password'],
//     ]);

//     $user = $request->user();

//     Auth::logout();

//     $user->delete();

//     $request->session()->invalidate();
//     $request->session()->regenerateToken();

//     return Redirect::to('/');
//   }

//   public function updatePassword(Request $request)
//   {
//     $request->validate([
//       'current_password' => ['required', 'current_password'],
//       'password' => ['required', 'string', 'min:8', 'confirmed'],
//     ]);

//     $user = $request->user();
//     $user->update(['password' => Hash::make($request->password)]);

//     return back()->with('status', 'password-updated');
//   }
// }



namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ProfileController extends Controller
{
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request): View
  {
    return view('profile.edit', [
      'user' => $request->user(),
    ]);
  }

  /**
   * Update the user's profile information (name).
   */
  public function update(ProfileUpdateRequest $request): RedirectResponse
  {
    $request->user()->fill($request->validated());

    if ($request->user()->isDirty('email')) {
      $request->user()->email_verified_at = null;
    }

    $request->user()->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
  }

  /**
   * Update the user's email address.
   */
  public function updateEmail(Request $request): RedirectResponse
  {
    $request->validate([
      'email' => ['required', 'email', 'unique:users,email,' . $request->user()->id],
    ]);

    $request->user()->update(['email' => $request->email]);

    // Re-send verification email if needed
    if ($request->user()->email_verified_at === null) {
      $request->user()->sendEmailVerificationNotification();
    }

    return Redirect::route('profile.edit')->with('status', 'email-updated');
  }

  /**
   * Update the user's password.
   */
  public function updatePassword(Request $request): RedirectResponse
  {
    $request->validate([
      'current_password' => ['required', 'current_password'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    $user = $request->user();
    $user->update(['password' => Hash::make($request->password)]);

    return back()->with('status', 'password-updated');
  }
}
