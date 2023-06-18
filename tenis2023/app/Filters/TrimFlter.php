<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
/*
class TrimFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null) {
        
        $trimmed_post = [];
        
        foreach($request->getPost() as $var => $val) {
            $trimmed_post[$var] = trim($val); 
        }
        
        $request->setGlobal('post', $trimmed_post);
    }         
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }  
     
}
*/