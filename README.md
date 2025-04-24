# Repositorio para el avance de proyecto de DevOps

## Descripción del proyecto
Se elbarorara un entorno dentro de AWS con una instancia enlazada a una base de datos, esta tambien servira de servidor web para mostrar la tabla de la base de datos atraves de este. Se desarrollara el siguiente diagrama en el Proyecto.
![AWS Kubernetes nodes example(1)](https://github.com/user-attachments/assets/ec69ea7e-3380-4349-8432-797e594c52d4)


## Integrantes y Roles
Los integrantes y roles del equipo son:
# Luis Anotnio Hérnandez Vázquez - Developer y Tester
# Abraham Isaí Garza Sánchez - DevOps y Tester

## Instrucciones de despliegue
Para el despliegue se utilizo al princnipio el archivo setup_webserv.py, que es un archivo que al momento de ejecutarse dentro de la instancia de AWS, creara y desplegara la pagina web default a la que se puede acceder poniendo la IP publica de la instancia dentro de algun navegador. Una vez desplegada se modificara para tener los contenidos realiazdos por el Developer para mostrar la tabla creada para la base de datos que podra ser editada desde la misma pagina. Despues se opto por utilizar un archivo con el mismo nombre pero de extension .php debido a que esta permitia un acceso mas facil a la base de datos

## Explicación de la arquitectura (Diagrama)
Se desarrollo el siguiente diagrama
![AWS Kubernetes nodes example(1)](https://github.com/user-attachments/assets/e9b5433d-c9e4-4f32-9ef3-bc7d9223971a)
Se estableció el entorno que será la nube de AWS, luego se estableció que se usara una VPC con IP 10.10.0.0/20, después se estableció que se usara solo una subred publica con ip de 10.10.0.0/24, al menos para esta etapa del proyecto, después se estableció que se usara solo un grupo de seguridad  y por último se estableció que se usara solo una instancia de Linux para montar el servidor, tanto para el FrontEnd como para el BackEnd, ya que al tener que solo una instancia reducirá la carga de trabajo y posibles errores que puedan suceder al momento de montar el entorno con Terraform, facilitara el trabajo y lo hará mas ligero.

## Referencias o recursos utilizados
https://chatgpt.com
https://gemini.google.com
https://www.youtube.com/watch?v=wOZ1hYw5Arw
https://www.youtube.com/watch?v=fj3gCZ9bTOo
https://www.youtube.com/watch?v=83fbh9MFWos&t=716s&pp=0gcJCYQJAYcqIYzv
https://www.youtube.com/watch?v=LhnIL3zpgpQ
https://www.youtube.com/watch?v=E5fQl3Ljvbo&t=417s
https://www.youtube.com/watch?v=F5oOq-FWUl4
https://www.youtube.com/watch?v=O47W7Eh8LdU&t=512s
https://chatgpt.com

