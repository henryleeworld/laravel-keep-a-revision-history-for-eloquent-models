<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function track() 
    {
        $user = User::find(1);
        echo __('The original name of user ID :id is: :name and the original email is: :email', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]) . PHP_EOL;
        $user->name  = __('Clark Kent');
        $user->email = 'superman@justice-league.com';
        $user->save();
        $user = User::find(1);
        echo __('The updated name of user ID :id is: :name and the updated email is: :email', ['id' => $user->id, 'name' => $user->name, 'email' => $user->email]) . PHP_EOL;
        $userRevisionHistory = $user->revisionHistory;
        foreach ($userRevisionHistory as $history) {
            echo ($history->key == 'created_at' && !$history->old_value) ? NULL : __($history->fieldName()) . __(' from original ') . $history->oldValue() . __(' updated to ') . $history->newValue() . PHP_EOL;
        }
    }
}
