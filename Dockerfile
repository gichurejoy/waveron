FROM php:8.2.20-cli-bookworm

# Install system dependencies and required libraries for PHP extensions
# Rule: Every apt-get install must include --no-install-recommends
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    unzip \
    libsqlite3-dev \
    libxml2-dev \
    libonig-dev \
    xz-utils \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_sqlite bcmath xml mbstring

# Note: json, ctype, tokenizer, and pdo are bundled/enabled by default in official PHP 8.2 Docker images.

# Install Composer (Pinned version)
# Rule: No curl | sh or wget | sh unless URL is versioned (avoiding pipes entirely for strict compliance)
RUN curl -fsSL https://getcomposer.org/download/2.7.7/composer.phar -o /usr/local/bin/composer \
    && chmod +x /usr/local/bin/composer

# Install Node.js (Pinned version) and npm
# Rule: No curl | sh or wget | sh unless URL is versioned (avoiding pipe via direct tarball extraction)
RUN curl -fsSLO https://nodejs.org/dist/v20.15.0/node-v20.15.0-linux-x64.tar.xz \
    && tar -xJf node-v20.15.0-linux-x64.tar.xz -C /usr/local --strip-components=1 \
    && rm node-v20.15.0-linux-x64.tar.xz

# Set working directory
WORKDIR /app

# Copy all project files
# Rule: Use COPY . . not COPY my-repo-name/ .
COPY . .

# Run composer and npm installs
RUN composer install --no-interaction --prefer-dist --no-dev \
    && npm ci \
    && npm run build
