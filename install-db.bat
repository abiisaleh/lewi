php spark db:create lewi
php spark migrate
php spark auth:create_user admin admin@demo.com
php spark auth:set_password admin 1234demo
php spark auth:create_user guru guru@demo.com
php spark auth:set_password guru 1234demo
php spark auth:create_user siswa siswa@demo.com
php spark auth:set_password siswa 1234demo
php spark auth:create_group admin 'kelola data master'
php spark auth:create_group guru 'kelola data siswa per kelas'
php spark auth:create_group siswa 'kelola data pribadi'
php spark db:seed Demo