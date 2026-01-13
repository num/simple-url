#!/bin/bash

# Laravel startup script for Railway
# This script runs when the container starts

echo "🚀 Starting Laravel application..."

# Wait for database/redis to be ready (if needed)
sleep 2

# Clear all caches
echo "🧹 Clearing caches..."
php artisan optimize:clear 2>/dev/null || true
php artisan cache:clear 2>/dev/null || true

# Cache for production (optional - uncomment if needed)
# echo "⚡ Optimizing for production..."
# php artisan config:cache
# php artisan route:cache
# php artisan view:cache

# Start supervisor
echo "✅ Starting services..."
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
