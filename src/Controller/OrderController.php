<?php

namespace App\Controller;

use App\Traits\ApiResponse;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class OrderController extends BaseController
{
    use ApiResponse;

    private $active = [
        [
            'order_id' => 123,
            'order_status' => "active",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 1233,
            'order_status' => "active",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 987,
            'order_status' => "active",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 765,
            'order_status' => "active",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ]
    ];
    private $late = [
        [
            'order_id' => 123,
            'order_status' => "late",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 1233,
            'order_status' => "late",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 987,
            'order_status' => "late",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 765,
            'order_status' => "late",
            'order_date' => "2022/05/23",
            'completion_date' => null,
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ]
    ];
    private $completed = [
        [
            'order_id' => 123,
            'order_status' => "completed",
            'order_date' => "2022/05/23",
            'completion_date' => "2022/05/23",
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 1233,
            'order_status' => "completed",
            'order_date' => "2022/05/23",
            'completion_date' => "2022/05/23",
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 987,
            'order_status' => "completed",
            'order_date' => "2022/05/23",
            'completion_date' => "2022/05/23",
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ],
        [
            'order_id' => 765,
            'order_status' => "completed",
            'order_date' => "2022/05/23",
            'completion_date' => "2022/05/23",
            'order_price' => 500,
            'order_title' => "Full Setup of 1 Google Text Search Ads Campaign #330",
            'order_thumbnail' => "https://demothumbnail.com/26t7bg76g.png",
            'order_detail_url' => "https://example.com/orders/detai/1234",
            'project_name' => "First Project",
            'worker_info' => [
                'worker_name' => "Worker Name",
                'worker_id' => 12323,
                'worker_avatar' => "https://gravatar.com/avatar/b920b022d02c6e8f9dbebd8103fcecd3?s=400&d=robohash&r=x",

            ],
            'chat_id' => 2323,
        ]
    ];

    public function getOrderCounts(Request $request, Response $response): Response
    {
        global $auth_user_id;
        if ($auth_user_id !== 1) {
            return $this->sendResponse([], 'Invalid Auth User.', 401);
        }
        $orderCountsData = [
                'active' => [
                    'total_count' => 78,
                ],
                'late' => [
                    'total_count' => 29,
                ],
                'completed' => [
                    'total_count' => 49,
                ]
        ];
        return $this->sendResponse($orderCountsData);
    }
    public function getOrders(Request $request, Response $response): Response
    {
        global $auth_user_id;
        $params = $request->getQueryParams();
        if (!isset($params['status'])) {
            return $this->sendResponse([], 'Missing parameter \'status\'', 401);
        }

        $ordersData = [
            'orders' => $this->active,
            'status' => $params['status'],
            'pagination' => [
                'total_count' => 49,
                'per_page'=>25,
                'page_count'=>2,
                'page'=>1
            ]
        ];
        return $this->sendResponse($ordersData);
    }
}