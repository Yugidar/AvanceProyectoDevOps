provider "aws" {
  region = "us-east-1"
}


#Creacion VPC
resource "aws_vpc" "vpc_AP" {
  cidr_block = "10.10.0.0/20"
  tags= {
    Name = "VPC_Avance"
  }
}

#Creacion de la subnet
resource "aws_subnet" "subnet_publica_AP" {
  vpc_id                  = aws_vpc.vpc_AP.id
  cidr_block              = "10.10.0.0/24"
  map_public_ip_on_launch = true
  tags = {
    Name = "SubnetAvance"
  }
}

#Creacion del gateway
resource "aws_internet_gateway" "igw" {
  vpc_id = aws_vpc.vpc_AP.id

  tags = {
    Name = "GW_AP"
  }
}

#Tabla de Rutas
resource "aws_route_table" "rutas_AP" {
  vpc_id = aws_vpc.vpc_AP.id

  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.igw.id
  }

  tags ={
    Name = "Rutas_publicas"
  }
}

#Asociacion de las tablas
resource "aws_route_table_association" "asociacion_AP" {
  subnet_id      = aws_subnet.subnet_publica_AP.id
  route_table_id = aws_route_table.rutas_AP.id
}


#GRUPO DE SEGURIDAD
resource "aws_security_group" "linux_sg" {
  name        = "Grupo de seguridad para la pagina web del proyecto"
  description = "Entrada de SSH y Salida de HTTP
  vpc_id      = aws_vpc.vpc_AP.id

  #Trafico SSH
  ingress {
    from_port   = 22
    to_port     = 22
    protocol    = "tcp"
    cidr_blocks = ["10.10.0.0/24"]
    security_groups = [aws_security_group.linux_sg.id]
  }

  #Trafico HTTP
  ingress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["10.10.0.0/24"]
    
  }

  egress {
    from_port   = 80
    to_port     = 80
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
}



#Instancia

#Instancia Web Linux

resource "aws_instance" "Instancia_Pagina" {
  ami           = "ami-084568db4383264d4"
  instance_type = "t2.micro"
  subnet_id     = aws_subnet.subnet_publica_AP.id

  vpc_security_group_ids = [aws_security_group.linux_sg.id]
  key_name = "vockey"

  associate_public_ip_address = true

  tags = {
    Name = "Instancia Servidor Web"
  }
}


#Outputs
output "Ip_Servidor" {
  description = "ip publica del servidor"
  value = aws_instance.Instancia_Pagina.public_ip
}



