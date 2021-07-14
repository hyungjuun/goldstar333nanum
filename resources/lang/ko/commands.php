<?php

return [
    'config:get' => [
        'description' => '구성 값 조회',
        'arguments' => [
            'setting' => '점 표기법으로 조회 (예: snmp.community.0)',
        ],
        'options' => [
            'json' => 'json으로 조회',
        ],
    ],
    'config:set' => [
        'description' => '구성 값 설정',
        'arguments' => [
            'setting' => '점 표기법으로 설정 (예: snmp.community.0)',
            'value' => '설정 값, 생략시 설정 해제',
        ],
        'options' => [
            'ignore-checks' => '경고 무시',
        ],
        'confirm' => ':setting 을 기본 설정값으로 리셋하겠습니까?',
        'errors' => [
            'failed' => ':setting 설정에 실패했습니다',
            'invalid' => '유효한 설정이 아닙니다. 철자를 확인해주세요',
            'nodb' => 'DB가 연결되지 않았습니다',
            'no-validation' => ':setting 설정을 할 수 없습니다,  확인이 되지 않았습니다.',
        ],
    ],
    'dev:check' => [
        'description' => 'NanumWiFi 코드 체크. 옵션없이 체크 실행',
        'arguments' => [
            'check' => '특정 체크 :checks 실행',
        ],
        'options' => [
            'commands' => '체크 없이 실행 가능한 명령어 출력',
            'db' => 'DB 연결이 필요한 유닛 테스트 실행',
            'fail-fast' => '실패시 체크 중지',
            'full' => '파일 필터링 변경을 무시하고 모든 체크 실행',
            'module' => '실행 테스트를 할 특정 모듈. 유닛, --db, --snmpsim',
            'os' => '실행 테스트를 할 특정 OS. 유닛, --db, --snmpsim',
            'quiet' => '에러가 있지 않을 시 결과창 숨기기',
            'snmpsim' => '유닛 테스트에 snmpsim 사용',
        ],
    ],
    'smokeping:generate' => [
        'args-nonsense' => '--probes와 --targets 중 하나 사용',
        'config-insufficient' => 'smokeping 구성을 생성하려면 구성에서"smokeping.probes", "fping", "fping6"을 설정하세요',
        'dns-fail' => '해결을 할 수 없었고 할 구성에서 생략되었습니다',
        'description' => 'smokeping을 사용 가능한 구성 생성',
        'header-first' => '이 파일은 lnms smokeping:generate에 의해 자동으로 생성되었습니다',
        'header-second' => '변경 내역은 알림이나 실행중인 백업에 의해 덮어쓰여질 수 있습니다',
        'header-third' => '자세한 내용을 확인하려면 https://docs.librenms.org/Extensions/Smokeping/을 참고하세요',
        'no-devices' => '읽을 수 있는 장치가 없습니다 - 장치가 사용 가능해야 합니다',
        'no-probes' => '하나 이상의 프로브가 필요합니다.',
        'options' => [
            'probes' => '프로브 리스트 생성 - 여러 파일로 smokeping 구성을 스플릿하는데 사용, "--targets"와 충돌',
            'targets' => '타겟 리스트 생성 - 여러 파일로 smokeping 구성을 스플릿하는데 사용, "--probes"와 충돌',
            'no-header' => '생성된 파일 시작에 보일러플레이트 코멘트 추가하지 않기',
            'no-dns' => 'DNS lookup 건너뛰기',
            'single-process' => 'smokeping 단일 프로세스만 사용',
            'compat' => '[deprecated] gen_smokeping.php 복사',
        ],
    ],
    'translation:generate' => [
        'description' => '웹 프로트엔드용 업데이트된 json 언어 파일 생성',
    ],
    'user:add' => [
        'description' => '로컬 사용자 생성, 이 사용자가 mysql로 인증 설정되어있으면 이 사용자로만 로그인이 가능합니다',
        'arguments' => [
            'username' => '로그인할 사용자의 사용자이름',
        ],
        'options' => [
            'descr' => '사용자 설명',
            'email' => '사용자 이메일',
            'password' => '사용자 비밀번호, 입력되지 않으면 메시지가 표시됩니다',
            'full-name' => '사용자 이름',
            'role' => '사용자 롤 :roles 설정',
        ],
        'password-request' => '사용자 비밀번호를 입력해주세요',
        'success' => '사용자 :username 추가에 성공했습니다',
        'wrong-auth' => '주의! MySQL 인증을 사용하지 않아 이 사용자로 로그인 할 수 없습니다.',
    ],
];
