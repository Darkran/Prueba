# Prueba
Instalacion

1º- Clonar el repositorio:  git clone https://github.com/Darkran/Prueba.git

2º- Ejecutar composer:  composer update

3º Ejecutar docker: docker-compose up

4º Se puede entrar a la pagina con http://localhost/login o http://192.168.2.2/login 

Puedes acceder a phpmyadmin con http://localhost:81/index.php?route=/ o http://192.168.2.4/

El usuario de phpmyadmin es root, no tiene contraseña, y el servidor es 192.168.2.3:3306

Hay que importar el fichero sqldata/project.sql a la base de datos project para poblarla.


Hay dos usuarios en la aplicacion
dummy@user.com - pass: dummyUser
dummy@admin.com - pass: dummyAdmin

Cada uno tiene diferentes permisos.
