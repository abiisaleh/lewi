# Base image
FROM shinsenter/phpfpm-apache:php8.2-tidy

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT=/public

# Copy additional files
COPY scratch/ / # buildkit
COPY root/ / # buildkit

# Set image labels
LABEL org.opencontainers.image.title="shinsenter/codeigniter4" \
      org.opencontainers.image.description="🔰 (PHP) Run CodeIgniter" \
      maintainer="SHIN (@shinsenter) <shin@shin.company>" \
      org.opencontainers.image.created="2023-06-21T00:37:00+0000" \
      org.opencontainers.image.documentation="https://hub.docker.com/r/shinsenter/codeigniter4" \
      org.opencontainers.image.licenses="GPL-3.0" \
      org.opencontainers.image.revision="dbf076b2ea8c8e1fc56ca60deb6aa8440d19ce8d" \
      org.opencontainers.image.source="https://code.shin.company/php/blob/main/src/webapps/codeigniter4/Dockerfile" \
      org.opencontainers.image.url="https://hub.docker.com/r/shinsenter/codeigniter4/tags"

# Set environment variables
ENV IMAGE_NAME="shinsenter/codeigniter4"

# Set working directory
WORKDIR /var/www/html

# Expose ports
EXPOSE 9000/tcp
EXPOSE 80/tcp
EXPOSE 443/tcp
EXPOSE 443/udp

# Entry point
ENTRYPOINT ["/init"]
