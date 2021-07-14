<?php

return [
    'config:get' => [
        'description' => '���� �� ��ȸ',
        'arguments' => [
            'setting' => '�� ǥ������� ��ȸ (��: snmp.community.0)',
        ],
        'options' => [
            'json' => 'json���� ��ȸ',
        ],
    ],
    'config:set' => [
        'description' => '���� �� ����',
        'arguments' => [
            'setting' => '�� ǥ������� ���� (��: snmp.community.0)',
            'value' => '���� ��, ������ ���� ����',
        ],
        'options' => [
            'ignore-checks' => '��� ����',
        ],
        'confirm' => ':setting �� �⺻ ���������� �����ϰڽ��ϱ�?',
        'errors' => [
            'failed' => ':setting ������ �����߽��ϴ�',
            'invalid' => '��ȿ�� ������ �ƴմϴ�. ö�ڸ� Ȯ�����ּ���',
            'nodb' => 'DB�� ������� �ʾҽ��ϴ�',
            'no-validation' => ':setting ������ �� �� �����ϴ�,  Ȯ���� ���� �ʾҽ��ϴ�.',
        ],
    ],
    'dev:check' => [
        'description' => 'NanumWiFi �ڵ� üũ. �ɼǾ��� üũ ����',
        'arguments' => [
            'check' => 'Ư�� üũ :checks ����',
        ],
        'options' => [
            'commands' => 'üũ ���� ���� ������ ��ɾ� ���',
            'db' => 'DB ������ �ʿ��� ���� �׽�Ʈ ����',
            'fail-fast' => '���н� üũ ����',
            'full' => '���� ���͸� ������ �����ϰ� ��� üũ ����',
            'module' => '���� �׽�Ʈ�� �� Ư�� ���. ����, --db, --snmpsim',
            'os' => '���� �׽�Ʈ�� �� Ư�� OS. ����, --db, --snmpsim',
            'quiet' => '������ ���� ���� �� ���â �����',
            'snmpsim' => '���� �׽�Ʈ�� snmpsim ���',
        ],
    ],
    'smokeping:generate' => [
        'args-nonsense' => '--probes�� --targets �� �ϳ� ���',
        'config-insufficient' => 'smokeping ������ �����Ϸ��� ��������"smokeping.probes", "fping", "fping6"�� �����ϼ���',
        'dns-fail' => '�ذ��� �� �� ������ �� �������� �����Ǿ����ϴ�',
        'description' => 'smokeping�� ��� ������ ���� ����',
        'header-first' => '�� ������ lnms smokeping:generate�� ���� �ڵ����� �����Ǿ����ϴ�',
        'header-second' => '���� ������ �˸��̳� �������� ����� ���� ������� �� �ֽ��ϴ�',
        'header-third' => '�ڼ��� ������ Ȯ���Ϸ��� https://docs.librenms.org/Extensions/Smokeping/�� �����ϼ���',
        'no-devices' => '���� �� �ִ� ��ġ�� �����ϴ� - ��ġ�� ��� �����ؾ� �մϴ�',
        'no-probes' => '�ϳ� �̻��� ���κ갡 �ʿ��մϴ�.',
        'options' => [
            'probes' => '���κ� ����Ʈ ���� - ���� ���Ϸ� smokeping ������ ���ø��ϴµ� ���, "--targets"�� �浹',
            'targets' => 'Ÿ�� ����Ʈ ���� - ���� ���Ϸ� smokeping ������ ���ø��ϴµ� ���, "--probes"�� �浹',
            'no-header' => '������ ���� ���ۿ� ���Ϸ��÷���Ʈ �ڸ�Ʈ �߰����� �ʱ�',
            'no-dns' => 'DNS lookup �ǳʶٱ�',
            'single-process' => 'smokeping ���� ���μ����� ���',
            'compat' => '[deprecated] gen_smokeping.php ����',
        ],
    ],
    'translation:generate' => [
        'description' => '�� ����Ʈ����� ������Ʈ�� json ��� ���� ����',
    ],
    'user:add' => [
        'description' => '���� ����� ����, �� ����ڰ� mysql�� ���� �����Ǿ������� �� ����ڷθ� �α����� �����մϴ�',
        'arguments' => [
            'username' => '�α����� ������� ������̸�',
        ],
        'options' => [
            'descr' => '����� ����',
            'email' => '����� �̸���',
            'password' => '����� ��й�ȣ, �Էµ��� ������ �޽����� ǥ�õ˴ϴ�',
            'full-name' => '����� �̸�',
            'role' => '����� �� :roles ����',
        ],
        'password-request' => '����� ��й�ȣ�� �Է����ּ���',
        'success' => '����� :username �߰��� �����߽��ϴ�',
        'wrong-auth' => '����! MySQL ������ ������� �ʾ� �� ����ڷ� �α��� �� �� �����ϴ�.',
    ],
];
