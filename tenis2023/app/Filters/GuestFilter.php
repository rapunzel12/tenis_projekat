<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if($session->has("user")) {
            $user=$session->get('user');
            if($user->tip == 0) {
        
                return redirect()->to('Member'); 
            }
            if($user->tip == 1) {
            
                return redirect()->to('Student');
            }
    
            if($user->tip == 2) {
            
                return redirect()->to('Coach'); 
            }
            if($user->tip == 3) {
            
                return redirect()->to('Admin');
            }
        }
        // ako unutar sesije imam korisnika kojeg sam zapamtila, onda treba da predjem na User-a
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}