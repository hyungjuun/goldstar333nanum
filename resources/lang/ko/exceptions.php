<?php

return [
    'database_connect' => [
        'title' => '데이터베이스 연결에 실패했습니다',
    ],
    'dusk_unsafe' => [
        'title' => '프로덕션 환경에서 Dusk를 실행하는 것은 안전하지 않습니다',
        'message' => '":command"를 실행시켜 Dusk를 제거하거나 개발자라면 적절한 APP_ENV를 설정하세요',
    ],
    'file_write_failed' => [
        'title' => '파일을 수정할 수 없습니다',
        'message' => '파일을 (:file) 수정하는데 실패했습니다. 권한과 SELinux/AppArmor을 확인해주세요',
    ],
    'ldap_missing' => [
        'title' => 'PHP LDAP support missing',
        'message' => 'PHP가 LDAP를 지원하지 않습니다, PHP LDAP extension을 설치하거나 활성하세요',
    ],
    'maximum_execution_time_exceeded' => [
        'title' => '최대 실행시간 :seconds 를 초과했습니다|최대 실행시간 :seconds 를 초과했습니다',
        'message' => '페이지로드가 PHP 구성 실행시간을 초과했습니다. php.ini의 최대실행시간을 늘리거나 서버 하드웨어를 향상하세요',
    ],
    'unserializable_route_cache' => [
        'title' => 'PHP 버전이 맞지 않습니다',
        'message' => '웹서버 (:web_version)의 PHP 버전이 CLI 버전 (:cli_version)과 맞지 않습니다',
    ],
];
