<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

class Webhook
{
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->headers as $h) {
            echo $h;
        }

        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('app.deploy_secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

        echo config('app.deploy_secret');
        echo hash_equals($githubHash, $localHash);
//        if (hash_equals($githubHash, $localHash)) {
//            abort(403);
//        }

        return $next($request);
    }
}
