<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the role middleware from Spatie Permission package
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle all HTTP exceptions
        $exceptions->render(function (\Throwable $e, $request) {
            // Check if it's an HTTP exception
            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                $statusCode = $e->getStatusCode();
                
                // Handle 404 and 403 errors
                if ($statusCode === 404 || $statusCode === 403) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'error' => $statusCode === 404 ? 'Page not found' : 'Access denied'
                        ], $statusCode);
                    }
                    
                    $message = $statusCode === 404 ? 
                        'Halaman yang Anda cari tidak ditemukan.' : 
                        'Anda tidak memiliki akses untuk halaman tersebut.';
                    
                    return redirect()->route('home')->with('error', $message);
                }
            }
            
            // Check specifically for Spatie Permission exception
            if ($e instanceof \Spatie\Permission\Exceptions\UnauthorizedException) {
                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Unauthorized'], 403);
                }
                
                return redirect()->route('home')->with('error', 'Anda tidak memiliki akses untuk halaman tersebut.');
            }
            
            // Return null to let Laravel handle other exceptions normally
            return null;
        });
    })->create();
