<?php

return [
    'title' => 'Settings',
    'readonly' => 'config.php에서 설정, 활성화하려면 config.php에서 삭제.',
    'groups' => [
        'alerting' => '알림',
        'api' => 'API',
        'auth' => '인증',
        'authorization' => '권한부여',
        'external' => '외부',
        'global' => '전역',
        'os' => 'OS',
        'discovery' => '디스커버리',
        'graphing' => '그래핑',
        'poller' => '폴러',
        'system' => '시스템',
        'webui' => '웹 UI',
    ],
    'sections' => [
        'alerting' => [
            'general' => '일반 알림 설정',
            'email' => '이메일 옵션',
            'rules' => '알림 규칙 기본 설정',
        ],
        'api' => [
            'cors' => 'CORS',
        ],
        'auth' => [
            'general' => '일반 인증 설정',
            'ad' => '액티브 디렉토리 설정',
            'ldap' => 'LDAP 설정',
        ],
        'authorization' => [
            'device-group' => '장치 그룹 설정',
        ],
        'discovery' => [
            'general' => '일반 디스커버리 설정',
            'route' => '경로 디스커버리 설정',
            'discovery_modules' => '디스커버리 모듈',
            'storage' => '저장공간 모듈',
            'networks' => '네트워크',
        ],
        'external' => [
            'binaries' => '바이너리 경로',
            'location' => '경로 설정',
            'graylog' => 'Graylog 통합',
            'oxidized' => 'Oxidized 통합',
            'peeringdb' => 'PeeringDB 통합',
            'nfsen' => 'NfSen 통합',
            'unix-agent' => 'Unix-Agent Integration',
            'smokeping' => 'Smokeping Integration',
            'snmptrapd' => 'SNMP Traps Integration',
        ],
        'poller' => [
            'availability' => '디바이스 가용성',
            'distributed' => '분산형 폴러',
            'graphite' => 'Datastore: Graphite',
            'influxdb' => 'Datastore: InfluxDB',
            'opentsdb' => 'Datastore: OpenTSDB',
            'ping' => '핑',
            'prometheus' => 'Datastore: Prometheus',
            'rrdtool' => 'Datastore: RRDTool',
            'snmp' => 'SNMP',
            'poller_modules' => '폴러 모듈',
        ],
        'system' => [
            'cleanup' => '클린업',
            'proxy' => '프록시',
            'updates' => '업데이트',
            'server' => '서버',
        ],
        'webui' => [
            'availability-map' => '사용가능한 지도 설정',
            'graph' => '그래프 설정',
            'dashboard' => '대시보드 설정',
            'port-descr' => '인터페이스 설명 파싱',
            'search' => '검색 설정',
            'style' => '스타일',
            'device' => '디바이스 설정',
            'worldmap' => '세계 지도 설정',
        ],
    ],
    'settings' => [
        'active_directory' => [
            'users_purge' => [
                'description' => '비활성인 사용자 유지',
                'help' => '며칠동안 로그인을 하지 않은 사용자는 NanumWiFi에서 삭제됩니다. 0은 삭제가 되지 않는다는 뜻이며 다시 로그인을 하게되면 사용자가 재생성됩니다.',
            ],
        ],
        'addhost_alwayscheckip' => [
            'description' => '디바이스 추가 시 중복 IP 검사',
            'help' => 'ip 주소로 호스트를 추가한다면 ip가 이미 있는지 확인합니다. Ip가 있으면 호스트가 추가되지 않습니다. 호스트가 호스트 이름으로 추가되면 이 검사가 수행되지 않습니다. 설정이 true이면 호스트 이름이 확인되고 수행됩니다. 이 작업은 중복 호스트를 방지하는데 도움이 됩니다.',
        ],
        'alert_rule' => [
            'severity' => [
                'description' => '심각도',
                'help' => '경고 심각도',
            ],
            'max_alerts' => [
                'description' => '최대 경고',
                'help' => '최대 경고 횟수',
            ],
            'delay' => [
                'description' => '지연',
                'help' => '경고 전송 전 지연',
            ],
            'interval' => [
                'description' => '주기',
                'help' => '경고 확인 주기',
            ],
            'mute_alerts' => [
                'description' => '경고 끄기',
                'help' => 'Should Alert only be seen in WebUI',
            ],
            'invert_rule_match' => [
                'description' => '규칙 일치 확인',
                'help' => '규칙이 맞지 않을 경우 경고',
            ],
            'recovery_alerts' => [
                'description' => '경고 복구',
                'help' => '경고가 복구되면 알림',
            ],
            'invert_map' => [
                'description' => '목록에 있는 모든 디바이스',
                'help' => '목록에 있지 않은 디바이스만 경고',
            ],
        ],
        'alert' => [
            'ack_until_clear' => [
                'description' => '경고가 지워질 때까지 기본 확인 옵션',
                'help' => '경고가 지워질 때까지 기본 확인',
            ],
            'admins' => [
                'description' => '관리자에게 경고 알림',
                'help' => '관리자에게 경고',
            ],
            'default_copy' => [
                'description' => '기본 연락처에 모든 이메일 알림을 복사',
                'help' => '기본 연락처에 모든 이메일 알림을 복사',
            ],
            'default_if_none' => [
                'description' => 'webui에서 설정할 수 없나요?',
                'help' => '다른 연락처를 찾을 수 없는 경우 기본 연락처로 메일 보내기',
            ],
            'default_mail' => [
                'description' => '기본 연락처',
                'help' => '기본 메일 연락처',
            ],
            'default_only' => [
                'description' => '기본 연락처로만 알림 보내기',
                'help' => '기본 메일 연락처로만 알림',
            ],
            'disable' => [
                'description' => '알림 해제',
                'help' => '알림 생성 중지',
            ],
            'fixed-contacts' => [
                'description' => '유효하지 않은 이메일 주소 연락처 업데이트',
                'help' => 'TRUE인 경우 경고가 활성화되는 동안 sysContact 또는 사용자 이메일에 대한 변경 사항이 적용되지 않습니다',
            ],
            'globals' => [
                'description' => '읽기 전용 사용자에게 경고',
                'help' => '읽기 전용 관리자에게 경고',
            ],
            'syscontact' => [
                'description' => 'sysContact에 알림',
                'help' => 'SNMP sysContact 이메일로 알림 보내기',
            ],
            'transports' => [
                'mail' => [
                    'description' => '이메일 알림 활성화',
                    'help' => '메일 알림 전송',
                ],
            ],
            'tolerance_window' => [
                'description' => '크론용 톨러레이션 창',
                'help' => '톨러레이션 창',
            ],
            'users' => [
                'description' => '일반 사용자에게 알림 ',
                'help' => '일반 사용자에게 알림',
            ],
        ],
        'alert_log_purge' => [
            'description' => '보다 오래된 알림 로그 항목',
            'help' => 'daily.sh로 정리',
        ],
        'allow_duplicate_sysName' => [
            'description' => 'sysName 중복 허용',
            'help' => '기본적으로 중복 sysName은 추가되지 않도록 비활성되어있어 다중 인터페이스가 있는 장치가 여러 번 추가되는 것을 방지합니다.',
        ],
        'allow_unauth_graphs' => [
            'description' => '인증되지 않은 그래프 엑세스 허용',
            'help' => '로그인 없이 그래프 액세스 허용',
        ],
        'allow_unauth_graphs_cidr' => [
            'description' => '주어진 네트워크 그래프 엑세스 허용',
            'help' => '지정된 네트워크에 인증되지 않은 그래프 엑세스 허용 (인증되지 않은 그래프가 활성화된 경우 적용되지 않음',
        ],
        'api' => [
            'cors' => [
                'allowheaders' => [
                    'description' => '헤더 허용',
                    'help' => 'Access-Control-Allow-Headers 응답 헤더 설정',
                ],
                'allowcredentials' => [
                    'description' => '자격 허용',
                    'help' => 'Access-Control-Allow-Credentials 헤더 설정',
                ],
                'allowmethods' => [
                    'description' => '허용된 메서드',
                    'help' => '메서드 요청과 일치.',
                ],
                'enabled' => [
                    'description' => 'API에 대한 CORS 활성화',
                    'help' => '웹 클라이언트에서 API 리소스 로드 허용',
                ],
                'exposeheaders' => [
                    'description' => 'expose 헤더',
                    'help' => 'Access-Control-Expose-Headers 응답 헤더 설정',
                ],
                'maxage' => [
                    'description' => '유효 시간',
                    'help' => 'Sets the Access-Control-Max-Age 응답 헤더',
                ],
                'origin' => [
                    'description' => '원본 요청 허용',
                    'help' => '원본 요청과 일치. Wildcards가 사용될 수 있습니다, 예) .mydomain.com',
                ],
            ],
        ],
        'api_demo' => [
            'description' => '데모버전입니다',
        ],
        'apps' => [
            'powerdns-recursor' => [
                'api-key' => [
                    'description' => 'PowerDNS Recursor용 API 키',
                    'help' => '직접 연결시 PowerDNS Recursor 앱용 API 키',
                ],
                'https' => [
                    'description' => 'PowerDNS Recursor가 HTTPS를 사용하나요?',
                    'help' => '직접 연결시 PowerDNS Recursor용 HTTP 대신 HTTPS 사용',
                ],
                'port' => [
                    'description' => 'PowerDNS Recursor 포트',
                    'help' => '직접 연결시 PowerDNS Recursor 앱용 TCP 포트 사용',
                ],
            ],
        ],
        'astext' => [
            'description' => '자율 시스템 설명 캐시 보관키',
        ],
        'auth_ad_base_dn' => [
            'description' => 'Base DN',
            'help' => '그룹 및 사용자는 이 DN 아래에 있어야합니다. 예) dc=example, dc=com',
        ],
        'auth_ad_check_certificates' => [
            'description' => '인증서 확인',
            'help' => '인증서 유효 확인. 일부 서버는 자체 인증서를 사용합니다, 이 기능을 사용하지 않으면 허용합니다',
        ],
        'auth_ad_group_filter' => [
            'description' => 'Group LDAP filter',
            'help' => '그룹 선택을 위한 Active Directoy LDAP filter',
        ],
        'auth_ad_groups' => [
            'description' => 'Group access',
            'help' => '엑세스 및 레벨이 있는 그룹 정의',
        ],
        'auth_ad_user_filter' => [
            'description' => '사용자 LDAP filter',
            'help' => '사용자 선택을 위한 Active Directory LDAP 필터',
        ],
        'auth_ad_url' => [
            'description' => 'Active Directory Server(s)',
            'help' => '공백으로 서버를 구분하세요. ssl의 경우 ldaps:// 예) ldaps: //dc1.example.com ldaps : //dc2.example.com',
        ],
        'auth_ad_domain' => [
            'description' => 'Active Directory Domain',
            'help' => 'Active Directory Domain 예) example.com',
        ],
        'auth_ldap_attr' => [
            'uid' => [
                'description' => '사용자 이름 확인 속성',
                'help' => '사용자 이름으로 사용자를 식별하는 속성',
            ],
        ],
        'auth_ldap_binddn' => [
            'description' => 'Bind DN (bind 사용자이름 우선)',
            'help' => 'bind 사용자의 전체 DN',
        ],
        'auth_ldap_bindpassword' => [
            'description' => 'Bind 비밀번호',
            'help' => 'Bind 사용자 비밀번호',
        ],
        'auth_ldap_binduser' => [
            'description' => 'Bind 사용자 이름',
            'help' => '로그인한 사용자가 없을때 LDAP 서버를 쿼리하는데 사용',
        ],
        'auth_ad_binddn' => [
            'description' => 'Bind DN (bind 사용자이름 우선)',
            'help' => 'Bind 사용자의 전체 DN',
        ],
        'auth_ad_bindpassword' => [
            'description' => 'Bind 비밀번호',
            'help' => 'Bind 사용자 비밀번호',
        ],
        'auth_ad_binduser' => [
            'description' => 'Bind 사용자 이름',
            'help' => '로그인한 사용자가 없을때 LDAP 서버를 쿼리하는데 사용',
        ],
        'auth_ldap_cache_ttl' => [
            'description' => 'LDAP 캐시 만료',
            'help' => 'LDAP 쿼리결과 임시 저장. 속도는 향상되지만 데이터가 스테일 데이터일 수 있습니다.',
        ],
        'auth_ldap_debug' => [
            'description' => '디버그 표시',
            'help' => '디버그 정보 표시. 개인 정보가 노출될 수 있으므로 활성화하지 마세요',
        ],
        'auth_ldap_emailattr' => [
            'description' => '메일 속성',
        ],
        'auth_ldap_group' => [
            'description' => '엑세스 그룹 DN',
            'help' => '일반 액세스 권한 부여할 그룹의 고유이름. 예) cn = groupname, ou = groups, dc = example, dc = com,'
        ],
        'auth_ldap_groupbase' => [
            'description' => '그룹 base DN',
            'help' => '그룹을 검색하기 위한 고유 이름 예) ou = group, dc = example, dc = com',
        ],
        'auth_ldap_groupmemberattr' => [
            'description' => '그룹 멤버 속성',
        ],
        'auth_ldap_groupmembertype' => [
            'description' => '그룹 회원 찾기',
            'options' => [
                'username' => '사용자 이름',
                'fulldn' => '전체 DN (prefix, suffix 사용)',
                'puredn' => 'DN 검색 (uid 속성을 사용하여 검색)',
            ],
        ],
        'auth_ldap_groups' => [
            'description' => '그룹 액세스',
            'help' => '엑세스 및 레벨이 있는 그룹 정의',
        ],
        'auth_ldap_port' => [
            'description' => 'LDAP 포트',
            'help' => '서버에 연결할 포트, LDAP의 경우 389, LDAPS의 경우 636',
        ],
        'auth_ldap_prefix' => [
            'description' => '사용자 prefix',
            'help' => '사용자 이름을 고유 이름으로 바꾸는 데 사용',
        ],
        'auth_ldap_server' => [
            'description' => 'LDAP 서버',
            'help' => '공백으로 구분하여 서버를 설정하세요. Ssl의 경우 ldaps://',
        ],
        'auth_ldap_starttls' => [
            'description' => 'Use STARTTLS',
            'help' => 'STARTTLS을 사용하여 안전하게 연결하세요. LDAPS 대안',
            'options' => [
                'disabled' => '비활성화',
                'optional' => '선택적',
                'required' => '필수',
            ],
        ],
        'auth_ldap_suffix' => [
            'description' => '사용자 suffix',
            'help' => '사용자 이름을 고유 이름으로 바꾸는 데 사용',
        ],
        'auth_ldap_timeout' => [
            'description' => 'Connection timeout',
            'help' => 'If one or more servers are unresponsive, higher timeouts will cause slow access. To low may cause connection failures in some cases',
        ],
        'auth_ldap_uid_attribute' => [
            'description' => 'Unique ID attribute',
            'help' => 'LDAP attribute to use to identify users, must be numeric',
        ],
        'auth_ldap_userdn' => [
            'description' => 'Use full user DN',
            'help' => "Uses a user's full DN as the value of the member attribute in a group instead of member: username using the prefix and suffix. (it’s member: uid=username,ou=groups,dc=domain,dc=com)",
        ],
        'auth_ldap_wildcard_ou' => [
            'description' => 'Wildcard user OU',
            'help' => 'Search for user matching user name independently of OU set in user suffix. Useful if your users are in different OU. Bind username, if set, still user suffix',
        ],
        'auth_ldap_version' => [
            'description' => 'LDAP version',
            'help' => 'LDAP version to use to talk to the server.  Usually this should be v3',
            'options' => [
                '2' => '2',
                '3' => '3',
            ],
        ],
        'auth_mechanism' => [
            'description' => 'Authorization Method (Caution!)',
            'help' => "Authorization method.  Caution, you may lose the ability to log in. You can override this back to mysql by setting \$config['auth_mechanism'] = 'mysql'; in your config.php",
            'options' => [
                'mysql' => 'MySQL (default)',
                'active_directory' => 'Active Directory',
                'ldap' => 'LDAP',
                'radius' => 'Radius',
                'http-auth' => 'HTTP Authentication',
                'ad-authorization' => 'Externally authenticated AD',
                'ldap-authorization' => 'Externally authenticated LDAP',
                'sso' => 'Single Sign On',
            ],
        ],
        'auth_remember' => [
            'description' => 'Remember me duration',
            'help' => 'Number of days to keep a user logged in when checking the remember me checkbox at log in.',
        ],
        'authlog_purge' => [
            'description' => 'Auth log entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'peering_descr' => [
            'description' => 'Peering Port Types',
            'help' => 'Ports of the listed description type(s) will be shown under the peering ports menu entry.  See Interface Description Parsing docs for more info.',
        ],
        'transit_descr' => [
            'description' => 'Transit Port Types',
            'help' => 'Ports of the listed description type(s) will be shown under the transit ports menu entry.  See Interface Description Parsing docs for more info.',
        ],
        'core_descr' => [
            'description' => 'Core Port Types',
            'help' => 'Ports of the listed description type(s) will be shown under the core ports menu entry.  See Interface Description Parsing docs for more info.',
        ],
        'customers_descr' => [
            'description' => 'Customer Port Types',
            'help' => 'Ports of the listed description type(s) will be shown under the customers ports menu entry.  See Interface Description Parsing docs for more info.',
        ],
        'base_url' => [
            'description' => 'Specific URL',
            'help' => 'This should *only* be set if you want to *force* a particular hostname/port. It will prevent the web interface being usable form any other hostname',
        ],
        'device_perf_purge' => [
            'description' => 'Device performance entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'discovery_modules' => [
            'arp-table' => [
                'description' => 'ARP Table',
            ],
            'applications' => [
                'description' => 'Applications',
            ],
            'bgp-peers' => [
                'description' => 'BGP Peers',
            ],
            'cisco-cbqos' => [
                'description' => 'Cisco CBQOS',
            ],
            'cisco-cef' => [
                'description' => 'Cisco CEF',
            ],
            'cisco-mac-accounting' => [
                'description' => 'Cisco MAC Accounting',
            ],
            'cisco-otv' => [
                'description' => 'Cisco OTV',
            ],
            'cisco-qfp' => [
                'description' => 'Cisco QFP',
            ],
            'cisco-sla' => [
                'description' => 'Cisco SLA',
            ],
            'cisco-pw' => [
                'description' => 'Cisco PW',
            ],
            'cisco-vrf-lite' => [
                'description' => 'Cisco VRF Lite',
            ],
            'discovery-arp' => [
                'description' => 'Discovery ARP',
            ],
            'discovery-protocols' => [
                'description' => 'Discovery Protocols',
            ],
            'entity-physical' => [
                'description' => 'Entity Physical',
            ],
            'entity-state' => [
                'description' => 'Entity State',
            ],
            'fdb-table' => [
                'description' => 'FDB Table',
            ],
            'hr-device' => [
                'description' => 'HR Device',
            ],
            'ipv4-addresses' => [
                'description' => 'IPv4 Addresses',
            ],
            'ipv6-addresses' => [
                'description' => 'IPv6 Addresses',
            ],
            'junose-atm-vp' => [
                'description' => 'Junose ATM VP',
            ],
            'libvirt-vminfo' => [
                'description' => 'Libvirt VMInfo',
            ],
            'loadbalancers' => [
                'description' => 'Loadbalancers',
            ],
            'mef' => [
                'description' => 'MEF',
            ],
            'mempools' => [
                'description' => 'Mempools',
            ],
            'mpls' => [
                'description' => 'MPLS',
            ],
            'ntp' => [
                'description' => 'NTP',
            ],
            'os' => [
                'description' => 'OS',
            ],
            'ports' => [
                'description' => 'Ports',
            ],
            'ports-stack' => [
                'description' => 'Ports Stack',
            ],
            'processors' => [
                'description' => 'Processors',
            ],

            'route' => [
                'description' => 'Route',
            ],

            'sensors' => [
                'description' => 'Sensors',
            ],

            'services' => [
                'description' => 'Services',
            ],
            'storage' => [
                'description' => 'Storage',
            ],

            'stp' => [
                'description' => 'STP',
            ],
            'toner' => [
                'description' => 'Toner',
            ],
            'ucd-diskio' => [
                'description' => 'UCD DiskIO',
            ],
            'vlans' => [
                'description' => 'VLans',
            ],
            'vmware-vminfo' => [
                'description' => 'VMWare VMInfo',
            ],
            'vrf' => [
                'description' => 'VRF',
            ],
            'wireless' => [
                'description' => 'Wireless',
            ],
        ],
        'distributed_poller' => [
            'description' => 'Enable Distributed Polling (requires additional setup)',
            'help' => 'Enable distributed polling system wide. This is intended for load sharing, not remote polling. You must read the documentation for steps to enable: https://docs.librenms.org/Extensions/Distributed-Poller/',
        ],
        'default_poller_group' => [
            'description' => 'Default Poller Group',
            'help' => 'The default poller group all pollers should poll if none is set in config.php',
        ],
        'distributed_poller_memcached_host' => [
            'description' => 'Memcached host',
            'help' => 'The hostname or ip for the memcached server. This is required for poller_wrapper.py and daily.sh locking.',
        ],
        'distributed_poller_memcached_port' => [
            'description' => 'Memcached port',
            'help' => 'The port for the memcached server. Default is 11211',
        ],
        'email_auto_tls' => [
            'description' => 'Auto TLS support',
            'help' => 'Tries to use TLS before falling back to un-encrypted',
        ],
        'email_backend' => [
            'description' => 'How to deliver mail',
            'help' => 'The backend to use for sending email, can be mail, sendmail or SMTP',
            'options' => [
                'mail' => 'mail',
                'sendmail' => 'sendmail',
                'smtp' => 'SMTP',
            ],
        ],
        'email_from' => [
            'description' => 'From email address',
            'help' => 'Email address used for sending emails (from)',
        ],
        'email_html' => [
            'description' => 'Use HTML emails',
            'help' => 'Send HTML emails',
        ],
        'email_sendmail_path' => [
            'description' => 'Path to sendmail binary',
        ],
        'email_smtp_auth' => [
            'description' => 'SMTP authentication',
            'help' => 'Enable this if your SMTP server requires authentication',
        ],
        'email_smtp_host' => [
            'description' => 'SMTP Server',
            'help' => 'IP or dns name for the SMTP server to deliver mail to',
        ],
        'email_smtp_password' => [
            'description' => 'SMTP Auth password',
        ],
        'email_smtp_port' => [
            'description' => 'SMTP port setting',
        ],
        'email_smtp_secure' => [
            'description' => 'Encryption',
            'options' => [
                '' => 'Disabled',
                'tls' => 'TLS',
                'ssl' => 'SSL',
            ],
        ],
        'email_smtp_timeout' => [
            'description' => 'SMTP timeout setting',
        ],
        'email_smtp_username' => [
            'description' => 'SMTP Auth username',
        ],
        'email_user' => [
            'description' => 'From name',
            'help' => 'Name used as part of the from address',
        ],
        'eventlog_purge' => [
            'description' => 'Event log entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'favicon' => [
            'description' => 'Favicon',
            'help' => 'Overrides the default favicon.',
        ],
        'fping' => [
            'description' => 'Path to fping',
        ],
        'fping6' => [
            'description' => 'Path to fping6',
        ],
        'fping_options' => [
            'count' => [
                'description' => 'fping count',
                'help' => 'The number of pings to send when checking if a host is up or down via icmp',
            ],
            'interval' => [
                'description' => 'fping interval',
                'help' => 'The amount of milliseconds to wait between pings',
            ],
            'timeout' => [
                'description' => 'fping timeout',
                'help' => 'The amount of milliseconds to wait for an echo response before giving up',
            ],
        ],
        'geoloc' => [
            'api_key' => [
                'description' => 'Mapping Engine API Key',
                'help' => 'Geocoding API Key (Required to function)',
            ],
            'engine' => [
                'description' => 'Mapping Engine',
                'options' => [
                    'google' => 'Google Maps',
                    'openstreetmap' => 'OpenStreetMap',
                    'mapquest' => 'MapQuest',
                    'bing' => 'Bing Maps',
                ],
            ],
            'latlng' => [
                'description' => 'Attempt to Geocode Locations',
                'help' => 'Try to lookup latitude and longitude via geocoding API during polling',
            ],
        ],
        'graphite' => [
            'enable' => [
                'description' => 'Enable',
                'help' => 'Exports metrics to Graphite',
            ],
            'host' => [
                'description' => 'Server',
                'help' => 'The IP or hostname of the Graphite server to send data to',
            ],
            'port' => [
                'description' => 'Port',
                'help' => 'The port to use to connect to the Graphite server',
            ],
            'prefix' => [
                'description' => 'Prefix (Optional)',
                'help' => 'Will add the prefix to the start of all metrics.  Must be alphanumeric separated by dots',
            ],
        ],
        'graphing' => [
            'availability' => [
                'description' => 'Duration',
                'help' => 'Calculate Device Availability for listed durations. (Durations are defined in seconds)',
            ],
            'availability_consider_maintenance' => [
                'description' => 'Scheduled maintenance does not affect availability',
                'help' => 'Disables the creation of outages and decreasing of availability for devices which are in maintenance mode.',
            ],
        ],
        'graylog' => [
            'base_uri' => [
                'description' => 'Base URI',
                'help' => 'Override the base uri in the case you have modified the Graylog default.',
            ],
            'device-page' => [
                'loglevel' => [
                    'description' => 'Device Overview Log Level',
                    'help' => 'Sets the maximum log level shown on the device overview page.',
                ],
                'rowCount' => [
                    'description' => 'Device Overview Row Count',
                    'help' => 'Sets the number of rows show on the device overview page.',
                ],
            ],
            'password' => [
                'description' => 'Password',
                'help' => 'Password for accessing Graylog API.',
            ],
            'port' => [
                'description' => 'Port',
                'help' => 'The port used to access the Graylog API. If none give, it will be 80 for http and 443 for https.',
            ],
            'server' => [
                'description' => 'Server',
                'help' => 'The ip or hostname of the Graylog server API endpoint.',
            ],
            'timezone' => [
                'description' => 'Display Timezone',
                'help' => 'Graylog times are stored in GMT, this setting will change the displayed timezone. The value must be a valid PHP timezone.',
            ],
            'username' => [
                'description' => 'Username',
                'help' => 'Username for accessing the Graylog API.',
            ],
            'version' => [
                'description' => 'Version',
                'help' => 'This is used to automatically create the base_uri for the Graylog API. If you have modified the API uri from the default, set this to other and specify your base_uri.',
            ],
        ],
        'html' => [
            'device' => [
                'primary_link' => [
                    'description' => 'Primary Dropdown Link',
                    'help' => 'Sets the primary link in the device dropdown menu',
                ],
            ],
        ],
        'http_proxy' => [
            'description' => 'HTTP(S) Proxy',
            'help' => 'Set this as a fallback if http_proxy or https_proxy environment variable is not available.',
        ],
        'ignore_mount' => [
            'description' => 'Mountpoints to be ignored',
            'help' => 'Don\'t monitor Disc Usage of this Mountpoints',
        ],
        'ignore_mount_network' => [
            'description' => 'Ignore Network Mountpoints',
            'help' => 'Don\'t monitor Disc Usage of Network Mountpoints',
        ],
        'ignore_mount_optical' => [
            'description' => 'Ignore Optical Drives',
            'help' => 'Don\'t monitor Disc Usage of optical Drives',
        ],
        'ignore_mount_removable' => [
            'description' => 'Ignore Removable Drives',
            'help' => 'Don\'t monitor Disc Usage of removable Devices',
        ],
        'ignore_mount_regexp' => [
            'description' => 'Mountpoints matching Regex to be ignored',
            'help' => 'Don\'t monitor Disc Usage of Mountpoints which are matching at least one of this Regular Expressions',
        ],
        'ignore_mount_string' => [
            'description' => 'Mountpoints containing String to be ignored',
            'help' => 'Don\'t monitor Disc Usage of Mountpoints which contains at least one of this Strings',
        ],
        'influxdb' => [
            'db' => [
                'description' => 'Database',
                'help' => 'Name of the InfluxDB database to store metrics',
            ],
            'enable' => [
                'description' => 'Enable',
                'help' => 'Exports metrics to InfluxDB',
            ],
            'host' => [
                'description' => 'Server',
                'help' => 'The IP or hostname of the InfluxDB server to send data to',
            ],
            'password' => [
                'description' => 'Password',
                'help' => 'Password to connect to InfluxDB, if required',
            ],
            'port' => [
                'description' => 'Port',
                'help' => 'The port to use to connect to the InfluxDB server',
            ],
            'timeout' => [
                'description' => 'Timeout',
                'help' => 'How long to wait for InfluxDB server, 0 means default timeout',
            ],
            'transport' => [
                'description' => 'Transport',
                'help' => 'The port to use to connect to the InfluxDB server',
                'options' => [
                    'http' => 'HTTP',
                    'https' => 'HTTPS',
                    'udp' => 'UDPRRRRRRR',
                ],
            ],
            'username' => [
                'description' => 'Username',
                'help' => 'Username to connect to InfluxDB, if required',
            ],
            'verifySSL' => [
                'description' => 'Verify SSL',
                'help' => 'Verify the SSL certificate is valid and trusted',
            ],
        ],
        'ipmitool' => [
            'description' => 'Path to ipmtool',
        ],
        'login_message' => [
            'description' => 'Logon Message',
            'help' => 'Displayed on the login page',
        ],
        'mono_font' => [
            'description' => 'Monospaced Font',
        ],
        'mtr' => [
            'description' => 'Path to mtr',
        ],
        'mydomain' => [
            'description' => 'Primary Domain',
            'help' => 'This domain is used for network auto-discovery and other processes. NanumWiFi will attempt to append it to unqualified hostnames.',
        ],
        'network_map_show_on_worldmap' => [
            'description' => 'Display network links on the map',
            'help' => 'Show the networks links between the different location on the worldmap (weathermap-like)',
        ],
        'nfsen_enable' => [
            'description' => 'Enable NfSen',
            'help' => 'Enable Integration with NfSen',
        ],
        'nfsen_rrds' => [
            'description' => 'NfSen RRD Directories',
            'help' => 'This value specifies where your NFSen RRD files are located.',
        ],
        'nfsen_subdirlayout' => [
            'description' => 'Set NfSen subdir layout',
            'help' => 'This must match the subdir layout you have set in NfSen. 1 is the default.',
        ],
        'nfsen_last_max' => [
            'description' => 'Last Max',
        ],
        'nfsen_top_max' => [
            'description' => 'Top Max',
            'help' => 'Max topN value for stats',
        ],
        'nfsen_top_N' => [
            'description' => 'Top N',
        ],
        'nfsen_top_default' => [
            'description' => 'Default Top N',
        ],
        'nfsen_stat_default' => [
            'description' => 'Default Stat',
        ],
        'nfsen_order_default' => [
            'description' => 'Default Order',
        ],
        'nfsen_last_default' => [
            'description' => 'Default Last',
        ],
        'nfsen_lasts' => [
            'description' => 'Default Last Options',
        ],
        'nfsen_split_char' => [
            'description' => 'Split Char',
            'help' => 'This value tells us what to replace the full stops `.` in the devices hostname with. Usually: `_`',
        ],
        'nfsen_suffix' => [
            'description' => 'File name suffix',
            'help' => 'This is a very important bit as device names in NfSen are limited to 21 characters. This means full domain names for devices can be very problematic to squeeze in, so therefor this chunk is usually removed.',
        ],
        'nmap' => [
            'description' => 'Path to nmap',
        ],
        'opentsdb' => [
            'enable' => [
                'description' => 'Enable',
                'help' => 'Exports metrics to OpenTSDB',
            ],
            'host' => [
                'description' => 'Server',
                'help' => 'The IP or hostname of the OpenTSDB server to send data to',
            ],
            'port' => [
                'description' => 'Port',
                'help' => 'The port to use to connect to the OpenTSDB server',
            ],
        ],
        'own_hostname' => [
            'description' => 'NanumWiFi hostname',
            'help' => 'Should be set to the hostname/ip the NanumWiFi server is added as',
        ],
        'oxidized' => [
            'default_group' => [
                'description' => 'Set the default group returned',
            ],
            'enabled' => [
                'description' => 'Enable Oxidized support',
            ],
            'features' => [
                'versioning' => [
                    'description' => 'Enable config versioning access',
                    'help' => 'Enable Oxidized config versioning (requires git backend)',
                ],
            ],
            'group_support' => [
                'description' => 'Enable the return of groups to Oxidized',
            ],
            'reload_nodes' => [
                'description' => 'Reload Oxidized nodes list, each time a device is added',
            ],
            'url' => [
                'description' => 'URL to your Oxidized API',
                'help' => 'Oxidized API url (For example: http://127.0.0.1:8888)',
            ],
        ],
        'password' => [
            'min_length' => [
                'description' => 'Minimum password length',
                'help' => 'Passwords shorter than the given length will be rejected',
            ],
        ],
        'peeringdb' => [
            'enabled' => [
                'description' => 'Enable PeeringDB lookup',
                'help' => 'Enable PeeringDB lookup (data is downloaded with daily.sh)',
            ],
        ],
        'permission' => [
            'device_group' => [
                'allow_dynamic' => [
                    'description' => 'Enable user access via dynamic Device Groups',
                ],
            ],
        ],
        'ping' => [
            'description' => 'Path to ping',
        ],
        'poller_modules' => [
            'unix-agent' => [
                'description' => 'Unix Agent',
            ],
            'os' => [
                'description' => 'OS',
            ],
            'ipmi' => [
                'description' => 'IPMI',
            ],
            'sensors' => [
                'description' => 'Sensors',
            ],
            'processors' => [
                'description' => 'Processors',
            ],
            'mempools' => [
                'description' => 'Mempools',
            ],
            'storage' => [
                'description' => 'Storage',
            ],
            'netstats' => [
                'description' => 'Netstats',
            ],
            'hr-mib' => [
                'description' => 'HR Mib',
            ],
            'ucd-mib' => [
                'description' => 'Ucd Mib',
            ],
            'ipSystemStats' => [
                'description' => 'ipSystemStats',
            ],
            'ports' => [
                'description' => 'Ports',
            ],
            'bgp-peers' => [
                'description' => 'BGP Peers',
            ],
            'junose-atm-vp' => [
                'description' => 'JunOS ATM VP',
            ],
            'toner' => [
                'description' => 'Toner',
            ],
            'ucd-diskio' => [
                'description' => 'UCD DiskIO',
            ],
            'wifi' => [
                'description' => 'Wifi',
            ],
            'wireless' => [
                'description' => 'Wireless',
            ],
            'ospf' => [
                'description' => 'OSPF',
            ],
            'cisco-ipsec-flow-monitor' => [
                'description' => 'Cisco IPSec flow Monitor',
            ],
            'cisco-remote-access-monitor' => [
                'description' => 'Cisco remote access Monitor',
            ],
            'cisco-cef' => [
                'description' => 'Cisco CEF',
            ],
            'cisco-sla' => [
                'description' => 'Cisco SLA',
            ],
            'cisco-mac-accounting' => [
                'description' => 'Cisco MAC Accounting',
            ],
            'cipsec-tunnels' => [
                'description' => 'Cipsec Tunnels',
            ],
            'cisco-ace-loadbalancer' => [
                'description' => 'Cisco ACE Loadbalancer',
            ],
            'cisco-ace-serverfarms' => [
                'description' => 'Cisco ACE Serverfarms',
            ],
            'cisco-asa-firewall' => [
                'description' => 'Cisco ASA Firewall',
            ],
            'cisco-voice' => [
                'description' => 'Cisco Voice',
            ],
            'cisco-cbqos' => [
                'description' => 'Cisco CBQOS',
            ],
            'cisco-otv' => [
                'description' => 'Cisco OTV',
            ],
            'cisco-qfp' => [
                'description' => 'Cisco QFP',
            ],
            'cisco-vpdn' => [
                'description' => 'Cisco VPDN',
            ],
            'nac' => [
                'description' => 'NAC',
            ],
            'netscaler-vsvr' => [
                'description' => 'Netscaler VSVR',
            ],
            'aruba-controller' => [
                'description' => 'Aruba Controller',
            ],
            'availability' => [
                'description' => 'Availability',
            ],
            'entity-physical' => [
                'description' => 'Entity Physical',
            ],
            'entity-state' => [
                'description' => 'Entity State',
            ],
            'applications' => [
                'description' => 'Applications',
            ],
            'mib' => [
                'description' => 'MIB',
            ],
            'stp' => [
                'description' => 'STP',
            ],
            'ntp' => [
                'description' => 'NTP',
            ],
            'loadbalancers' => [
                'description' => 'Loadbalancers',
            ],
            'mef' => [
                'description' => 'MEF',
            ],
            'mpls' => [
                'description' => 'MPLS',
            ],
        ],
        'ports_fdb_purge' => [
            'description' => 'Port FDB entries older than',
            'help' => 'Cleanup done by daily.sh',
        ],
        'ports_purge' => [
            'description' => 'Ports older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'prometheus' => [
            'enable' => [
                'description' => 'Enable',
                'help' => 'Exports metrics to Prometheus Push Gateway',
            ],
            'url' => [
                'description' => 'URL',
                'help' => 'The URL of the Prometheus Push Gateway to send data to',
            ],
            'Job' => [
                'description' => 'Job',
                'help' => 'Job label for exported metrics',
            ],
            'attach_sysname' => [
                'description' => 'Attach Device sysName',
                'help' => 'Attach sysName information put to Prometheus.',
            ],
        ],
        'public_status' => [
            'description' => 'Show status publicly',
            'help' => 'Shows the status of some devices on the logon page without authentication.',
        ],
        'routes_max_number' => [
            'description' => 'Max number of routes allowed for discovery',
            'help' => 'No route will be discovered if the size of the routing table is bigger than this number',
        ],
        'nets' => [
            'description' => 'Autodiscovery Networks',
            'help' => 'Networks from which devices will be discovered automatically.',
        ],
        'autodiscovery' => [
            'nets-exclude' => [
                'description' => 'Networks/IPs to be ignored',
                'help' => 'Networks/IPs which will not be discovered automatically. Excludes also IPs from Autodiscovery Networks',
            ],
        ],
        'route_purge' => [
            'description' => 'Route entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'rrd' => [
            'heartbeat' => [
                'description' => 'Change the rrd heartbeat value (default 600)',
            ],
            'step' => [
                'description' => 'Change the rrd step value (default 300)',
            ],
        ],
        'rrd_dir' => [
            'description' => 'RRD Location',
            'help' => 'Location of rrd files.  Default is rrd inside the NanumWiFi directory.  Changing this setting does not move the rrd files.',
        ],
        'rrd_purge' => [
            'description' => 'RRD Files entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'rrd_rra' => [
            'description' => 'RRD Format Settings',
            'help' => 'These cannot be changed without deleting your existing RRD files. Though one could conceivably increase or decrease the size of each RRA if one had performance problems or if one had a very fast I/O subsystem with no performance worries.',
        ],
        'rrdcached' => [
            'description' => 'Enable rrdcached (socket)',
            'help' => 'Enables rrdcached by setting the location of the rrdcached socket. Can be unix or network socket (unix:/run/rrdcached.sock or localhost:42217)',
        ],
        'rrdtool' => [
            'description' => 'Path to rrdtool',
        ],
        'rrdtool_tune' => [
            'description' => 'Tune all rrd port files to use max values',
            'help' => 'Auto tune maximum value for rrd port files',
        ],
        'sfdp' => [
            'description' => 'Path to sfdp',
        ],
        'shorthost_target_length' => [
            'description' => 'Shortened hostname maximum length',
            'help' => 'Shrinks hostname to maximum length, but always complete subdomain parts',
        ],
        'site_style' => [
            'description' => 'Set the site css style',
            'options' => [
                'blue' => 'Blue',
                'dark' => 'Dark',
                'light' => 'Light',
                'mono' => 'Mono',
            ],
        ],
        'snmp' => [
            'transports' => [
                'description' => 'Transport (priority)',
                'help' => 'Select enabled transports and order them as you want them to be tried.',
            ],
            'version' => [
                'description' => 'Version (priority)',
                'help' => 'Select enabled versions and order them as you want them to be tried.',
            ],
            'community' => [
                'description' => 'Communities (priority)',
                'help' => 'Enter community strings for v1 and v2c and order them as you want them to be tried',
            ],
            'max_repeaters' => [
                'description' => 'Max Repeaters',
                'help' => 'Set repeaters to use for SNMP bulk requests',
            ],
            'port' => [
                'description' => 'Port',
                'help' => 'Set the tcp/udp port to be used for SNMP',
            ],
            'v3' => [
                'description' => 'SNMP v3 Authentication (priority)',
                'help' => 'Set up v3 authentication variables and order them as you want them to be tried',
                'auth' => 'Auth',
                'crypto' => 'Crypto',
                'fields' => [
                    'authalgo' => 'Algorithm',
                    'authlevel' => 'Level',
                    'authname' => 'Username',
                    'authpass' => 'Password',
                    'cryptoalgo' => 'Algorithm',
                    'cryptopass' => 'Password',
                ],
                'level' => [
                    'noAuthNoPriv' => 'No Authentication, No Privacy',
                    'authNoPriv' => 'Authentication, No Privacy',
                    'authPriv' => 'Authentication and Privacy',
                ],
            ],
        ],
        'snmpbulkwalk' => [
            'description' => 'Path to snmpbulkwalk',
        ],
        'snmpget' => [
            'description' => 'Path to snmpget',
        ],
        'snmpgetnext' => [
            'description' => 'Path to snmpgetnext',
        ],
        'snmptranslate' => [
            'description' => 'Path to snmptranslate',
        ],
        'snmptraps' => [
            'eventlog' => [
                'description' => 'Create eventlog for snmptraps',
                'help' => 'Independently of the action that may be mapped to the trap',
            ],
            'eventlog_detailed' => [
                'description' => 'Enable detailed logs',
                'help' => 'Add all OIDs received with the trap in the eventlog',
            ],
        ],
        'snmpwalk' => [
            'description' => 'Path to snmpwalk',
        ],
        'syslog_filter' => [
            'description' => 'Filter syslog messages containing',
        ],
        'syslog_purge' => [
            'description' => 'Syslog entries older than (days)',
            'help' => 'Cleanup done by daily.sh',
        ],
        'title_image' => [
            'description' => 'Title Image',
            'help' => 'Overrides the default Title Image.',
        ],
        'traceroute' => [
            'description' => 'Path to traceroute',
        ],
        'traceroute6' => [
            'description' => 'Path to traceroute6',
        ],
        'unix-agent' => [
            'connection-timeout' => [
                'description' => 'Unix-agent connection timeout',
            ],
            'port' => [
                'description' => 'Default unix-agent port',
                'help' => 'Default port for the unix-agent (check_mk)',
            ],
            'read-timeout' => [
                'description' => 'Unix-agent read timeout',
            ],
        ],
        'update' => [
            'description' => 'Enable updates in ./daily.sh',
        ],
        'update_channel' => [
            'description' => 'Set update Channel',
            'options' => [
                'master' => 'master',
                'release' => 'release',
            ],
        ],
        'uptime_warning' => [
            'description' => 'Show Device as warning if Uptime below (seconds)',
            'help' => 'Shows Device as warning if Uptime is below this value. Default 24h',
        ],
        'virsh' => [
            'description' => 'Path to virsh',
        ],
        'webui' => [
            'availability_map_box_size' => [
                'description' => 'Availability box width',
                'help' => 'Input desired tile width in pixels for box size in full view',
            ],
            'availability_map_compact' => [
                'description' => 'Availability map compact view',
                'help' => 'Availability map view with small indicators',
            ],
            'availability_map_sort_status' => [
                'description' => 'Sort by status',
                'help' => 'Sort devices and services by status',
            ],
            'availability_map_use_device_groups' => [
                'description' => 'Use device groups filter',
                'help' => 'Enable usage of device groups filter',
            ],
            'default_dashboard_id' => [
                'description' => 'Default dashboard',
                'help' => 'Global default dashboard_id for all users who do not have their own default set',
            ],
            'dynamic_graphs' => [
                'description' => 'Enable dynamic graphs',
                'help' => 'Enable dynamic graphs, enables zooming and panning on graphs',
            ],
            'global_search_result_limit' => [
                'description' => 'Set the max search result limit',
                'help' => 'Global search results limit',
            ],
            'graph_stacked' => [
                'description' => 'Use stacked graphs',
                'help' => 'Display stacked graphs instead of inverted graphs',
            ],
            'graph_type' => [
                'description' => 'Set the graph type',
                'help' => 'Set the default graph type',
                'options' => [
                    'png' => 'PNG',
                    'svg' => 'SVG',
                ],
            ],
            'min_graph_height' => [
                'description' => 'Set the minimum graph height',
                'help' => 'Minimum Graph Height (default: 300)',
            ],
        ],
        'device_location_map_open' => [
            'description' => 'Location Map open',
            'help' => 'Location Map is shown by default',
        ],
        'force_hostname_to_sysname' => [
            'description' => 'show SysName instead of Hostname',
            'help' => 'When using a dynamic DNS hostname or one that does not resolve, this option would allow you to make use of the sysName instead as the preferred reference to the device',
        ],
        'force_ip_to_sysname' => [
            'description' => 'show SysName instead of IP Address',
            'help' => 'When using IP addresses as a hostname you can instead represent the devices on the WebUI by its sysName resulting in an easier to read overview of your network. This would apply on networks where you don\'t have DNS records for most of your devices',
        ],
        'whois' => [
            'description' => 'Path to whois',
        ],
        'smokeping.integration' => [
            'description' => 'Enable',
            'help' => 'Enable smokeping integration',
        ],
        'smokeping.dir' => [
            'description' => 'Path to rrds',
            'help' => 'Full path to Smokeping RRDs',
        ],
        'smokeping.pings' => [
            'description' => 'Pings',
            'help' => 'Number of pings configured in Smokeping',
        ],
        'smokeping.url' => [
            'description' => 'URL to smokeping',
            'help' => 'Full URL to the smokeping gui',
        ],
    ],
    'twofactor' => [
        'description' => 'Enable Two-Factor Auth',
        'help' => 'Enables the built in Two-Factor authentication. You must set up each account to make it active.',
    ],
    'units' => [
        'days' => 'days',
        'ms' => 'ms',
        'seconds' => 'seconds',
    ],
    'validate' => [
        'boolean' => ':value is not a valid boolean',
        'color' => ':value is not a valid hex color code',
        'email' => ':value is not a valid email',
        'integer' => ':value is not an integer',
        'password' => 'The password is incorrect',
        'select' => ':value is not an allowed value',
        'text' => ':value is not allowed',
        'array' => 'Invalid format',
        'executable' => ':value is not a valid executable',
        'directory' => ':value is not a valid directory',
    ],
];
