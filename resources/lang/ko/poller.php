<?php

return [
    'settings' => [
        'settings' => [
            'poller_groups' => [
                'description' => '�Ҵ� �׷�',
                'help' => '�� ���� �� ���� �׷� ��ġ�� ���ؼ��� �۵��˴ϴ�',
            ],
            'poller_enabled' => [
                'description' => '���� Ȱ��ȭ',
                'help' => '�� ��忡�� ���� workers�� Ȱ��ȭ',
            ],
            'poller_workers' => [
                'description' => '���� Workers',
                'help' => '�� ��忡�� ������ ���� workers�� ��'
            ],
            'poller_frequency' => [
                'description' => '���� ���ļ� (���!)',
                'help' => '�� ��忡�� ��ġ�� �����ϴ� ��. ���! rrd ������ �������� �ʰ� ������ ��� �׷����� �����ϴ�. �ڼ��� ������ ������ �����ϼ���.',
            ],
            'poller_down_retry' => [
                'description' => '��ġ �ٿ� ��õ�',
                'help' => '�� ��忡�� ������ �õ��Ҷ� ��ġ�� �ٿ��� �� ���, ��õ��� �ϱ� �� ��� �ð��Դϴ�.',
            ],
            'discovery_enabled' => [
                'description' => '�˻� Ȱ��ȭ',
                'help' => '�� ��忡�� ��Ŀ���� workers�� Ȱ��ȭ',
            ],
            'discovery_workers' => [
                'description' => '��Ŀ���� Workers',
                'help' => '�� ��忡�� ����Ǵ� ��Ŀ���� workers�� ��',
            ],
            'discovery_frequency' => [
                'description' => '��Ŀ���� ��',
                'help' => '�� ��忡�� ��ġ ��Ŀ������ �󸶳� �������� ��. �⺻���� �Ϸ翡 4���Դϴ�.',
            ],
            'services_enabled' => [
                'description' => '���� Ȱ��ȭ',
                'help' => '�� ��忡�� ���� workers Ȱ��ȭ',
            ],
            'services_workers' => [
                'description' => '���� Workers',
                'help' => '�� ��忡���� ���� workers ��',
            ],
            'services_frequency' => [
                'description' => '���� ��',
                'help' => '�� ��忡�� ���񽺸� �󸶳� �������� ��, ���� �󵵿� ��ġ�ؾ� �մϴ�',
            ],
            'billing_enabled' => [
                'description' => 'Billing Ȱ��ȭ',
                'help' => '�� ��忡�� Billing Workers Ȱ��ȭ',
            ],
            'billing_frequency' => [
                'description' => 'Billing ��',
                'help' => '�� ��忡�� Billing ������ ���� ��',
            ],
            'billing_calculate_frequency' => [
                'description' => 'Billing ��� ��',
                'help' => '�� ��忡�� bill ��뷮 ��� ��',
            ],
            'alerting_enabled' => [
                'description' => '�˸� Ȱ��ȭ',
                'help' => '�� ��忡�� �˸� worker Ȱ��ȭ.',
            ],
            'alerting_frequency' => [
                'description' => '�˸� ��',
                'help' => '�� ��忡�� �˸��� Ȯ���ϴ� ��. �����ʹ� ���� �󵵸� �������� ������Ʈ�˴ϴ�.',
            ],
            'ping_enabled' => [
                'description' => '�н�Ʈ �� Ȱ��ȭ',
                'help' => '�н�Ʈ ���� ��ġ�� �۵��� Ȯ���ϱ� ���� ��ġ�� ���մϴ�',
            ],
            'ping_frequency' => [
                'description' => '�� ��',
                'help' => '�� ��忡�� �� Ȯ�� ��. ���! �� �׸��� �����ϴ� ��� �߰������� �����ؾ��մϴ�. �н�Ʈ �� ������ Ȯ���ϼ���. ',
            ],
            'update_enabled' => [
                'description' => '���� ���� ���� Ȱ��ȭ',
                'help' => 'daily.sh ���� ���� ��ũ��Ʈ�� ������ �Ŀ� ����ó ���񽺸� ������ϼ���'
            ],
            'update_frequency' => [
                'description' => '���� ���� ��',
                'help' => '�� ��忡���� ���� ���� ���� ���� ��. �⺻���� 1���Դϴ�. �� �׸��� �������� �ʴ� ���� �����ϴ�.',
            ],
            'loglevel' => [
                'description' => '�α� ����',
                'help' => '����ġ ������ �α� ����',
            ],
            'watchdog_enabled' => [
                'description' => 'Watchdog Ȱ��ȭ',
                'help' => 'Watchdog�� �α� ������ ����͸��ư� ������Ʈ ���� ���� ���񽺸� �ٽ� �����մϴ�.',
            ],
            'watchdog_log' => [
                'description' => '����͸��� �α� ����',
                'help' => '�⺻���� NanumWiFi �α� �����Դϴ�.',
            ],
        ],
        'units' => [
            'seconds' => '��',
            'workers' => 'Workers',
        ],
    ],
];
