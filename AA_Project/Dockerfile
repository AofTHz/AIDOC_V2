FROM php:8.2-apache


# Copy your frontend (PHP + assets)
COPY . /var/www/html/

# Inject backend URL into config.js at build time
# Adjust the path if your config.js lives elsewhere
ARG BACKEND_URL=http://35.197.133.237:5000
RUN sed -i "s|^const BASE_URL = \".*\";|const BASE_URL = \"${BACKEND_URL}\";|" /var/www/html/config.js

EXPOSE 80