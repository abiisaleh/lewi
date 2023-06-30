# Base image for MariaDB
FROM docker.io/bitnami/mariadb:10.6

# Environment variables for MariaDB
ENV ALLOW_EMPTY_PASSWORD=yes
ENV MARIADB_USER=bn_myapp
ENV MARIADB_DATABASE=bitnami_myapp

# Base image for CodeIgniter 4
FROM docker.io/bitnami/codeigniter:4

# Expose port 8000
EXPOSE 8000

# Environment variables for CodeIgniter 4
ENV ALLOW_EMPTY_PASSWORD=yes
ENV CODEIGNITER_DATABASE_HOST=mariadb
ENV CODEIGNITER_DATABASE_PORT_NUMBER=3306
ENV CODEIGNITER_DATABASE_USER=bn_myapp
ENV CODEIGNITER_DATABASE_NAME=bitnami_myapp

# Set working directory
WORKDIR /app

# Copy CodeIgniter project files to the working directory
COPY ./my-project /app

# Depend on MariaDB service
DEPENDS_ON mariadb
