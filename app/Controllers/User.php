<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    // serve as both landing page and login page
    public function index()
    {
        $data = [
            'loginmessage' => 'enter password'
        ];

        return view('login', $data);
    }

    public function postLogin()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'password' => 'required'
        ]))
        {
            $userModel = new UserModel();

            $password = $this->request->getPost('password');

            $result = $userModel->where('id', 1)->first();

            $password_hash = $result['password_hash'];

            if (!password_verify($password, $password_hash)) {
                echo view('login', ['loginmessage' => 'wrong password']);
            } else {
                // initialiaze a session
                $session = \Config\Services::session();
                $session->set(['display_name'=>$result['display_name']]);

                return redirect()->to('/home');
            }
        } else {
            echo view('login', ['loginmessage' => 'password is required']);
        }
    }

    public function pageHome()
    {
        return view('header')
            .view('home')
            .view('components/footer');
    }

    public function getLogout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function pageMyAccount()
    {
        $userModel = new UserModel();
        $userData = $userModel->where('id', 1)->first();

        $data = [
            'display_name' => $userData['display_name'],
            'created_at' => $userData['created_at'],
            'updated_at' => $userData['updated_at'],
        ];

        return view('my-account/header')
            .view('my-account/index', $data)
            .view('my-account/footer');
    }

    // page for changing password
    public function pageChangePassword()
    {
        return view('my-account/header')
            .view('my-account/change-password')
            .view('my-account/footer');
    }

    public function postPasswordUpdate()
    {
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required',
        ]))
        {

            $old_password = $this->request->getPost('old_password');
            $new_password = $this->request->getPost('new_password');
            $confirm_password = $this->request->getPost('confirm_password');

            // password confirmation logic
            $userModel = new UserModel();
            $userData = $userModel->where('id', 1)->first();
            $password = $userData['password_hash'];
            if (!password_verify($old_password, $password)) {
                echo view('my-account/header')
                    .view('my-account/message',
                        [
                            'type' => "warning",
                            'message' => "Incorrect old password",
                            'returnlink' => "/my-account/change-password",
                        ]
                    )
                    .view('my-account/footer');
            } else {
                if ($new_password!==$confirm_password) {
                    echo view('my-account/header')
                        .view('my-account/message',
                            [
                                'type' => "warning",
                                'message' => "New password confirmation failed",
                                'returnlink' => "/my-account/change-password",
                            ]
                        )
                        .view('my-account/footer');
                } else {
                    // update the password
                    $userModel->update(1, ['password_hash' => password_hash($confirm_password, PASSWORD_DEFAULT)]);

                    echo view('my-account/header')
                        .view('my-account/message',
                            [
                                'type' => "info",
                                'message' => "Password updated successfully",
                                'returnlink' => "/my-account/change-password",
                            ]
                        )
                        .view('my-account/footer');
                }
            }
        } else {
            echo view('my-account/header')
                .view('my-account/message',
                    [
                        'type' => "warning",
                        'message' => "Password cannot be empty",
                        'returnlink' => "/my-account/change-password",
                    ]
                )
                .view('my-account/footer');
        }
    }

    public function pageUpdateAccount()
    {
        return view('my-account/header')
            .view('my-account/update-account')
            .view('my-account/footer');
    }

    public function postAccountUpdate()
    {
        if ($this->request->getMethod() === 'POST')
        {
            $userModel = new UserModel();

            if (isset($_POST['display_name'])) {
                $display_name = $this->request->getPost('display_name');
                if ($display_name!='') {
                    $userModel->update(1, ['display_name' => $display_name]);
                }
            }

            return redirect()->to('/my-account');
        } else {
            return redirect()->to('/my-account/update-account');
        }
    }
}
