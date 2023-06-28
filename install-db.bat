php spark db:create lewi
php spark migrate
php spark auth:create_user admin admin@demo.com
php spark auth:set_password admin 1234demo
php spark auth:create_user 199208132006021001 199208132006021001@demo.com
php spark auth:set_password 199208132006021001 199208132006021001
php spark auth:create_user 12123001 12123001@demo.com
php spark auth:set_password 12123001 12123001
php spark auth:create_user 12123002 12123002@demo.com
php spark auth:set_password 12123002 12123002
php spark auth:create_group admin 'kelola data master'
php spark auth:create_group guru 'kelola data siswa per kelas'
php spark auth:create_group siswa 'kelola data pribadi'
php spark db:seed Demo