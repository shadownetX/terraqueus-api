FROM nginx:1.15-alpine

RUN apk --no-cache add shadow && \
    rm -rf /var/cache/apk/*

RUN rm -f /etc/nginx/nginx.conf \
    /etc/nginx/conf.d/*

# Nginx configuration files
COPY nginx.conf /etc/nginx/nginx.conf
COPY api.conf /etc/nginx/conf.d/api.conf

# Nginx SSL
COPY ssl/www.api.trqs.cert /etc/nginx/ssl/www.api.trqs.crt
COPY ssl/www.api.trqs.key /etc/nginx/ssl/www.api.trqs.key

# Connect nginx with php-fpm
RUN echo "upstream php-upstream { server php:9000; }" > /etc/nginx/conf.d/upstream.conf

# Add access
RUN addgroup -g 1000 -S www-data && \
    adduser -u 1000 -D -S -G www-data www-data
