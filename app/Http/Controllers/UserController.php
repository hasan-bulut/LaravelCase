<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use PhpParser\Node\NullableType;

class UserController extends Controller
{
    public function insert(Request $req)
    {
        if ($req->has('username') && $req->query('username') != "") {
            if (UserModel::where("username", $req->query('username'))->get()->first() == null) {
                UserModel::create(["username" => $req->query('username')]);
                echo "Başarıyla kullanıcı eklendi.";
            } else {
                echo "Bu kullanıcı adı zaten kayıtlı!";
            }
        } else {
            echo "Sorgu parametresini doldurunuz!";
        }
    }

    public function list()
    {
        foreach (UserModel::all() as $user) {
            echo "id: {$user->id} --> username: {$user->username}\n";
        }
    }

    public function update(Request $req, $username = null)
    {
        if ($username != null) {
            if ($req->has('username')) {
                if (UserModel::where("username", $username)->get()->first() != null) {
                    if (UserModel::where("username", $req->query('username'))->get()->first() == null) {
                        UserModel::where("username", $username)->update(["username" => $req->query('username')]);
                        echo "Başarıyla kullanıcı adı güncellendi.";
                    }else{
                        echo "Bu kullanıcı adı zaten kayıtlı!";
                    }
                } else {
                    echo "Böyle bir kullanıcı yok!";
                }
            } else {
                echo "Sorgu parametresini doldurunuz!";
            }
        } else {
            echo "Kullanıcı adı yazınız!";
        }
    }

    public function delete(string $username = null)
    {
        if ($username != null) {
            if (UserModel::where("username", $username)->get()->first() != null) {
                UserModel::where("username", $username)->delete();
                echo "Başarıyla silindi.";
            } else {
                echo "Böyle bir kullanıcı yok!";
            }
        } else {
            echo "Kullanıcı adı yazınız!";
        }
    }

    public function destroy($username = null)
    {
        if ($username != null) {
            if (UserModel::where("username", $username)->withTrashed()->get()->first() != null) {
                UserModel::where("username", $username)->forceDelete();
                echo "Başarıyla tamamen silindi.";
            } else {
                echo "Böyle bir kullanıcı yok!";
            }
        } else {
            echo "Kullanıcı adı yazınız!";
        }
    }
}
