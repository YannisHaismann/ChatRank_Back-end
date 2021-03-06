<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;

class OpenApiFactory implements OpenApiFactoryInterface
{

    public function __construct(private OpenApiFactoryInterface $decorated){

    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['bearerAuth'] = new \ArrayObject([
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT'
        ]);

        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'test@gmail.com',
                ],
                'password' => [
                    'type' => 'string',
                    'example' => 'test1234'
                ]
            ]
        ]);

        $schemas['Token'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'token' => [
                    'type' => 'string',
                    ],
                'refresh_token' => [
                    'type' => 'string',
                    ]
            ]
        ]);

        $schemas['RefreshToken'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'refresh_token' => [
                    'type' => 'string',
                ],
            ]
        ]);

        $schemas['Logout'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'code' => [
                    'type' => 'integer',
                    'example' => 200,
                ],
                'refresh_token' => [
                    'message' => 'string',
                    'example' => 'The supplied refresh_token has been invalidated.',
                ]
            ]
        ]);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApipLogin',
                tags: ['Auth'],
                responses: [
                    '200' => [
                        'description' => 'Token JWT',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token'
                                ]
                            ]
                        ]
                    ]
                ],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials'
                            ]
                        ]
                    ])
                )
            )
        );

        $openApi->getPaths()->addPath('/apip/login', $pathItem);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'refreshToken',
                tags: ['Auth'],
                responses: [
                    '200' => [
                        'description' => 'refresh Token JWT',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Token'
                                ]
                            ]
                        ]
                    ]
                ],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RefreshToken'
                            ]
                        ]
                    ])
                )
            )
        );

        $openApi->getPaths()->addPath('/apip/token/refresh', $pathItem);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApipLogout',
                tags: ['Auth'],
                responses: [
                    '200' => [
                        'description' => 'logout',
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/Logout'
                                ]
                            ]
                        ]
                    ]
                ],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/RefreshToken'
                            ]
                        ]
                    ])
                )
            )
        );
        $openApi->getPaths()->addPath('/apip/logout', $pathItem);

        return $openApi;
    }
}