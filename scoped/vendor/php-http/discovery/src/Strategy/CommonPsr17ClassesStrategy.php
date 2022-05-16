<?php

namespace SdgScoped\Http\Discovery\Strategy;

use SdgScoped\Psr\Http\Message\RequestFactoryInterface;
use SdgScoped\Psr\Http\Message\ResponseFactoryInterface;
use SdgScoped\Psr\Http\Message\ServerRequestFactoryInterface;
use SdgScoped\Psr\Http\Message\StreamFactoryInterface;
use SdgScoped\Psr\Http\Message\UploadedFileFactoryInterface;
use SdgScoped\Psr\Http\Message\UriFactoryInterface;
/**
 * @internal
 *
 * @author Tobias Nyholm <tobias.nyholm@gmail.com>
 */
final class CommonPsr17ClassesStrategy implements DiscoveryStrategy
{
    /**
     * @var array
     */
    private static $classes = [RequestFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\RequestFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\RequestFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\RequestFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\RequestFactory', 'SdgScoped\\Http\\Factory\\Slim\\RequestFactory', 'SdgScoped\\Laminas\\Diactoros\\RequestFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\RequestFactory'], ResponseFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\ResponseFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\ResponseFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\ResponseFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\ResponseFactory', 'SdgScoped\\Http\\Factory\\Slim\\ResponseFactory', 'SdgScoped\\Laminas\\Diactoros\\ResponseFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\ResponseFactory'], ServerRequestFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\ServerRequestFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\ServerRequestFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\ServerRequestFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\ServerRequestFactory', 'SdgScoped\\Http\\Factory\\Slim\\ServerRequestFactory', 'SdgScoped\\Laminas\\Diactoros\\ServerRequestFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\ServerRequestFactory'], StreamFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\StreamFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\StreamFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\StreamFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\StreamFactory', 'SdgScoped\\Http\\Factory\\Slim\\StreamFactory', 'SdgScoped\\Laminas\\Diactoros\\StreamFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\StreamFactory'], UploadedFileFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\UploadedFileFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\UploadedFileFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\UploadedFileFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\UploadedFileFactory', 'SdgScoped\\Http\\Factory\\Slim\\UploadedFileFactory', 'SdgScoped\\Laminas\\Diactoros\\UploadedFileFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\UploadedFileFactory'], UriFactoryInterface::class => ['SdgScoped\\Phalcon\\Http\\Message\\UriFactory', 'SdgScoped\\Nyholm\\Psr7\\Factory\\Psr17Factory', 'SdgScoped\\Zend\\Diactoros\\UriFactory', 'SdgScoped\\GuzzleHttp\\Psr7\\HttpFactory', 'SdgScoped\\Http\\Factory\\Diactoros\\UriFactory', 'SdgScoped\\Http\\Factory\\Guzzle\\UriFactory', 'SdgScoped\\Http\\Factory\\Slim\\UriFactory', 'SdgScoped\\Laminas\\Diactoros\\UriFactory', 'SdgScoped\\Slim\\Psr7\\Factory\\UriFactory']];
    /**
     * {@inheritdoc}
     */
    public static function getCandidates($type)
    {
        $candidates = [];
        if (isset(self::$classes[$type])) {
            foreach (self::$classes[$type] as $class) {
                $candidates[] = ['class' => $class, 'condition' => [$class]];
            }
        }
        return $candidates;
    }
}
