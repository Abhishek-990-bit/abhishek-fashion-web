# Step 1: Use the official PHP image with Apache pre-installed
FROM php:8.2-apache

# Step 2: Install 'unzip' so we can handle zip files if needed
RUN apt-get update && apt-get install -y unzip

# Step 3: Copy your local website files into the container
# This is better than 'wget' because it uses your actual updated code
COPY . /var/www/html/

# Step 4: Fix permissions so the 'database.txt' can be written
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Step 5: Tell the container to listen on Port 80
EXPOSE 80

# Apache starts automatically in this image, so we don't need a CMD line!
# Add this near the bottom of your Dockerfile
RUN touch /var/www/html/database.txt && chmod 777 /var/www/html/database.txt
FROM php:8.2-apache
COPY . /var/www/html/

# This is the magic line that fixes the button/form issue
RUN touch /var/www/html/database.txt && chmod 777 /var/www/html/database.txt

EXPOSE 80