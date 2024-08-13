<?php

namespace App;

class Consts
{

    const Product_type = [
        '1' => 'Cho thuê',
        '2' => 'Rao bán',
    ];
    const type_price = [
        '1' => 'Ngày',
        '2' => 'Tuần',
        '3' => 'Tháng',
        '4' => 'Năm',
    ];
    const DataBedr = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5+',
    ];
    const DataBathr = [
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5+',
    ];

    // For delete some data
    const STATUS_DELETE = 'delete';

    // Status for users
    const USER_STATUS = [
        'pending' => 'pending',
        'active' => 'active',
        'deactive' => 'deactive',
        'delete' => 'delete'
    ];

    // Status for general
    const STATUS = [
        'active' => 'active',
        'deactive' => 'deactive'
    ];

    // Array taxonomy status
    const TAXONOMY_STATUS = [
        'active' => 'active',
        'deactive' => 'deactive'
    ];
    // Thể loại taxonomy
    const TAXONOMY = [
        'post' => 'post',
        'product' => 'product',
        // 'service' => 'service',
        // 'resource' => 'resource',
    ];
    // Loại bài đăng
    const POST_TYPE = [
        'post' => 'post',
        'product' => 'product',
        // 'service' => 'service',
        // 'resource' => 'resource',
    ];
    // Mảng lưu trạng thái bài viết
    const POST_STATUS = [
        'pending' => 'pending',
        'active' => 'active',
        'deactive' => 'deactive'
    ];
    // Define all route for taxonomy
    const ROUTE_TAXONOMY = [
        'post' => 'frontend.cms.taxonomy',
        'service' => 'frontend.cms.taxonomy',
        'product' => 'frontend.cms.taxonomy',
        'resource' => 'frontend.cms.taxonomy',
    ];
    // Define all route for post
    const ROUTE_POST = [
        'post' => 'frontend.cms.detail',
        'service' => 'frontend.cms.detail',
        'product' => 'frontend.cms.detail',
        'resource' => 'frontend.cms.detail',
    ];
    const ROUTE_CUSTOM_PAGE = 'frontend.page';

    const DEFAULT_PAGINATE_LIMIT = 20;

    const PAGINATE = [
        'post' => 6,
        'service' => 12,
        'product' => 12,
        'resource' => 6,
        'related' => 6,
        'sidebar' => 6,
        'search' => 12,
        'other' => 6,
    ];

    const TITLE_BOOLEAN = [
        '1' => 'true',
        '0' => 'false'
    ];

    const MENU_TYPE = [
        'header' => 'header',
        'footer' => 'footer'
    ];

    const URI_TYPE = [
        'route' => 'Route name',
        'path' => 'Path',
        'url' => 'Url Customize',
    ];

    // Loại liên hệ
    const CONTACT_TYPE = [
        'contact' => 'contact',
        'faq' => 'faq',
        'newsletter' => 'newsletter',
        'advise' => 'advise',
        'call_request' => 'call_request'
    ];
    const CONTACT_STATUS = [
        'new' => 'new',
        'processing' => 'processing',
        'processed' => 'processed',
        'cancel' => 'cancel'
    ];
    // Type for order
    const ORDER_TYPE = [
        'product' => 'product',
        'service' => 'service',
    ];
    const ORDER_STATUS = [
        'new' => 'new',
        'processing' => 'processing',
        'processed' => 'processed',
        'cancel' => 'cancel'
    ];

    // Tạo danh sách chức năng định tuyến để gọi khi tạo trang trong admin -> người dùng có thể tùy chọn
    const ROUTE_NAME = [
        [
            "title" => "Trang chủ",
            "name" => "frontend.home",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "home.primary"
                ]
            ],
            "show_route" => true
        ],
        [
            "title" => "Giới thiệu",
            "name" => "frontend.aboutus",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "aboutus.primary"
                ]
            ],
            "show_route" => true
        ],
        [
            "title" => "Chi tiết",
            "name" => "frontend.cms.detail",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "post.detail"
                ]
            ]
        ],
        [
            "title" => "Danh mục",
            "name" => "frontend.cms.taxonomy",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "post.default"
                ]
            ]
        ],
        [
            "title" => "Liên hệ",
            "name" => "frontend.contact",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "contact.default"
                ]
            ],
            "show_route" => true
        ],
        [
            "title" => "Tìm kiếm",
            "name" => "frontend.search",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "search.default"
                ]
            ],
            "show_route" => true
        ],
        [
            "title" => "Trang tùy chọn",
            "name" => "frontend.page",
            "template" => [
                [
                    "title" => "Mặc định",
                    "name" => "page.default"
                ]
            ],
            "show_route" => true,
            "has_alias" => true
        ],
        [
            "title" => "Giỏ hàng",
            "name" => "frontend.order.cart",
            "template" => [
                [
                    "title" => "Default",
                    "name" => "cart.default"
                ]
            ],
            "show_route" => true,
            "has_alias" => true
        ]
    ];
}
