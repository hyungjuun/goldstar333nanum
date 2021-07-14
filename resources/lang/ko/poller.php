<?php

return [
    'settings' => [
        'settings' => [
            'poller_groups' => [
                'description' => '할당 그룹',
                'help' => '이 노드는 이 폴러 그룹 장치에 대해서만 작동됩니다',
            ],
            'poller_enabled' => [
                'description' => '폴러 활성화',
                'help' => '이 노드에서 폴러 workers를 활성화',
            ],
            'poller_workers' => [
                'description' => '폴러 Workers',
                'help' => '이 노드에서 생성할 폴러 workers의 양'
            ],
            'poller_frequency' => [
                'description' => '폴러 주파수 (경고!)',
                'help' => '이 노드에서 장치를 폴링하는 빈도. 경고! rrd 파일을 수정하지 않고 변경할 경우 그래프가 깨집니다. 자세한 내용은 문서를 참조하세요.',
            ],
            'poller_down_retry' => [
                'description' => '장치 다운 재시도',
                'help' => '이 노드에서 폴링을 시도할때 장치가 다운이 된 경우, 재시도를 하기 전 대기 시간입니다.',
            ],
            'discovery_enabled' => [
                'description' => '검색 활성화',
                'help' => '이 노드에서 디스커버리 workers를 활성화',
            ],
            'discovery_workers' => [
                'description' => '디스커버리 Workers',
                'help' => '이 노드에서 실행되는 디스커버리 workers의 양',
            ],
            'discovery_frequency' => [
                'description' => '디스커버리 빈도',
                'help' => '이 노드에서 장치 디스커버리를 얼마나 돌릴지의 빈도. 기본값은 하루에 4번입니다.',
            ],
            'services_enabled' => [
                'description' => '서비스 활성화',
                'help' => '이 노드에서 서비스 workers 활성화',
            ],
            'services_workers' => [
                'description' => '서비스 Workers',
                'help' => '이 노드에서의 서비스 workers 양',
            ],
            'services_frequency' => [
                'description' => '서비스 빈도',
                'help' => '이 노드에서 서비스를 얼마나 돌릴지의 빈도, 폴러 빈도와 일치해야 합니다',
            ],
            'billing_enabled' => [
                'description' => 'Billing 활성화',
                'help' => '이 노드에서 Billing Workers 활성화',
            ],
            'billing_frequency' => [
                'description' => 'Billing 빈도',
                'help' => '이 노드에서 Billing 데이터 수집 빈도',
            ],
            'billing_calculate_frequency' => [
                'description' => 'Billing 계산 빈도',
                'help' => '이 노드에서 bill 사용량 계산 빈도',
            ],
            'alerting_enabled' => [
                'description' => '알림 활성화',
                'help' => '이 노드에서 알림 worker 활성화.',
            ],
            'alerting_frequency' => [
                'description' => '알림 빈도',
                'help' => '이 노드에서 알림을 확인하는 빈도. 데이터는 폴러 빈도를 기준으로 업데이트됩니다.',
            ],
            'ping_enabled' => [
                'description' => '패스트 핑 활성화',
                'help' => '패스트 핑은 장치의 작동을 확인하기 위해 장치를 핑합니다',
            ],
            'ping_frequency' => [
                'description' => '핑 빈도',
                'help' => '이 노드에서 핑 확인 빈도. 경고! 이 항목을 변경하는 경우 추가적으로 변경해야합니다. 패스트 핑 문서를 확인하세요. ',
            ],
            'update_enabled' => [
                'description' => '일일 유지 보수 활성화',
                'help' => 'daily.sh 유지 보수 스크립트를 실행한 후에 디스패처 서비스를 재시작하세요'
            ],
            'update_frequency' => [
                'description' => '유지 보수 빈도',
                'help' => '이 노드에서의 일일 유지 보수 실행 빈도. 기본값은 1일입니다. 이 항목은 변경하지 않는 것이 좋습니다.',
            ],
            'loglevel' => [
                'description' => '로그 레벨',
                'help' => '디스패치 서비스의 로그 레벨',
            ],
            'watchdog_enabled' => [
                'description' => 'Watchdog 활성화',
                'help' => 'Watchdog은 로그 파일을 모니터리아고 업데이트 되지 않은 서비스를 다시 시작합니다.',
            ],
            'watchdog_log' => [
                'description' => '모니터링할 로그 파일',
                'help' => '기본값은 NanumWiFi 로그 파일입니다.',
            ],
        ],
        'units' => [
            'seconds' => '초',
            'workers' => 'Workers',
        ],
    ],
];
