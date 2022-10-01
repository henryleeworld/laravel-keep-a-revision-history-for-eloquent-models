<?php

namespace App\Http\Controllers;

use App\Models\User;

class UsersController extends Controller
{
    public function track() 
    {
        $user = User::find(1);
        echo '使用者編號：' . $user->id . '，原本姓名為：' . $user->name . '，原本電子郵件為：' . $user->email . PHP_EOL;
        $user->name  = '克拉克·肯特';
        $user->email = 'superman@justice-league.com';
        $user->save();
        $user = User::find(1);
        echo '使用者編號：' . $user->id . '，變更姓名為：' . $user->name . '，變更電子郵件為：' . $user->email . PHP_EOL;
        $userRevisionHistory = $user->revisionHistory;
        foreach ($userRevisionHistory as $history) {
            echo ($history->key == 'created_at' && !$history->old_value) ? NULL : $history->fieldName() . ' 從原本 ' . $history->oldValue() . ' 改為 ' . $history->newValue() . PHP_EOL;
        }
    }
}
