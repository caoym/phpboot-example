<?php
namespace App\Hooks;

use PhpBoot\Controller\HookInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * 简单登录校验
 *
 * 实现了 Basic Authorization
 * @package App\Hooks
 */
class BasicAuth implements HookInterface
{
    /**
     * @param Request $request
     * @param callable $next
     * @return Response
     */
    public function handle(Request $request, callable $next)
    {
        $auth = $request->headers->get('Authorization');
        $auth or fail(new UnauthorizedHttpException('Basic realm="PhpBoot Example"', 'Please login...'));
        $auth = explode(' ', $auth);
        $auth[1] == md5("{$this->username}:{$this->password}") or fail(new UnauthorizedHttpException('Basic realm="PhpBoot Example", "Invalid username or password!"'));
        return $next($request);
    }

    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;
}