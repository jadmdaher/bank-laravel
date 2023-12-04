<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Account;
use App\Models\Bank;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public $bank;

    public function createAccount(Request $request)
    {
        $account = new Account();
        $account->fill($request->all());
        $this->bank->addAccount($account);
        return redirect('/');
    }

    public function addCredit(Request $request)
    {
        $account = new Account();
        $account->fill($request->all());
        $index = $this->bank->searchAccount($account->accountNum);
        if ($index >= 0) {
            $this->bank->addCredit($index, $account->ammount);
            return view('main_menu', ['total' => $this->bank->accountsCount()]);
        } else
            return view('form_add_credit');
    }

    public function showAccountsList()
    {
        $accounts = $this->bank->getAllAccounts();
        return view('accounts_list', ['accounts' => $accounts]);
    }

    public function initSession()
    {
        session_start();
        $sessionName = "bank";

        if (!isset($_SESSION[$sessionName])) {
            $_SESSION[$sessionName] = new Bank();
        }

        $bank = &$_SESSION[$sessionName];
    }
}
