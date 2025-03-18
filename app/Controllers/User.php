<?php

namespace App\Controllers;
use App\Models\UserModel;

define('QSYSTEM_VERSION_NO', '0.1');
define('QSYSTEM_VERSION_DATE', '01/02/2025');

class User extends BaseController
{
    // NOTE: FUNCTION NAMING
    // For consistency, always begin the function name with either
    // "post" or "page" to differentiate between whether the function involves
    // with POST process or just displaying PAGE
    //
    // For other purpose, always begin the function name with verb


    public function postLogin()
    {
        $userModel = new UserModel();
        // Prior to v4.5.0, by default, the method was returned as a lowercase string (i.e., 'get', 'post', etc). But it was a bug.
        if ($this->request->getMethod() === 'POST' && $this->validate([
            'username' => 'required',
            'password' => 'required'
        ]))
        {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // verify the existence of the username
            $result = $userModel->where('username', $username)->first();
            if ($result)
            {
                // verify the password match
                $user_password = $result['password_hash'];
                if (password_verify($password,$user_password))
                {
                    // initialiaze a session
                    $session = \Config\Services::session();
                    $role = $result['role'];
                    $session->set(['username'=>$username, 'role'=>$role]);

                    return redirect()->to('/user/home');
                }
                else
                {
                    echo view('home/login', ['loginmessage' => 'Password is invalid']);
                }
            }
            else
            {
                echo view('home/login', ['loginmessage' => 'Username is invalid']);
            }
        }
        else
        {
            echo view('home/login', ['loginmessage' => 'Input is required']);
        }
    }

    public function postLogout()
    {
        // THOUGHTS: logically, just delete the session files
        // and redirect. BUt will it disturb other people session too?
        session()->destroy();
        return redirect()->to('/');
    }

    public function pageHome()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            echo view('user/header');
            echo view('user/index');
            echo view('user/footer');
        }
    }

    // specific page to view and modify user account details
    public function pageUserAccount()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            $userModel = new UserModel();
            $data = $userModel->where('username', session('username'))->first();

            echo view('user/header');
            echo view('user/account', $data);
            echo view('user/footer');
        }
    }

    // user password update operation
    public function postPasswordUpdate()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            $session = \Config\Services::session();

            if ($this->request->getMethod() === 'POST' && $this->validate([
                'oldpassword' => 'required',
                'newpassword' => 'required',
                'confirmpassword' => 'required',
            ]))
            {
                $userModel = new UserModel();
                $username = session('username');
                
                // NOTE: don't forget rowid - always use select('rowid, *)
                // NOTE: perhaps rowid is not that important, we can skip
                $result = $userModel->select('rowid, *')->where('username', $username)->first();

                // verify old password
                $oldpassword = $this->request->getPost('oldpassword');
                if (password_verify($oldpassword, $result['password_hash']))
                {
                    $newpassword = $this->request->getPost('newpassword');
                    $confirmpassword = $this->request->getPost('confirmpassword');
                    // verify newpassword and confirmpassword
                    if ($newpassword==$confirmpassword)
                    {
                        // verification OK, update the password
                        $data = [
                            'password_hash' => password_hash($confirmpassword, PASSWORD_DEFAULT),
                        ];
                        
                        if ($userModel->update($result['id'], $data))
                        {
                            // password update successfully
                            $session->setFlashdata('password_message', 'password updated successfully');
                            return redirect()->to('/user/account');
                        }
                        else
                        {
                            // password update failed
                            $session->setFlashdata('password_message', 'password update failed');
                            return redirect()->to('/user/account');
                        }
                    }
                    else
                    {
                        // verification failed
                        $session->setFlashdata('password_message', 'new password not confirmed');
                        return redirect()->to('/user/account');
                    }
                }
                else
                {
                    // old password verification failed
                    $session->setFlashdata('password_message', 'invalid old password');
                    return redirect()->to('/user/account');
                }
            }
            else
            {
                // password update condition is not met
                $session->setFlashdata('password_message', 'password update condition is not met');
                return redirect()->to('/user/account');
            }
        }
    }

}