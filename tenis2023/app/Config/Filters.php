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
        
        'user' => ['before'=> ['User/*', 'User']],
        'admin' => ['before'=> ['Admin/*', 'Admin']], 
        'student' => ['before'=> ['Student/*', 'Student']], // mozda ce se i ovde dodati neke nove putanje u smislu filtera
        'member' => ['before'=> ['Member/*', 'Member']], 
        'coach' => ['before'=> ['Coach/*', 'Coach']], // ovde ce se dodati neke nove putanje
        'guest' => ['before'=> ['Guest/*', 'Guest', '/']], 
        
    ];
}
