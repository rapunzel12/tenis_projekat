<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

use App\Filters\UserFilter;
use App\Filters\GuestFilter;
use App\Filters\AdminFilter;
use App\Filters\MemberFilter;
use App\Filters\StudentFilter;
use App\Filters\CoachFilter;


//use App\Filters\AdminFilter;
//use App\Filters\LoginFilter;
class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     */
    public array $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,

        'user'=> UserFilter::class,
        'guest'=> GuestFilter::class,
        'admin'=> AdminFilter::class,
        'student'=> StudentFilter::class,
        'member'=> MemberFilter::class,
        'coach'=> CoachFilter::class,
        
        //'login'=>LoginFilter::class,
        //'register'=>RegisterFilter::class,
        //'admin'=>AdminFilter::class
    ];


    /**
     * List of filter aliases that are always
     * applied before and after every request.
     */
    public array $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['foo', 'bar']
     *
     * If you use this, you should disable auto-routing because auto-routing
     * permits any HTTP method to access a controller. Accessing the controller
     * with a method you don’t expect could bypass the filter.
     */
    public array $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     */
    public array $filters = [
        
        // DA LI MI JE POTREBAN OVAJ USER??????
        'user' => ['before'=> ['User/*', 'User']],
        'admin' => ['before'=> ['Admin/*', 'Admin']], // da li sam navela sve putanje, to me zbunjuje
        'student' => ['before'=> ['Student/*', 'Student']], // da li sam navela sve putanje, to me zbunjuje
        'member' => ['before'=> ['Member/*', 'Member']], // da li sam navela sve putanje, to me zbunjuje
        'coach' => ['before'=> ['Coach/*', 'Coach']], // da li sam navela sve putanje, to me zbunjuje

        // OVO DELIMICNO RADI KADA JE SVE STAVLJENO U USERA. KADA ISPISEM GUEST U URL-U, 
        // VRATI ME NA USER, ALI JE ON PRAZAN. MOZE DA SE DESI I DA ME VRATI NA GUEST LOGIN STRANICU
        // 'user' => ['before'=> ['User/*', 'User', 'Admin/*', 'Admin', 'Coach/*', 'Coach/', 'Member/*', 'Member/', 'Student/*', 'Student/']], // da li sam navela sve putanje, to me zbunjuje
        'guest' => ['before'=> ['Guest/*', 'Guest', '/']], // da li sam navela sve putanje, to me zbunjuje
        
        // ne znam sta mi je zamena za Gost kontorler
        // ne znam da li su ovo dobri filteri???
        
    ];
}
