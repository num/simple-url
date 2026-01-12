# 🔧 แก้ปัญหา Routes ไม่ Sync

## ปัญหา:
- `/` ทำงาน ✅
- `/2` และ `/admin` ไม่ทำงาน ❌

## สาเหตุ: Laravel Route Cache

Laravel cache routes ไว้ ทำให้การแก้ไขไฟล์ไม่มีผล

---

## ✅ วิธีแก้:

### **1. Clear Route Cache**
```bash
docker exec -it laravel-app php artisan route:clear
docker exec -it laravel-app php artisan config:clear
docker exec -it laravel-app php artisan cache:clear
```

### **2. Restart Container**
```bash
docker-compose restart app
```

### **3. ทดสอบอีกครั้ง**
- http://localhost:8000/ ← ควรทำงาน
- http://localhost:8000/2 ← ควรทำงาน
- http://localhost:8000/admin ← ควรทำงาน

---

## 🔍 ตรวจสอบ Routes ทั้งหมด

```bash
docker exec -it laravel-app php artisan route:list
```

---

## 💡 ถ้ายังไม่ได้:

### **ตรวจสอบว่าไฟล์ sync หรือไม่:**
```bash
# ดูไฟล์ใน container
docker exec -it laravel-app cat routes/web.php
docker exec -it laravel-app cat routes/admin.php
```

### **ตรวจสอบ Nginx logs:**
```bash
docker exec -it laravel-app tail -f /var/log/nginx/error.log
```

### **ตรวจสอบ Laravel logs:**
```bash
docker exec -it laravel-app tail -f storage/logs/laravel.log
```

---

## 🎯 ถ้ายังไม่ได้ - Rebuild:

```bash
docker-compose down
docker-compose up -d --build
docker exec -it laravel-app php artisan route:clear
```
