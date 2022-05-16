<?php

namespace SdgScoped\Jane\OpenApiCommon\Generator\Client;

use SdgScoped\Http\Discovery\Psr17FactoryDiscovery;
use SdgScoped\PhpParser\Node;
use SdgScoped\PhpParser\Node\Expr;
use SdgScoped\PhpParser\Node\Name;
use SdgScoped\PhpParser\Node\Stmt;
trait ServerPluginGenerator
{
    protected abstract function discoverServer($openApi) : array;
    protected function needsServerPlugins($openApi) : bool
    {
        [$baseUri, $_] = $this->discoverServer($openApi);
        return !(empty($baseUri) || $baseUri === '/');
    }
    protected function getServerPluginsStatements($openApi) : array
    {
        [$baseUri, $plugins] = $this->discoverServer($openApi);
        $stmts = [new Stmt\Expression(new Expr\Assign(new Expr\Variable('uri'), new Expr\MethodCall(new Expr\StaticCall(new Name\FullyQualified(Psr17FactoryDiscovery::class), 'findUrlFactory'), 'createUri', [new Node\Arg(new Node\Scalar\String_($baseUri))])))];
        foreach ($plugins as $pluginClass) {
            $stmts[] = new Stmt\Expression(new Expr\Assign(new Expr\ArrayDimFetch(new Expr\Variable('plugins')), new Expr\New_(new Name\FullyQualified($pluginClass), [new Node\Arg(new Expr\Variable('uri'))])));
        }
        return $stmts;
    }
}
