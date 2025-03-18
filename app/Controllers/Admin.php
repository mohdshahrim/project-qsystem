<?php

namespace App\Controllers;
use App\Models\UserModel;

class Admin extends BaseController
{
    /*
        if (session('role')!="admin")
        {
            return redirect()->to('/user/home');
        }
        else
        {
            
        }
    */

    public function index()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                echo view('admin/header');
                echo view('admin/index');
                echo view('admin/footer');
            }
        }
    }

    public function pageUserAccounts()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                $userModel = new UserModel();
                $result = $userModel->findAll();
                $data = ['accounts'=>$result];

                echo view('admin/header');
                echo view('admin/user-accounts', $data);
                echo view('admin/footer');
            }
        }
    }

    public function pageUserAccountsCreate()
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                echo view('admin/header');
                echo view('admin/user-accounts-create');
                echo view('admin/footer');
            }
        }
    }

    public function pageUserAccountsEdit($userid)
    {
        if (!session('username'))
        {
            session()->destroy();
            return redirect()->to('/');
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                $userModel = new UserModel();
                $user = $userModel->find($userid);
                $data = ['user'=>$user];

                echo view('admin/header');
                echo view('admin/user-accounts-edit', $data);
                echo view('admin/footer');
            }
        }
    }

    public function postUserAccountsUpdate()
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            if (session('role')!="admin")
            {
                return redirect()->to('/user/home');
            }
            else
            {
                if ($this->request->getMethod() === 'POST' && $this->validate([
                    'returnlink' => 'required',
                    'id' => 'required',
                    'designation' => 'required',
                ]))
                {
                    $returnlink = $this->request->getPost('returnlink');

                    $id = $this->request->getPost('id');
                    $designation = $this->request->getPost('designation');

                    $userModel = new UserModel();
                    $data = [
                        'designation' => $designation,
                    ];
                    
                    if ($userModel->update($id, $data))
                    {
                        // update success
                        log_message('error', $returnlink);
                        $successPage = [
                            'message' => "update success!",
                            'returnlink' => $returnlink,
                        ];

                        //return redirect()->to($returnlink);
                        echo view('admin/header');
                        echo view('admin/user-accounts-success', $successPage);
                        echo view('admin/footer');

                    }

                }
                else
                {
                    // POST failed
                    return redirect()->to($returnlink);

                }
            }
        }
    }

    // clear all session
    public function postClearAllSession()
    {
        if (!session('username'))
        {
            session()->destroy();
        }
        else
        {
            helper('filesystem');
            $path = "../writable/session/";
            $del_dir = TRUE;
            $htdocs = TRUE;
            if (delete_files($path, $del_dir, $htdocs))
            {
                log_message('debug', 'delete_files() success');
                $data['type'] = 'success';
            }
            else
            {
                log_message('debug', 'delete_files() failed');
                $data['type'] = 'error';
            }
        }
    }
}